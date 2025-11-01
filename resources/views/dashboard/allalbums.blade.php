<div id="extralarge-modal" tabindex="-1"
    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-7xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                <h3 class="text-xl font-medium text-gray-900">
                    All Albums
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-hide="extralarge-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
                <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3 mt-6">
                    @forelse($allalbums as $album)
                        <div class="bg-white rounded-xl shadow hover:shadow-md transition duration-200 relative">
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
                                    <a href="{{ route('photos', $album) }}"
                                        class="block text-base font-semibold text-gray-800 hover:text-blue-600 hover:underline transition truncate">
                                        {{ $album->name }}
                                    </a>
                                    <p class="text-sm text-gray-500 truncate mt-1">ID:
                                        {{ $album->google_drive_folder_id }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center text-gray-500">No albums yet.</div>
                    @endforelse
                </div>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-4 md:p-5 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b">
                <button data-modal-hide="extralarge-modal" type="button"
                    class="py-2.5 px-5 ms-3 text-sm font-medium focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:z-10 focus:ring-4 focus:ring-gray-100">
                    <span class="sr-only">Close modal</span>
                    close
                </button>
            </div>
        </div>
    </div>
</div>
