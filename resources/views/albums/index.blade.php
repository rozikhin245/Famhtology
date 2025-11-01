<x-app-layout>
    {{-- untuk menampilkan icon +  untuk memunculkan modal tambah data --}}
    @include('albums.create')
    {{-- untuk menampilkan modal update data, tmbol ada di edit data --}}
    @include('albums.edit')

    <div class="container mx-auto px-4">
        {{-- Header --}}

        {{-- <div class="flex flex-col items-start mb-10 mt-4">
            <h1 class="font-poppins text-2xl font-bold text-gray-800">Album List</h1>
            <p class="text-sm text-gray-600 mt-1">Preserve and organize your precious family memories</p>
        </div> --}}
        <x-page-header>
            <x-slot name="title">Album List</x-slot>
            <x-slot name="description">Preserve and organize your precious family memories</x-slot>
        </x-page-header>


        {{-- Success Message --}}
        @if (session('success'))
            <div class="mt-4 text-green-600 font-semibold">
                {{ session('success') }}
            </div>
        @endif

        {{-- Album Cards --}}
        <div class="mt-6 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($albums as $album)
                <div class="bg-white rounded-xl shadow hover:shadow-md transition duration-200 relative">
                    <!-- Dropdown -->
                    <div class="absolute top-3 right-3 z-10">
                        <button id="dropdownMenuIconButton-{{ $album->id }}"
                            data-dropdown-toggle="dropdownDots-{{ $album->id }}"
                            class="p-2 rounded-full text-gray-600" type="button">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 4 15">
                                <path
                                    d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                            </svg>
                        </button>
                        <div id="dropdownDots-{{ $album->id }}"
                            class="hidden z-20 bg-white divide-y divide-gray-100 rounded-md shadow w-44">
                            <ul class="py-2 text-sm text-gray-700">
                                <li>
                                    <a data-modal-target="update-albums-{{ $album->id }}"
                                        data-modal-toggle="update-albums-{{ $album->id }}"
                                        class="block px-4 py-2 hover:bg-gray-100 cursor-pointer">
                                        Edit
                                    </a>
                                </li>

                                <li>
                                    <form action="{{ route('albums.destroy', $album) }}" method="POST"
                                        onsubmit="return confirm('Yakin hapus album ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="w-full text-left px-4 py-2 hover:bg-gray-100 text-red-600">Delete</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="flex items-center gap-4 p-3 sm:p-4">
                        <!-- Icon -->
                        <div class="flex items-center justify-center w-16 h-16 bg-yellow-100 rounded-lg">
                            <svg class="w-8 h-8 text-yellow-500" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M3 6a2 2 0 0 1 2-2h5.532a2 2 0 0 1 1.536.72l1.9 2.28H3V6Zm0 3v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V9H3Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>

                        <!-- Info -->
                        <div class="flex-1 min-w-0">
                            <a href="{{ route('photos.index', $album->id) }}"
                                class="block text-base font-semibold text-gray-800 hover:text-blue-600 hover:underline transition truncate">
                                {{ $album->name }}
                            </a>
                            <p class="text-sm text-gray-500 truncate mt-1">ID: {{ $album->google_drive_folder_id }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-500">No albums yet.</div>
            @endforelse
        </div>
    </div>




</x-app-layout>
