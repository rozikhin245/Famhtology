<aside id="default-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen bg-white shadow-sm transition-transform -translate-x-full sm:translate-x-0"
    aria-label="Sidenav">
    <div class="flex flex-col h-full px-4 justify-between">
        <div>
            <div class="flex items-center p-2 rounded-xl hover:bg-gray-100 transition my-3 cursor-pointer">
                <!-- Branding Text -->
                <div class="flex flex-col leading-tight">
                    <span class="text-2xl font-bold text-gray-900 font-poppins">
                        <span class="text-blue-700">Famthology</span>
                    </span>
                    <span class="text-sm text-gray-500 font-light tracking-wide">Family Tree chart</span>
                </div>
            </div>
            <!-- Sections -->
            <div class="text-xs font-bold text-gray-500 uppercase mt-3 mb-2">Home</div>
            <ul class="mb-6 space-y-3">
                <li>
                    <a href="{{ route('FamilyMembers.index') }}"
                        class="group flex items-center gap-3 px-4 py-2 rounded-lg transition-all duration-200
                            {{ request()->routeIs('FamilyMembers.index')
                                ? 'bg-white shadow-[inset_0_-3px_0_0_rgba(0,0,0,0.1)] text-blue-700 font-medium'
                                : 'text-gray-700 hover:bg-gray-100' }}">

                        <!-- Icon -->
                        <svg class="w-5 h-5 {{ request()->routeIs('FamilyMembers.index') ? 'text-blue-700' : 'text-gray-500 group-hover:text-gray-700' }}"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z"
                                clip-rule="evenodd" />
                        </svg>

                        <!-- Label -->
                        <span class="font-poppins text-sm">
                            Family Members
                        </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('albums.index') }}"
                        class="group flex items-center gap-3 px-4 py-2 rounded-lg transition-all duration-200
                            {{ request()->routeIs('albums.index')
                                ? 'bg-white shadow-[inset_0_-3px_0_0_rgba(0,0,0,0.1)] text-blue-700 font-medium'
                                : 'text-gray-700 hover:bg-gray-100' }}">

                        <!-- Icon -->
                        <svg class="w-5 h-5 {{ request()->routeIs('albums.index') ? 'text-blue-700' : 'text-gray-500 group-hover:text-gray-700' }}"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M5 4a2 2 0 0 0-2 2v1h10.968l-1.9-2.28A2 2 0 0 0 10.532 4H5ZM3 19V9h18v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm9-8.5a1 1 0 0 1 1 1V13h1.5a1 1 0 1 1 0 2H13v1.5a1 1 0 1 1-2 0V15H9.5a1 1 0 1 1 0-2H11v-1.5a1 1 0 0 1 1-1Z"
                                clip-rule="evenodd" />
                        </svg>

                        <!-- Label -->
                        <span class="font-poppins text-sm">
                            Albums Photo
                        </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('activity.index') }}"
                        class="group flex items-center gap-3 px-4 py-2 rounded-lg transition-all duration-200
                            {{ request()->routeIs('activity.index')
                                ? 'bg-white shadow-[inset_0_-3px_0_0_rgba(0,0,0,0.1)] text-blue-700 font-medium'
                                : 'text-gray-700 hover:bg-gray-100' }}">

                        <!-- Icon -->
                        <svg class="w-5 h-5 {{ request()->routeIs('activity.index') ? 'text-blue-700' : 'text-gray-500 group-hover:text-gray-700' }}"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M18 5.05h1a2 2 0 0 1 2 2v2H3v-2a2 2 0 0 1 2-2h1v-1a1 1 0 1 1 2 0v1h3v-1a1 1 0 1 1 2 0v1h3v-1a1 1 0 1 1 2 0v1Zm-15 6v8a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-8H3ZM11 18a1 1 0 1 0 2 0v-1h1a1 1 0 1 0 0-2h-1v-1a1 1 0 1 0-2 0v1h-1a1 1 0 1 0 0 2h1v1Z"
                                clip-rule="evenodd" />
                        </svg>

                        <!-- Label -->
                        <span class="font-poppins text-sm">
                            Activity Schedule
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('users.index') }}"
                        class="group flex items-center gap-3 px-4 py-2 rounded-lg transition-all duration-200
                            {{ request()->routeIs('users.index')
                                ? 'bg-white shadow-[inset_0_-3px_0_0_rgba(0,0,0,0.1)] text-blue-700 font-medium'
                                : 'text-gray-700 hover:bg-gray-100' }}">

                        <!-- Icon -->
                        <svg class="w-5 h-5 {{ request()->routeIs('users.index') ? 'text-blue-700' : 'text-gray-500 group-hover:text-gray-700' }}"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M18 5.05h1a2 2 0 0 1 2 2v2H3v-2a2 2 0 0 1 2-2h1v-1a1 1 0 1 1 2 0v1h3v-1a1 1 0 1 1 2 0v1h3v-1a1 1 0 1 1 2 0v1Zm-15 6v8a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-8H3ZM11 18a1 1 0 1 0 2 0v-1h1a1 1 0 1 0 0-2h-1v-1a1 1 0 1 0-2 0v1h-1a1 1 0 1 0 0 2h1v1Z"
                                clip-rule="evenodd" />
                        </svg>

                        <!-- Label -->
                        <span class="font-poppins text-sm">
                            Manage users

                        </span>
                    </a>
                </li>
            </ul>
        </div>


        {{-- ini kenapa gk muncul yaa? --}}
        <div class="mb-5">
            <div id="dropdownTopButton" data-dropdown-toggle="dropdownTop" data-dropdown-placement="top"
                class="flex flex-row h-[36px] w-full rounded-[4px] hover:bg-gray-100 border-2 border-gray-100 ease-in-out cursor-pointer ">
                <div class="w-9 h-9 flex items-center justify-center rounded-[5px] bg-blue-100 overflow-hidden">
                    <p class="text-sm font-semibold font-roboto text-blue-700 ">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </p>
                </div>
                <div class="flex w-full items-center justify-between mx-2">
                    <p
                        class="font-semibold text-sm text-gray-900 truncate max-w-[150px] overflow-hidden whitespace-nowrap">
                        {{ Auth::user()->name }}
                    </p>
                    <svg class="w-4 h-4 text-gray-500 flex-shrink-0" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                    </svg>
                </div>

                <div>
                    <!-- Dropdown menu -->
                    <div id="dropdownTop" class="z-10 hidden bg-white rounded-lg shadow w-60 border border-gray-200">
                        <!-- User Info -->
                        <div class="flex items-center gap-3 px-4 py-3 border-b border-gray-200">
                            <!-- Avatar dengan inisial -->
                            <div
                                class="w-10 h-10 rounded-md bg-blue-100 flex items-center justify-center text-base font-semibold text-blue-700 shadow-sm">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>

                            <!-- Info nama & email -->
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-sm text-gray-900 truncate">
                                    {{ Auth::user()->name }}
                                </p>
                                <p class="text-xs text-gray-600 truncate">
                                    {{ Auth::user()->email }}
                                </p>
                            </div>
                        </div>


                        <!-- Menu Items -->
                        <ul class="py-1 text-sm text-gray-700">
                            <li>
                                <a href="{{ route('profile.edit') }}"
                                    class="flex items-center px-4 py-2 hover:bg-gray-100 text-gray-800">
                                    <svg class="w-5 h-5 mr-2 text-gray-500" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M21 13v-2a1 1 0 0 0-1-1h-.757l-.707-1.707.535-.536a1 1 0 0 0 0-1.414l-1.414-1.414a1 1 0 0 0-1.414 0l-.536.535L14 4.757V4a1 1 0 0 0-1-1h-2a1 1 0 0 0-1 1v.757l-1.707.707-.536-.535a1 1 0 0 0-1.414 0L4.929 6.343a1 1 0 0 0 0 1.414l.536.536L4.757 10H4a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h.757l.707 1.707-.535.536a1 1 0 0 0 0 1.414l1.414 1.414a1 1 0 0 0 1.414 0l.536-.535 1.707.707V20a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-.757l1.707-.708.536.536a1 1 0 0 0 1.414 0l1.414-1.414a1 1 0 0 0 0-1.414l-.535-.536.707-1.707H20a1 1 0 0 0 1-1Z" />
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                    </svg>
                                    Settings
                                </a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="flex items-center w-full px-4 py-2 hover:bg-gray-100 text-gray-800">
                                        <svg class="w-5 h-5 mr-2 text-gray-500" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"
                                                d="M20 12H8m12 0-4 4m4-4-4-4M9 4H7a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h2" />
                                        </svg>
                                        Log Out
                                    </button>
                                </form>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</aside>
