<!-- Main Modal: Create Activity -->
<div id="createActivity" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm">
    <div class="relative w-full max-w-2xl p-6">
        <div class="relative bg-white rounded-2xl shadow-xl border border-blue-100">

            <!-- Modal Header -->
            <div class="flex items-center justify-between p-5 border-b border-blue-100">
                <h3 class="text-xl font-semibold text-blue-700">🗓️ Create Activity</h3>
                <button type="button" data-modal-toggle="createActivity"
                    class="text-gray-400 hover:text-red-500 transition">
                    <svg aria-hidden="true" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <form action="{{ route('activity.store') }}" method="POST" class="p-6 space-y-6">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <!-- Nama -->
                    <div>
                        <label for="name" class="block mb-2 text-sm font-semibold text-gray-700">Nama Agenda</label>
                        <input type="text" name="name" id="name" placeholder="Masukkan nama kegiatan..."
                            class="w-full p-2.5 border border-gray-300 rounded-lg text-gray-800 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition">
                    </div>

                    <!-- Lokasi -->
                    <div>
                        <label for="location" class="block mb-2 text-sm font-semibold text-gray-700">Lokasi</label>
                        <input type="text" name="location" id="location" placeholder="Contoh: Rumah Nenek"
                            class="w-full p-2.5 border border-gray-300 rounded-lg text-gray-800 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition">
                    </div>

                    <!-- Tanggal -->
                    <div>
                        <label for="date" class="block mb-2 text-sm font-semibold text-gray-700">Tanggal</label>
                        <input type="date" name="date" id="date"
                            class="w-full p-2.5 border border-gray-300 rounded-lg text-gray-800 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition">
                    </div>

                    <!-- Jam Mulai & Selesai -->
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-700">Waktu</label>
                        <div class="flex gap-3">
                            <input type="time" name="start_time"
                                class="w-1/2 p-2.5 border border-gray-300 rounded-lg text-gray-800 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition">
                            <input type="time" name="end_time"
                                class="w-1/2 p-2.5 border border-gray-300 rounded-lg text-gray-800 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition">
                        </div>
                    </div>

                    <!-- Album -->
                    <div class="sm:col-span-2">
                        <label for="album_id" class="block mb-2 text-sm font-semibold text-gray-700">Album Kegiatan</label>
                        <select name="album_id" id="album_id"
                            class="w-full p-2.5 border border-gray-300 rounded-lg text-gray-800 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition">
                            <option value="">-- Pilih Album --</option>
                            @foreach ($albums as $album)
                                <option value="{{ $album->id }}">{{ $album->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Notes -->
                    <div class="sm:col-span-2">
                        <label class="block mb-2 text-sm font-semibold text-gray-700">Catatan</label>
                        <div id="notes-wrapper" class="space-y-2">
                            <div class="flex gap-2">
                                <input type="text" name="notes[]" placeholder="Masukkan catatan..."
                                    class="flex-1 p-2.5 border border-gray-300 rounded-lg text-gray-800 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition">
                                <button type="button" onclick="addNoteInput()"
                                    class="px-3 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">+</button>
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    {{-- <div class="sm:col-span-2">
                        <label for="description"
                            class="block mb-2 text-sm font-semibold text-gray-700">Deskripsi</label>
                        <textarea id="description" name="description" rows="4"
                            class="w-full p-2.5 border border-gray-300 rounded-lg text-gray-800 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition"
                            placeholder="Tuliskan deskripsi kegiatan..."></textarea>
                    </div> --}}
                </div>

                <!-- Tombol Submit -->
                <div class="flex justify-end pt-3">
                    <button type="submit"
                        class="px-5 py-2.5 bg-blue-600 text-white font-medium rounded-lg shadow hover:bg-blue-700 transition">
                        Simpan Kegiatan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Floating Button -->
<div data-modal-target="createActivity" data-modal-toggle="createActivity"
    class="fixed end-6 bottom-6 group z-40">
    <button type="button"
        class="flex items-center justify-center w-14 h-14 text-white bg-blue-600 rounded-full shadow-lg hover:bg-blue-700 transition-all duration-300 focus:ring-4 focus:ring-blue-300">
        <svg class="w-6 h-6 transition-transform group-hover:rotate-45" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
        </svg>
    </button>
</div>

<script>
    function addNoteInput() {
        const wrapper = document.getElementById('notes-wrapper');
        const inputGroup = document.createElement('div');
        inputGroup.classList.add('flex', 'gap-2');
        inputGroup.innerHTML = `
            <input type="text" name="notes[]" placeholder="Masukkan catatan..."
                class="flex-1 p-2.5 border border-gray-300 rounded-lg text-gray-800 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition">
            <button type="button" onclick="this.parentElement.remove()"
                class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">-</button>
        `;
        wrapper.appendChild(inputGroup);
    }
</script>
