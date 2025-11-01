<x-app-layout>
    <x-page-header>
        <x-slot name="title">Activity Schedule</x-slot>
        <x-slot name="description">Keep your family's cherished memories organized and easy to revisit.</x-slot>
    </x-page-header>

    <div class="container mx-auto px-4 py-6">

        {{-- Table Wrapper --}}
        <div class="overflow-x-auto bg-white shadow-md rounded-xl border border-blue-100">
            <table class="w-full text-sm text-left text-gray-600">
                <thead class="bg-blue-50 text-blue-700 uppercase text-xs tracking-wide">
                    <tr>
                        <th class="px-6 py-3">Agenda</th>
                        <th class="px-6 py-3">Lokasi</th>
                        <th class="px-6 py-3">Tanggal</th>
                        <th class="px-6 py-3">Waktu</th>
                        <th class="px-6 py-3">Catatan</th>
                        <th class="px-6 py-3 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($activities as $activity)
                        <tr class="border-t border-blue-50 hover:bg-blue-50/30 transition">
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $activity->name }}</td>
                            <td class="px-6 py-4">{{ $activity->location }}</td>
                            <td class="px-6 py-4">
                                {{ \Carbon\Carbon::parse($activity->date)->translatedFormat('d F') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ \Carbon\Carbon::parse($activity->start_time)->format('H:i') }} -
                                {{ $activity->end_time ? \Carbon\Carbon::parse($activity->end_time)->format('H:i') : 'Selesai' }}
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $notes = is_array($activity->notes) ? $activity->notes : json_decode($activity->notes, true);
                                    $filteredNotes = array_filter($notes);
                                @endphp
                                @if (count($filteredNotes))
                                    <ul class="list-disc list-inside text-gray-700">
                                        @foreach ($filteredNotes as $note)
                                            <li>{{ $note }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="text-gray-400 italic">Tidak ada catatan</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{-- Dropdown Action --}}
                                <div class="relative inline-block text-left">
                                    <button id="dropdownMenuIconButton-{{ $activity->id }}"
                                        data-dropdown-toggle="dropdownDots-{{ $activity->id }}"
                                        class="p-2 rounded-full text-blue-600 hover:bg-blue-100 transition"
                                        type="button">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 4 15">
                                            <path
                                                d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                                        </svg>
                                    </button>

                                    <div id="dropdownDots-{{ $activity->id }}"
                                        class="hidden absolute right-0 mt-2 w-44 bg-white border border-gray-200 rounded-lg shadow-lg z-20">
                                        <ul class="py-2 text-sm text-gray-700">
                                            <li>
                                                <a data-modal-target="updateModal-{{ $activity->id }}"
                                                    data-modal-toggle="updateModal-{{ $activity->id }}"
                                                    class="block px-4 py-2 hover:bg-blue-50 text-blue-600 cursor-pointer">
                                                    ✏️ Edit
                                                </a>
                                            </li>
                                            <li>
                                                <form action="{{ route('activity.destroy', $activity) }}" method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus kegiatan ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="w-full text-left px-4 py-2 hover:bg-red-50 text-red-600">
                                                        🗑️ Delete
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-6 text-gray-500 italic">
                                Belum ada aktivitas yang tercatat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Tombol Tambah Kegiatan
        <div class="flex justify-end mt-6">
            <button data-modal-target="createModal" data-modal-toggle="createModal"
                class="bg-blue-600 text-white px-5 py-2 rounded-lg shadow hover:bg-blue-700 transition">
                + Tambah Kegiatan
            </button>
        </div> --}}

    </div>

    {{-- modal create activity --}}
    @include('activity.create')

    {{-- modal update activity --}}
    @include('activity.edit')

    {{-- Read More Script --}}
    <script>
        document.querySelectorAll('.read-more-btn').forEach(button => {
            button.addEventListener('click', function() {
                const parent = this.parentElement;
                parent.querySelector('.dots').classList.toggle('hidden');
                parent.querySelector('.more-text').classList.toggle('hidden');
                this.textContent = this.textContent === 'Read more' ? 'Read less' : 'Read more';
            });
        });
    </script>

    {{-- Undangan Generator --}}
    <script>
        function generateUndangan(id) {
            fetch(`admin/activity/${id}/generate-image`)
                .then(res => res.json())
                .then(data => window.open(data.url, '_blank'));
        }
    </script>
</x-app-layout>
