<x-app-layout>
    {{-- header --}}
    <div class="flex flex-col w-full justify-start items-start px-4 mb-8">
        <h1 class="font-poppins text-2xl font-bold text-gray-800">Add Family Member</h1>
        <p class="text-sm text-gray-600 mt-1">Create and save a new family member profile.</p>
    </div>
    
    <a href="{{ route('FamilyMembers.index') }}"
        class="flex items-center justify-start w-20 gap-1 ml-4 text-sm font-medium text-gray-700">
        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m15 19-7-7 7-7" />
        </svg>
        Back
    </a>

    <section class="bg-white m-4 rounded-xl">
        <div class=" p-4">
            <h1 class="font-poppins text-xl font-bold text-gray-800 mb-5">Create Member</h1>
            <form action="{{ route('FamilyMembers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">

                    <div class="w-full">
                        <label for="Full_name" class="block mb-2 text-sm font-medium text-gray-900">Full Name</label>
                        <input type="text" name="Full_name" id="Full_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder="Input Full Name" required>
                    </div>
                    <div class="w-full">
                        <label for="Nick_name" class="block mb-2 text-sm font-medium text-gray-900">Nick Name</label>
                        <input type="text" name="Nick_name" id="Nick_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder="Input Nick Name">
                    </div>

                    <div>
                        <label for="gender" class="block mb-2 text-sm font-medium text-gray-900">Gender</label>
                        <select id="gender" name="gender"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                            <option selected="" disabled hidden>Select Gender</option>
                            <option value="L">Laki - Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="w-full">
                        <label for="domisili" class="block mb-2 text-sm font-medium text-gray-900">Living
                            location</label>
                        <input type="text" name="domisili" id="domisili"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder="Input Living location" required>
                    </div>

                    {{-- Orang Tua --}}
                    <div>
                        <label for="parent_id" class="block mb-2 text-sm font-semibold text-gray-700">Parent
                            Relationship</label>
                        <select name="parent_id"
                            class="w-full p-3 text-sm text-gray-900 border rounded-xl border-gray-300 bg-white focus:ring-2 focus:ring-slate-200 focus:outline-none">
                            <option value="">- Select parent relationship -</option>
                            @foreach ($family as $families)
                                    <!-- Filter hanya untuk Laki-laki -->
                                    <option value="{{ $families->id }}"
                                        {{ old('parent_id', $families->parent_id ?? '') == $families->id ? 'selected' : '' }}>
                                        {{ $families->Full_name }}
                                    </option>
                            @endforeach
                        </select>
                    </div>


                    {{-- Pasangan --}}
                    <div>
                        <label for="spouse_id" class="block mb-2 text-sm font-semibold text-gray-700">Spouse
                            Relationship</label>
                        <select name="spouse_id"
                            class="w-full p-3 text-sm text-gray-900 border rounded-xl border-gray-300 bg-white focus:ring-2 focus:ring-primary-500 focus:outline-none">
                            <option value="">- Select spouse relationship -</option>
                            @foreach ($family as $families)
                                <option value="{{ $families->id }}"
                                    {{ old('spouse_id', $families->spouse_id ?? '') == $families->id ? 'selected' : '' }}>
                                    {{ $families->Full_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mt-4 w-full">
                    <label for="photo" class="block mb-2 text-sm font-medium text-gray-900 " for="file_input">Upload
                        file</label>
                    <input type="file" name="photo" id="photo" accept="image/*"
                        class="block w-full text-sm text-gray-900 border border-gray-300 cursor-pointer bg-gray-50 focus:outline-none "
                        id="file_input" type="file">
                    <img id="preview-photo" class="mt-4 w-32 h-32 object-cover hidden" />

                    <script>
                        document.getElementById('photo').addEventListener('change', function(event) {
                            const [file] = event.target.files;
                            const preview = document.getElementById('preview-photo');

                            if (file) {
                                preview.src = URL.createObjectURL(file);
                                preview.classList.remove('hidden');
                            } else {
                                preview.classList.add('hidden');
                            }
                        });
                    </script>
                    <p class="mt-1 text-xs text-gray-500" id="file_input_help">PNG, JPG, JPEG (Max: 2MB)</p>
                    @error('photo')
                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit"
                    class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-black bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200  hover:bg-primary-800">
                    Add Member
                </button>
            </form>
        </div>
    </section>

</x-app-layout>
