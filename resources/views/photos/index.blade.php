<x-app-layout>
    <div class="container mx-auto px-4">
        {{-- <div class="flex flex-col items-start mb-14 mt-4">
            <h1 class="font-poppins text-2xl font-bold text-gray-800"></h1>
            <p class="text-sm text-gray-600 mt-1">View all photos stored in this album.</p>
        </div> --}}
        <x-page-header>
            <x-slot name="title">Album from : <span
                    class="text-blue-600 hover:underline cursor-pointer">{{ $album->name }}</span></x-slot>
            <x-slot name="description">View all photos stored in this album.</x-slot>
        </x-page-header>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif



        @if ($photos->isEmpty())
            <div class="flex h-full w-full justify-items-start">
                <p class="text-gray-600">No photos in this album yet</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($photos as $photo)
                    <div
                        class="relative group bg-transparent hover:bg-gray-200 hover:bg-opacity-30 hover:rounded-lg hover:shadow-md overflow-hidden transition-all duration-300 ease-in-out">
                        <!-- Tombol Hapus -->
                        <form action="{{ route('photos.destroy', [$album->id, $photo->id]) }}" method="POST"
                            onsubmit="return confirm('Yakin hapus foto ini?')"
                            class="absolute top-2 right-2 z-10 opacity-0 group-hover:opacity-100 transition duration-300">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-white bg-opacity-30 backdrop-blur-sm hover:bg-red-100 hover:bg-opacity-55  text-red-500 p-1.5 rounded-full shadow-md transition"
                                title="Hapus Foto">
                                <!-- Trash Icon SVG -->
                                <svg class="w-6 h-6" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </form>

                        <!-- Gambar -->
                        <img src="{{ asset('storage/photos/' . $photo->name) }}" alt="{{ $photo->name }}"
                            class="w-full h-48 object-cover">

                        <!-- Nama Foto -->
                        <div class="p-4">
                            <p class="text-sm text-gray-800 font-medium truncate mb-3">{{ $photo->name }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>





    @include('photos.create')


</x-app-layout>
