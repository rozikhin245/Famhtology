<x-app-layout>
    {{-- header --}}
    <div class="flex flex-col lg:flex-row lg:items-center justify-between px-4 mt-4 space-y-4 lg:space-y-0 lg:space-x-6">
        <div class="flex flex-col items-start">
            <h1 class="font-poppins text-2xl font-bold text-gray-800">Family Members</h1>
            <p class="text-sm text-gray-600 mt-1">Manage your family members or family tree</p>
        </div>

        {{-- menus Group --}}
        <div class="inline-flex rounded-md shadow-sm overflow-hidden">
            <a href="{{ route('FamilyMembers.index') }}"
                class="flex px-4 py-2 text-sm font-medium transition-colors duration-200 items-center gap-1 text-center
                {{ Route::is('FamilyMembers.index') ? 'bg-blue-700 text-white' : 'bg-white text-gray-900 hover:bg-blue-700 hover:text-white' }}">
                <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M8 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H6Zm7.25-2.095c.478-.86.75-1.85.75-2.905a5.973 5.973 0 0 0-.75-2.906 4 4 0 1 1 0 5.811ZM15.466 20c.34-.588.535-1.271.535-2v-1a5.978 5.978 0 0 0-1.528-4H18a4 4 0 0 1 4 4v1a2 2 0 0 1-2 2h-4.535Z"
                        clip-rule="evenodd" />
                </svg>

                Members
            </a>

            <a href="{{ route('chart') }}"
                class="flex px-4 py-2 text-sm font-medium transition-colors duration-200 items-center gap-1 text-center
                {{ Route::is('chart') ? 'bg-blue-700 text-white' : 'bg-white text-gray-900 hover:bg-blue-700 hover:text-white' }}">
                <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M8 3a3 3 0 0 0-1 5.83v6.34a3.001 3.001 0 1 0 2 0V15a2 2 0 0 1 2-2h1a5.002 5.002 0 0 0 4.927-4.146A3.001 3.001 0 0 0 16 3a3 3 0 0 0-1.105 5.79A3.001 3.001 0 0 1 12 11h-1c-.729 0-1.412.195-2 .535V8.83A3.001 3.001 0 0 0 8 3Z" />
                </svg>
                Family Tree
            </a>
        </div>
    </div>



    <div class="flex ">
        @yield('section')
    </div>



</x-app-layout>
