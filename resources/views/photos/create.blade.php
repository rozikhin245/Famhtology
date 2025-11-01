{{-- tombol untuk memunculkan modal add photos --}}
<div data-dial-init data-modal-target="add-photos" data-modal-toggle="add-photos" class="fixed end-6 bottom-6 group">
    <button type="button" data-dial-toggle="speed-dial-menu-square" aria-controls="speed-dial-menu-square"
        aria-expanded="false"
        class="flex items-center justify-center text-white bg-blue-700 rounded-lg w-14 h-14 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 focus:outline-none">
        <svg class="w-5 h-5 transition-transform group-hover:rotate-45" aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 1v16M1 9h16" />
        </svg>
        <span class="sr-only">Open actions menu</span>
    </button>
</div>

{{-- modal add photos --}}
<div id="add-photos" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">
                    Add new Photo
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-toggle="add-photos">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="{{ route('photos.store', $album->id) }}" method="POST" enctype="multipart/form-data"
                class="p-4 md:p-5">
                @csrf
                <div class="grid gap-6 mb-6">
                    <div class="col-span-2">
                        <label for="multiple_files" class="block mb-2 text-sm font-medium text-gray-700">
                            Pilih Foto
                        </label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            id="multiple_files" type="file" name="photo[]"  required multiple accept="image/*">
                        <p class="mt-1 text-xs italic ml-1 text-gray-500" id="file_input_help">SVG, PNG, JPG or
                            GIF (MAX. 800x400px).</p>

                        <!-- Preview -->
                        <div id="preview-container" class="mt-4 flex flex-wrap gap-4"></div>
                    </div>
                </div>

                <!-- Tombol Submit -->
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Upload Foto
                </button>

            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const input = document.getElementById('multiple_files');
        const previewContainer = document.getElementById('preview-container');

        input.addEventListener('change', function() {
            previewContainer.innerHTML = '';

            Array.from(this.files).forEach((file, index) => {
                if (!file.type.startsWith('image/')) return;

                const reader = new FileReader();
                reader.onload = function(e) {
                    const wrapper = document.createElement('div');
                    wrapper.classList.add('relative', 'w-24', 'h-24');

                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('object-cover', 'rounded', 'border', 'w-full',
                        'h-full');

                    const removeBtn = document.createElement('button');
                    removeBtn.type = 'button';
                    removeBtn.textContent = '×';
                    removeBtn.classList.add(
                        'absolute', 'top-0', 'right-0', 'text-white', 'bg-red-600',
                        'rounded-full', 'w-5', 'h-5', 'flex', 'items-center',
                        'justify-center',
                        'text-xs', 'hover:bg-red-700'
                    );

                    removeBtn.addEventListener('click', () => {
                        const dataTransfer = new DataTransfer();
                        const newFiles = Array.from(input.files).filter((_, i) =>
                            i !== index);
                        newFiles.forEach(f => dataTransfer.items.add(f));
                        input.files = dataTransfer.files;
                        wrapper.remove();
                    });

                    wrapper.appendChild(img);
                    wrapper.appendChild(removeBtn);
                    previewContainer.appendChild(wrapper);
                };
                reader.readAsDataURL(file);
            });
        });
    });
</script>
