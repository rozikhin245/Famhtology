<x-app-layout>
    {{-- header --}}
    <div class="flex flex-col w-full justify-start items-start px-4 mb-8">
        <h1 class="font-poppins text-2xl font-bold text-gray-800">Update Family Member</h1>
        <p class="text-sm text-gray-600 mt-1">Edit and update the family member's profile.</p>
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
        <div class="p-4">
            <h1 class="font-poppins text-xl font-bold text-gray-800 mb-5">Edit Member</h1>
            <form action="{{ route('FamilyMembers.update', $FamilyMember) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')


                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">

                    {{-- Full Name --}}
                    <div class="w-full">
                        <label for="Full_name" class="block mb-2 text-sm font-medium text-gray-900">Full Name</label>
                        <input type="text" name="Full_name" id="Full_name"
                            value="{{ old('Full_name', $FamilyMember->Full_name ?? '') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder="Input Full Name" required>
                    </div>

                    {{-- Nick Name --}}
                    <div class="w-full">
                        <label for="Nick_name" class="block mb-2 text-sm font-medium text-gray-900">Nick Name</label>
                        <input type="text" name="Nick_name" id="Nick_name"
                            value="{{ old('Nick_name', $FamilyMember->Nick_name ?? '') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder="Input Nick Name">
                    </div>

                    {{-- Gender --}}
                    <div>
                        <label for="gender" class="block mb-2 text-sm font-medium text-gray-900">Gender</label>
                        <select id="gender" name="gender"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                            <option disabled hidden
                                {{ old('gender', $FamilyMember->gender ?? '') == '' ? 'selected' : '' }}>
                                Select Gender</option>
                            <option value="L"
                                {{ old('gender', $FamilyMember->gender ?? '') == 'L' ? 'selected' : '' }}>
                                Laki - Laki</option>
                            <option value="P"
                                {{ old('gender', $FamilyMember->gender ?? '') == 'P' ? 'selected' : '' }}>
                                Perempuan</option>
                        </select>
                    </div>

                    {{-- Domisili --}}
                    <div class="w-full">
                        <label for="domisili" class="block mb-2 text-sm font-medium text-gray-900">Living
                            location</label>
                        <input type="text" name="domisili" id="domisili"
                            value="{{ old('domisili', $FamilyMember->domisili ?? '') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder="Input Living location" required>
                    </div>

                    {{-- Parent --}}
                    <div>
                        <label for="parent_id" class="block mb-2 text-sm font-semibold text-gray-700">Parent
                            Relationship</label>
                        <select name="parent_id"
                            class="w-full p-3 text-sm text-gray-900 border rounded-xl border-gray-300 bg-white focus:ring-2 focus:ring-slate-200 focus:outline-none">
                            <option value="">- Select parent relationship -</option>
                            @foreach ($families as $fam)
                                    <option value="{{ $fam->id }}"
                                        {{ old('parent_id', $FamilyMember->parent_id ?? '') == $fam->id ? 'selected' : '' }}>
                                        {{ $fam->Full_name }}
                                    </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Spouse --}}
                    <div>
                        <label for="spouse_id" class="block mb-2 text-sm font-semibold text-gray-700">Spouse
                            Relationship</label>
                        <select name="spouse_id"
                            class="w-full p-3 text-sm text-gray-900 border rounded-xl border-gray-300 bg-white focus:ring-2 focus:ring-primary-500 focus:outline-none">
                            <option value="">- Select spouse relationship -</option>
                            @foreach ($families as $fam)
                                <option value="{{ $fam->id }}"
                                    {{ old('spouse_id', $FamilyMember->spouse_id ?? '') == $fam->id ? 'selected' : '' }}>
                                    {{ $fam->Full_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {{-- Photo --}}
                <div class="mt-4 w-full">
                    <div>
                        <label for="status" class="block mb-2 text-sm font-medium text-gray-900">Status</label>
                        <select id="gender" name="gender"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                            <option disabled hidden>Pilih status</option>
                            <option value="approved">
                                approved</option>
                            <option value="rejected">
                                rejected</option>
                        </select>
                    </div>

                    <label for="photo" class="block mb-2 text-sm font-medium text-gray-900">Upload Photo</label>

                    @if (isset($family) && $FamilyMember->photo)
                        <div class="mb-2">
                            <p class="text-sm text-gray-700 mb-1">Current Photo:</p>
                            <img src="{{ asset('storage/' . $FamilyMember->photo) }}" alt="Current photo"
                                class="w-32 h-32 object-cover rounded-lg border">
                        </div>
                    @endif

                    <input type="file" name="photo" id="photo" accept="image/*"
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary-500">

                    <img id="preview-photo" class="mt-4 w-32 h-32 object-cover hidden" />

                    <script>
                        document.getElementById('photo').addEventListener('change', function(event) {
                            const [file] = event.target.files;
                            const preview = document.getElementById('preview-photo');
                            const label = document.getElementById('new-photo-label');

                            if (file) {
                                preview.src = URL.createObjectURL(file);
                                preview.classList.remove('hidden');

                                if (label) {
                                    label.classList.remove('hidden');
                                }
                            } else {
                                preview.classList.add('hidden');

                                if (label) {
                                    label.classList.add('hidden');
                                }
                            }
                        });
                    </script>


                    <p class="mt-1 text-xs text-gray-500 italic">PNG, JPG, JPEG (Max: 2MB)</p>
                    @error('photo')
                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>


                <button type="submit"
                    class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-black bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 hover:bg-primary-800">
                    Update Member
                </button>
            </form>
        </div>
    </section>
</x-app-layout>
