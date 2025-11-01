<x-guest-layout>
    <div class="w-[60vw] flex items-center justify-center bg-gray-100 min-h-screen">
        <div class="w-full max-w-md p-8 bg-white rounded-xl shadow-md">
            <div class="flex flex-col items-center mb-6">
                <div class="flex">
                    {{-- <img src="img/logo.png" alt="" class="w-auto h-6"> --}}
                    <h1 class="text-2xl font-poppins font-bold text-gray-800">Famthology</h1>
                </div>

                <p class="text-gray-500 font-light text-xs">Family Tree chart</p>
            </div>

            <h2 class="text-xl font-semibold text-center text-blue-600 mb-6">
                Buat Akun Baru ✨
            </h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Nama Lengkap -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-poppins font-medium text-gray-700">Nama Lengkap</label>
                    <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                        class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                    <x-input-error :messages="$errors->get('name')" class="mt-1 text-red-500 text-sm" />
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-poppins font-medium text-gray-700">Alamat Email</label>
                    <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username"
                        class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-500 text-sm" />
                </div>

                <!-- Password -->
                <div class="mb-4 relative">
                    <label for="password" class="block text-sm font-poppins font-medium text-gray-700">Kata Sandi</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                        class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm pr-10 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                    <button type="button" onclick="togglePassword('password', 'eyeIcon1')"
                        class="absolute right-3 top-[38px] text-gray-500 hover:text-blue-500 focus:outline-none">
                        <svg id="eyeIcon1" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-500 text-sm" />
                </div>

                <!-- Konfirmasi Password -->
                <div class="mb-6 relative">
                    <label for="password_confirmation" class="block text-sm font-poppins font-medium text-gray-700">Konfirmasi Kata Sandi</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                        class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm pr-10 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                    <button type="button" onclick="togglePassword('password_confirmation', 'eyeIcon2')"
                        class="absolute right-3 top-[38px] text-gray-500 hover:text-blue-500 focus:outline-none">
                        <svg id="eyeIcon2" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 06 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-red-500 text-sm" />
                </div>

                <!-- Tombol Daftar -->
                <div>
                    <button type="submit"
                        class="w-full py-2 px-4 bg-blue-500 text-white font-medium font-sans rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300">
                        Daftar Sekarang
                    </button>
                </div>

                <p class="w-full text-center py-2">-- or --</p>

                <!-- Login dengan Google -->
                <div class="flex w-full justify-center">
                    <a href="{{ route('google.login') }}"
                        class="inline-flex items-center px-4 py-2 border hover:border-2 hover:border-gray-300 gap-2 shadow-sm rounded-lg transition-all duration-200 ease-linear">
                        <svg xml:space="preserve" style="enable-background:new 0 0 512 512;" viewBox="0 0 512 512"
                            y="0px" x="0px" xmlns:xlink="http://www.w3.org/1999/xlink"
                            xmlns="http://www.w3.org/2000/svg" id="Layer_1" width="20" version="1.1">
                            <path d="M113.47,309.408L95.648,375.94l-65.139,1.378C11.042,341.211,0,299.9,0,256
                                c0-42.451,10.324-82.483,28.624-117.732h0.014l57.992,10.632l25.404,57.644c-5.317,15.501-8.215,32.141-8.215,49.456
                                C103.821,274.792,107.225,292.797,113.47,309.408z" style="fill:#FBBB00;"></path>
                            <path
                                d="M507.527,208.176C510.467,223.662,512,239.655,512,256c0,18.328-1.927,36.206-5.598,53.451
                                c-12.462,58.683-45.025,109.925-90.134,146.187l-0.014-0.014l-73.044-3.727l-10.338-64.535
                                c29.932-17.554,53.324-45.025,65.646-77.911h-136.89V208.176h138.887L507.527,208.176L507.527,208.176z"
                                style="fill:#518EF8;"></path>
                            <path d="M416.253,455.624l0.014,0.014C372.396,490.901,316.666,512,256,512
                                c-97.491,0-182.252-54.491-225.491-134.681l82.961-67.91c21.619,57.698,77.278,98.771,142.53,98.771
                                c28.047,0,54.323-7.582,76.87-20.818L416.253,455.624z" style="fill:#28B446;"></path>
                            <path d="M419.404,58.936l-82.933,67.896c-23.335-14.586-50.919-23.012-80.471-23.012
                                c-66.729,0-123.429,42.957-143.965,102.724l-83.397-68.276h-0.014C71.23,56.123,157.06,0,256,0
                                C318.115,0,375.068,22.126,419.404,58.936z" style="fill:#F14336;"></path>
                        </svg>
                        <span class="font-medium font-sans text-gray-500">Daftar dengan Google</span>
                    </a>
                </div>
            </form>

            <div class="text-center mt-6 font-poppins">
                <p class="text-sm text-gray-600">
                    Sudah punya akun?
                    <a href="{{ route('login') }}"
                       class="text-blue-600 font-medium hover:underline hover:text-blue-700 transition">
                       Masuk di sini
                    </a>
                </p>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            if (input.type === "password") {
                input.type = "text";
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.957 9.957 0 012.519-4.042M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3l18 18" />
                `;
            } else {
                input.type = "password";
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                `;
            }
        }
    </script>
</x-guest-layout>
