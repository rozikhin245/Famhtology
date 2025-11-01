<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="{{ asset('img/logo2.svg') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <!-- Alpine.js -->
    <script src="//unpkg.com/alpinejs" defer></script>

    <!-- Flowbite -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" defer></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans bg-gray-50">

    @include('dashboard.navbar2')
    {{-- headers --}}
    <div class="py-5 px-4 mx-auto max-w-screen-xl lg:py-10 lg:px-6 ">
        <div class="max-w-7xl mx-auto mb-10 px-4">
            <!-- Header + Search -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">

                <!-- Title Section -->
                <div class="space-y-2">
                    <a href="{{ route('welcome') }}"
                        class="inline-flex items-center text-blue-600 hover:text-blue-700 transition-colors text-sm font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-4 h-4 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                        Kembali ke Beranda
                    </a>

                    <div>
                        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight">
                            Anggota Keluarga
                        </h1>
                        <p class="text-gray-500 mt-2 text-sm">Lihat dan kelola seluruh anggota keluarga Anda di sini.
                        </p>
                    </div>
                </div>

                <!-- Search Bar -->
                <form action="{{ route('allmembersfamily') }}" method="GET"
                    class="w-full max-w-md relative flex items-center gap-2 bg-white  border border-gray-300 rounded-2xl px-3 py-2 shadow-sm focus-within:ring-2 focus-within:ring-blue-400 transition-all duration-200">

                    <!-- Ikon pencarian -->
                    <div class="flex items-center justify-center pl-1">
                        <svg class="w-5 h-5 text-gray-500 " xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-4.35-4.35M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0z" />
                        </svg>
                    </div>

                    <!-- Input pencarian -->
                    <input type="search" id="search" name="search"
                        class="flex-1 bg-transparent outline-none text-sm text-gray-900 placeholder-gray-400"
                        placeholder="Cari anggota keluarga..." value="{{ request('search') }}" />

                    <!-- Tombol cari -->
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-1.5 rounded-lg text-sm font-medium
                   hover:bg-blue-700 active:scale-95 transition-transform duration-150 whitespace-nowrap">
                        Cari
                    </button>
                </form>



            </div>
        </div>

        {{-- content --}}
        <div class="grid gap-8 mb-6 lg:mb-16 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ($allfamilymembers as $families)
                <div
                    class="relative w-full bg-white rounded-3xl shadow-md hover:shadow-2xl hover:-translate-y-1 transition-all duration-500 overflow-hidden">
                    <!-- Header Foto/Icon -->
                    <div
                        class="relative h-48 bg-gradient-to-br from-blue-100 to-indigo-200 flex items-center justify-center rounded-t-3xl overflow-hidden">

                        {{-- Jika ada foto --}}
                        @if ($families->photo)
                            <div class="absolute inset-0 z-0">
                                <!-- Gambar background blur -->
                                <img src="{{ asset('storage/' . $families->photo) }}" alt="{{ $families->photo }}"
                                    class="w-full h-full object-cover blur-sm scale-110 opacity-90" />

                                <!-- Overlay gelap halus -->
                                <div class="absolute inset-0 bg-black/40"></div>
                            </div>

                            <!-- Gambar utama -->
                            <div class="absolute inset-0 flex items-center justify-center z-10">
                                <img src="{{ asset('storage/' . $families->photo) }}" alt="{{ $families->photo }}"
                                    class="h-40 w-40 object-cover rounded-full border-4 border-white shadow-lg">
                            </div>
                        @else
                            <div
                                class="z-10 flex items-center justify-center w-24 h-24 rounded-full bg-white/30 backdrop-blur-md shadow-md">
                                <svg class="w-12 h-12 text-white/80 drop-shadow-lg" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5.121 17.804A13.937 13.937 0 0112 15c2.042 0 3.97.457 5.879 1.274M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                        @endif
                    </div>

                    <!-- Konten -->
                    <div class="px-6 py-5 space-y-4">
                        <div class="text-center">
                            <h3
                                class="text-xl font-bold capitalize text-gray-800 font-poppins transition-all duration-300 group-hover:text-blue-600">
                                {{ $families->Full_name }}
                            </h3>
                            <p class="text-sm text-gray-500 font-poppins italic">
                                {{ $families->Nick_name ?? '---' }}
                            </p>
                        </div>

                        <div class="space-y-2 text-sm text-gray-700 font-poppins">
                            <div class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 13V7a2 2 0 00-2-2H6a2 2 0 00-2 2v6m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6" />
                                </svg>
                                <span>Gender:
                                    <strong>{{ $families->gender === 'P' ? 'Perempuan' : 'Laki-laki' }}</strong></span>
                            </div>

                            <div class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13 21.314l-4.657-4.657A8 8 0 1117.657 16.657z" />
                                </svg>
                                <span>Domisili: <strong>{{ $families->domisili ?? '-' }}</strong></span>
                            </div>

                            <div class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                <span>Orang Tua:
                                    @if ($families->parent)
                                        <strong>{{ $families->parent->Full_name }}</strong>
                                    @else
                                        <span class="text-red-400 italic">Tidak ada</span>
                                    @endif
                                </span>
                            </div>

                            <div class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 10h4.586a1 1 0 01.707 1.707l-5.586 5.586a1 1 0 01-1.414 0l-5.586-5.586A1 1 0 015.414 10H10V5a1 1 0 011-1h2a1 1 0 011 1v5z" />
                                </svg>
                                <span>Pasangan:
                                    @if ($families->spouse)
                                        <strong>{{ $families->spouse->Full_name }}</strong>
                                    @else
                                        <span class="text-red-400 italic">Belum ada</span>
                                    @endif
                                </span>
                            </div>

                            <div class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                <span>Kode Generasi: <strong>{{ $families->generation_code }}</strong></span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Pagination Section -->
        @if ($allfamilymembers->hasPages())
        <div class="flex flex-col sm:flex-row items-center justify-center text-gray-700 text-sm mt-10">

            <div
                class="flex flex-col sm:flex-row items-center justify-between gap-4 bg-white border border-blue-200 rounded-2xl shadow-md px-6 py-4 w-full max-w-3xl">

                <!-- Info Data -->
                <span class="text-sm text-gray-600">
                    Menampilkan
                    <strong class="text-blue-600">{{ $allfamilymembers->firstItem() }}</strong> –
                    <strong class="text-blue-600">{{ $allfamilymembers->lastItem() }}</strong> dari
                    <strong class="text-blue-600">{{ $allfamilymembers->total() }}</strong> anggota keluarga
                </span>

                <!-- Navigasi Pagination -->
                <div class="flex items-center space-x-2">

                    {{-- Tombol Sebelumnya --}}
                    @if ($allfamilymembers->onFirstPage())
                        <span
                            class="px-3 py-2 text-blue-300 bg-blue-50 border border-blue-200 rounded-lg cursor-not-allowed">
                            &laquo;
                        </span>
                    @else
                        <a href="{{ $allfamilymembers->previousPageUrl() }}"
                            class="px-3 py-2 text-blue-600 bg-white border border-blue-300 rounded-lg hover:bg-blue-100 hover:shadow-sm transition">
                            &laquo;
                        </a>
                    @endif

                    {{-- Nomor Halaman --}}
                    @foreach ($allfamilymembers->getUrlRange(1, $allfamilymembers->lastPage()) as $page => $url)
                        @if ($page == $allfamilymembers->currentPage())
                            <span
                                class="px-3 py-2 bg-blue-600 text-white font-semibold rounded-lg border border-blue-600 shadow-sm">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}"
                                class="px-3 py-2 text-blue-600 bg-white border border-blue-300 rounded-lg hover:bg-blue-100 hover:text-blue-800 hover:shadow-sm transition">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach

                    {{-- Tombol Berikutnya --}}
                    @if ($allfamilymembers->hasMorePages())
                        <a href="{{ $allfamilymembers->nextPageUrl() }}"
                            class="px-3 py-2 text-blue-600 bg-white border border-blue-300 rounded-lg hover:bg-blue-100 hover:shadow-sm transition">
                            &raquo;
                        </a>
                    @else
                        <span
                            class="px-3 py-2 text-blue-300 bg-blue-50 border border-blue-200 rounded-lg cursor-not-allowed">
                            &raquo;
                        </span>
                    @endif
                </div>
            </div>

        </div>
    @endif

    </div>

    @include('dashboard.footer')

    <!-- Flowbite JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
</body>


</html>
