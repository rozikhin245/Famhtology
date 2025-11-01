@foreach($activities as $activity)
    <div id="updateModal-{{ $activity->id }}" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative p-4 bg-white rounded-lg shadow sm:p-5">
                <!-- Modal header -->
                <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Update Activity
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                        data-modal-toggle="updateModal-{{ $activity->id }}">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <!-- Modal body -->
                <form action="{{ route('activity.update', $activity->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                            <input type="text" name="name" id="name" value="{{ $activity->name }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Masukkan nama agenda">
                        </div>

                        <div>
                            <label for="location" class="block mb-2 text-sm font-medium text-gray-900">Location</label>
                            <input type="text" name="location" id="location" value="{{ $activity->location }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Lokasi event">
                        </div>

                        <div>
                            <label for="date" class="block mb-2 text-sm font-medium text-gray-900">Date</label>
                            <input type="date" name="date" id="date" value="{{ $activity->date }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        </div>

                        <div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="start_time" class="block mb-2 text-sm font-medium text-gray-900">Start time</label>
                                    <div class="relative">
                                        <input type="time" id="start_time" name="start_time"
                                            value="{{ $activity->start_time }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                            focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    </div>
                                </div>

                                <div>
                                    <label for="end_time" class="block mb-2 text-sm font-medium text-gray-900">End time</label>
                                    <div class="relative">
                                        <input type="time" id="end_time" name="end_time"
                                            value="{{ $activity->end_time }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                            focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Album -->
                        <div class="sm:col-span-2">
                            <label for="album_id" class="block mb-2 text-sm font-medium text-gray-900">Album kegiatan</label>
                            <select name="album_id" id="album_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="">-- Pilih Album --</option>
                                @foreach ($albums as $album)
                                    <option value="{{ $album->id }}"
                                        {{ old('album_id', $activity->album_id) == $album->id ? 'selected' : '' }}>
                                        {{ $album->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Notes -->
                        <div class="sm:col-span-2">
                            <label class="block mb-2 text-sm font-medium text-gray-900">Notes</label>
                            <div id="notes-wrapper-{{ $activity->id }}" class="space-y-2">
                                @foreach (json_decode($activity->notes ?? '[]', true) as $note)
                                    <div class="flex gap-2">
                                        <input type="text" name="notes[]" value="{{ $note }}"
                                            placeholder="Masukkan catatan"
                                            class="flex-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5
                                            focus:ring-blue-500 focus:border-blue-500">
                                        <button type="button" onclick="this.parentElement.remove()"
                                            class="px-3 py-2 bg-red-500 text-white rounded-lg">-</button>
                                    </div>
                                @endforeach
                                <div class="flex gap-2">
                                    <input type="text" name="notes[]" placeholder="Masukkan catatan baru"
                                        class="flex-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5
                                        focus:ring-blue-500 focus:border-blue-500">
                                    <button type="button" onclick="editNoteInput({{ $activity->id }})"
                                        class="px-3 py-2 bg-green-500 text-white rounded-lg">+</button>
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        {{-- <div class="sm:col-span-2">
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                            <textarea id="description" name="description" rows="5"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border
                                border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Write a description...">{{ $activity->description }}</textarea>
                        </div> --}}
                    </div>

                    <div class="flex items-center space-x-4 mt-4">
                        <button type="submit"
                            class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none
                            focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Update Activity
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

<script>
    function editNoteInput(id) {
        const wrapper = document.getElementById(`notes-wrapper-${id}`);
        const inputGroup = document.createElement('div');
        inputGroup.classList.add('flex', 'gap-2');
        inputGroup.innerHTML = `
            <input type="text" name="notes[]" placeholder="Masukkan catatan"
                class="flex-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5
                focus:ring-blue-500 focus:border-blue-500">
            <button type="button" onclick="this.parentElement.remove()"
                class="px-3 py-2 bg-red-500 text-white rounded-lg">-</button>
        `;
        wrapper.appendChild(inputGroup);
    }
</script>
