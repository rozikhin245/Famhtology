<nav class="bg-white border-gray-200 shadow-lg">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">

        {{-- logo --}}
        <div class="flex flex-col leading-tight ">
            <span class="text-3xl font-bold text-gray-900 font-poppins">
                <span class="text-blue-700 cursor-pointer" style="text-shadow: 5px 5px 10px rgba(0, 0, 0, 0.137);">
                    Famthology
                </span>
            </span>
        </div>

        {{-- right button --}}
        <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
            @guest
                <a href="{{ route('login') }}"
                    class="inline-flex items-center justify-center px-6 py-2 rounded-xl text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 shadow-md transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-300 focus:ring-offset-2">
                    Login
                </a>
            @endguest

            @auth
                <div class="relative flex items-center gap-4">

                    <!-- Avatar dan Dropdown -->
                    <div class="relative">
                        <div id="dropdownTopButtonn" data-dropdown-toggle="dropdownuser" data-dropdown-placement="bottom"
                            class="flex items-center gap-2 px-3 py-2 bg-white rounded-full border border-gray-300 shadow-sm hover:shadow-md transition cursor-pointer">

                            <!-- Avatar -->
                            <div
                                class="w-8 h-8 flex items-center justify-center bg-blue-500 text-white font-semibold rounded-full text-sm">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>

                            <!-- Icon Dropdown -->
                            <svg class="w-4 h-4 text-gray-600 transition" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4 4 4-4" />
                            </svg>
                        </div>

                        <!-- Dropdown Menu -->
                        <div id="dropdownuser"
                            class="z-10 hidden absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-200">

                            <!-- User Info -->
                            <div class="flex items-center gap-3 px-4 py-3 border-b">
                                <div
                                    class="w-10 h-10 flex items-center justify-center bg-blue-100 text-blue-700 font-semibold rounded-full text-base">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                                </div>
                            </div>

                            <!-- Dropdown Items -->
                            <ul class="py-1 text-sm text-gray-700">
                                {{-- <li>
                                    <a href="{{ route('profile.edit') }}"
                                        class="flex items-center px-4 py-2 hover:bg-gray-100 text-gray-800">
                                        <svg class="w-5 h-5 mr-2 text-gray-500" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5.121 17.804A13.937 13.937 0 0112 15c2.761 0 5.304.837 7.438 2.255M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        Profil
                                    </a>
                                </li> --}}
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="flex items-center w-full px-4 py-2 hover:bg-gray-100 text-gray-800">
                                            <svg class="w-5 h-5 mr-2 text-gray-500" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1" />
                                            </svg>
                                            Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endauth





            <button data-collapse-toggle="navbar-cta" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                aria-controls="navbar-cta" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
        </div>

        {{-- navlinks --}}
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-cta">
            <ul
                class="flex flex-col md:flex-row font-poppins font-   p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-6 md:mt-0 md:border-0 md:bg-white">
                <li>
                    <a href="#"
                        class="relative block py-2 px-3 md:p-0 text-gray-900 hover:text-blue-600 transition-all duration-300 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-0 after:h-[2px] after:bg-blue-600 after:transition-all after:duration-300 hover:after:w-full">
                        Home
                    </a>
                </li>
                <li>
                    <a href="#members"
                        class="relative block py-2 px-3 md:p-0 text-gray-900 hover:text-blue-600 transition-all duration-300 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-0 after:h-[2px] after:bg-blue-600 after:transition-all after:duration-300 hover:after:w-full">
                        Member
                    </a>
                </li>
                <li>
                    <a href="#gallery"
                        class="relative block py-2 px-3 md:p-0 text-gray-900 hover:text-blue-600 transition-all duration-300 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-0 after:h-[2px] after:bg-blue-600 after:transition-all after:duration-300 hover:after:w-full">
                        Album
                    </a>
                </li>
                <li>
                    <a href="#agenda"
                        class="relative block py-2 px-3 md:p-0 text-gray-900 hover:text-blue-600 transition-all duration-300 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-0 after:h-[2px] after:bg-blue-600 after:transition-all after:duration-300 hover:after:w-full">
                        Agenda
                    </a>
                </li>
            </ul>
        </div>
    </div>

</nav>
