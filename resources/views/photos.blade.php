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
    <div class="min-h-screen bg-gray-50 py-10 px-4 md:px-10">
        <!-- Header -->
        <div class="max-w-7xl mx-auto mb-8">
            <a href="{{ route('welcome') }}" class="text-blue-600 hover:underline text-sm">&larr; Kembali ke Beranda</a>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mt-4">
                Album: <span class="text-blue-700 italic underline">{{ $albumDashboard->name }}</span>
            </h1>
        </div>

        <!-- Controls -->
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <p class="text-gray-600">Jumlah foto : {{ $photos->count() }}</p>
            <div class="flex space-x-3">
                <button onclick="selectView('grid')"
                    class="px-4 py-2 rounded-md text-sm font-medium border border-gray-300 bg-white hover:bg-gray-100 focus:ring-2 focus:ring-blue-300">
                    Icon View
                </button>
                <button onclick="selectView('list')"
                    class="px-4 py-2 rounded-md text-sm font-medium border border-gray-300 bg-white hover:bg-gray-100 focus:ring-2 focus:ring-blue-300">
                    List View
                </button>
            </div>
        </div>

        <!-- Grid View -->
        <div id="gridView"
            class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6 max-w-7xl mx-auto">
            @forelse ($photos as $photo)
                <div
                    class="bg-transparent hover:bg-gray-200 hover:bg-opacity-30 hover:rounded-lg hover:shadow-md overflow-hidden transition-all duration-300 ease-in-out">
                    <img src="{{ asset('storage/photos/' . $photo->name) }}" alt="{{ $photo->name }}"
                        onclick="openModal('{{ asset('storage/photos/' . $photo->name) }}')"
                        class="w-full h-48 object-cover cursor-pointer">
                    <div class="p-4">
                        <p class="text-sm text-gray-800 font-medium truncate mb-3">{{ $photo->name }}</p>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20 text-gray-500">
                    <svg class="mx-auto h-12 w-12 mb-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 10.5L18 12.75M18 12.75l2.25-2.25M18 12.75l-2.25 2.25M3 6.75A2.25 2.25 0 015.25 4.5h13.5A2.25 2.25 0 0121 6.75v10.5A2.25 2.25 0 0118.75 19.5H5.25A2.25 2.25 0 013 17.25V6.75z" />
                    </svg>
                    <p class="text-lg font-semibold">Belum ada foto di album ini.</p>
                    <p class="text-sm text-gray-400">Silakan unggah foto kenangan keluarga untuk mengisi album ini.</p>
                </div>
            @endforelse

        </div>

        <!-- List View -->
        <div id="listView" class="hidden mt-10 max-w-7xl mx-auto">
            <div class="overflow-x-auto bg-white shadow border border-gray-200 rounded-lg">
                <table class="min-w-full divide-y divide-gray-100">
                    <thead class="bg-gray-50 text-gray-600 text-sm font-semibold">
                        <tr>
                            <th class="px-6 py-3 text-left">Foto</th>
                            <th class="px-6 py-3 text-left">Nama File</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm text-gray-800">
                        @forelse ($photos as $photo)
                            <tr onclick="openModal('{{ asset('storage/photos/' . $photo->name) }}')"
                                class="hover:bg-gray-50 cursor-pointer">
                                <td class="px-6 py-3">
                                    <img src="{{ asset('storage/photos/' . $photo->name) }}" alt="{{ $photo->name }}"
                                        class="h-14 w-14 object-cover rounded-md">
                                </td>
                                <td class="px-6 py-3">{{ $photo->name }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="py-20 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center space-y-3">
                                        <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                            stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 10.5L18 12.75M18 12.75l2.25-2.25M18 12.75l-2.25 2.25M3 6.75A2.25 2.25 0 015.25 4.5h13.5A2.25 2.25 0 0121 6.75v10.5A2.25 2.25 0 0118.75 19.5H5.25A2.25 2.25 0 013 17.25V6.75z" />
                                        </svg>
                                        <p class="text-lg font-semibold">Belum ada foto yang ditambahkan.</p>
                                        <p class="text-sm text-gray-400">Silakan unggah foto keluarga untuk mengisi
                                            album ini.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div id="photoModal"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-70 backdrop-blur-sm transition-all duration-300 ease-in-out hidden">
            <div
                class="relative w-full max-w-5xl mx-auto rounded-xl overflow-hidden shadow-2xl bg-white bg-opacity-5 backdrop-blur-lg p-0">

                <!-- Tombol Close (kanan atas) -->
                <button onclick="closeModal()"
                    class="absolute top-4 right-4 bg-white bg-opacity-90 hover:bg-red-100 text-gray-800 hover:text-red-600 p-2 rounded-full shadow-lg transition"
                    title="Tutup">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <!-- Gambar -->
                <img id="modalImage" src="" alt="Foto Preview"
                    class="w-full max-h-[80vh] object-contain bg-white rounded-md transition-all duration-300 ease-in-out">

                <!-- Tombol Download (kanan bawah) -->
                <a id="downloadBtn" href="#" download
                    class="absolute bottom-4 right-4 bg-white bg-opacity-90 text-gray-800 hover:bg-blue-100 px-4 py-2 rounded-md shadow-lg flex items-center gap-2 text-sm font-medium transition"
                    title="Unduh Foto Ini">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V4" />
                    </svg>
                    Unduh
                </a>
            </div>
        </div>


    </div>

    <!-- Script -->
    <script>
        function selectView(mode) {
            document.getElementById('gridView').classList.toggle('hidden', mode !== 'grid');
            document.getElementById('listView').classList.toggle('hidden', mode !== 'list');
        }

        function openModal(url) {
            document.getElementById('modalImage').src = url;
            document.getElementById('photoModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('photoModal').classList.add('hidden');
            document.getElementById('modalImage').src = '';
            document.getElementById('downloadBtn').href = '#';
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === "Escape") closeModal();
        });

        function openModal(url) {
            document.getElementById('modalImage').src = url;
            document.getElementById('downloadBtn').href = url;
            document.getElementById('photoModal').classList.remove('hidden');
        }
    </script>






    @include('dashboard.footer')

    <!-- Flowbite JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
</body>


</html>
