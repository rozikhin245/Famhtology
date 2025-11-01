<div id="gallery" class="mx-auto max-w-screen-md text-center mb-12 mt-14">
    <h2 class="mb-3 text-4xl md:text-5xl font-extrabold tracking-tight text-gray-900">
        Albums
    </h2>
    <p class="text-gray-500 text-sm md:text-base max-w-xl mx-auto">
        Jelajahi berbagai album foto keluarga dan kenangan berharga.
    </p>
</div>

<!-- Album Grid -->
<div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 mt-8">
    @forelse($albums as $album)
        <div
            class="group bg-white rounded-2xl shadow-sm hover:shadow-lg transition duration-300 overflow-hidden border border-gray-100 hover:border-blue-200 relative">

            <!-- Decorative Top Banner -->
            <div class="h-2 bg-gradient-to-r from-blue-300 via-blue-400 to-blue-400"></div>

            <!-- Content -->
            <div class="flex items-center gap-4 p-5">
                <!-- Icon -->
                <div
                    class="flex items-center justify-center w-16 h-16 bg-gradient-to-br from-blue-100 to-blue-200 rounded-xl group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M3 6a2 2 0 0 1 2-2h5.532a2 2 0 0 1 1.536.72l1.9 2.28H3V6Zm0 3v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V9H3Z"
                            clip-rule="evenodd" />
                    </svg>
                </div>

                <!-- Info -->
                <div class="flex-1 min-w-0">
                    <a href="{{ route('photos', $album) }}"
                        class="block text-lg font-semibold text-gray-800 hover:text-blue-600 transition-colors duration-300 truncate">
                        {{ $album->name }}
                    </a>
                    <p class="text-sm text-gray-500 truncate mt-1">
                        Folder ID: {{ $album->google_drive_folder_id }}
                    </p>
                </div>
            </div>

            <!-- Hover overlay effect -->
            <div
                class="absolute inset-0 bg-gradient-to-t from-blue-500/10 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-2xl pointer-events-none">
            </div>
        </div>
    @empty
        <div class="col-span-full text-center text-gray-500 italic">Belum ada album yang tersedia.</div>
    @endforelse
</div>

<!-- Button -->
<div class="w-full flex justify-center mt-12">
    <button data-modal-target="extralarge-modal" data-modal-toggle="extralarge-modal"
        class="group bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm py-3 px-7 rounded-full shadow-md hover:shadow-lg transition-all duration-300 ease-in-out flex items-center gap-2">
        <span>Lihat Semua</span>
        <span
            class="transform group-hover:translate-x-1 transition-transform duration-300 ease-in-out text-lg">→</span>
    </button>

    @include('dashboard.allalbums')
</div>
