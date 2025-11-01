<section class="bg-gradient-to-b from-white to-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 font-poppins">
        <!-- Header -->
        <div class="text-center mb-12">
            <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-3">
                Family Memories
            </h2>
            <p class="text-gray-600 text-base md:text-lg max-w-2xl mx-auto">
                Album foto kenangan keluarga yang berharga dan tak terlupakan
            </p>
        </div>

        <!-- Gallery -->
        <div class="grid gap-6">
            <!-- Highlight Image -->
            <div class="relative group overflow-hidden rounded-2xl shadow-md">
                <img src="https://flowbite.s3.amazonaws.com/docs/gallery/featured/image.jpg"
                     alt="Featured Memory"
                     class="w-full h-auto transform group-hover:scale-105 transition duration-500 ease-in-out">
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 rounded-2xl"></div>
                <div class="absolute bottom-4 left-4 text-white opacity-0 group-hover:opacity-100 transition duration-300">
                    <h3 class="font-semibold text-lg">Kebersamaan di Rumah</h3>
                    <p class="text-sm text-gray-200">Momen penuh tawa dan cerita</p>
                </div>
            </div>

            <!-- Grid Images -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
                @foreach ([
                    'https://flowbite.s3.amazonaws.com/docs/gallery/square/image-1.jpg',
                    'https://flowbite.s3.amazonaws.com/docs/gallery/square/image-2.jpg',
                    'https://flowbite.s3.amazonaws.com/docs/gallery/square/image-3.jpg',
                    'https://flowbite.s3.amazonaws.com/docs/gallery/square/image-4.jpg',
                    'https://flowbite.s3.amazonaws.com/docs/gallery/square/image-5.jpg'
                ] as $image)
                <div class="relative group overflow-hidden rounded-xl shadow-sm">
                    <img src="{{ $image }}"
                         alt="Family Memory"
                         class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500 ease-in-out">
                    <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition duration-300"></div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Include Albums Section -->
        <div class="mt-12">
            @include('dashboard.albums')
        </div>
    </div>
</section>
