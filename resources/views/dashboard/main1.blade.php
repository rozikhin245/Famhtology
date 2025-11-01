<section class="bg-slate-100 font-poppins ">
    <div class="grid max-w-screen-xl h-[45vh] px-6 py-12 mx-auto lg:py-24 lg:grid-cols-12 items-center gap-12">
        <!-- TEXT -->
        <div class="lg:col-span-7 space-y-6">
            <h1 class="text-4xl md:text-5xl xl:text-6xl font-poppins font-extrabold tracking-tight leading-tight text-gray-900">
                Selamat datang di Famhtology
            </h1>
            <p class="text-lg md:text-xl font-poppins text-gray-600 max-w-2xl leading-relaxed">
                <span class="font-semibold text-blue-600">Famhtology</span> adalah Platform resmi milik
                <span class="font-semibold text-gray-800">Keluarga Besar Abd Aziz Kertotrueno</span>.
                Jelajahi silsilah keluarga, temukan hubungan antar generasi, dan pantau berbagai kegiatan yang mempererat ikatan keluarga.
            </p>

            <div class="flex flex-wrap gap-4">
                <a href="#familychart"
                    class="inline-flex items-center justify-center px-6 py-3 text-white bg-blue-500 hover:bg-blue-700 font-semibold rounded-xl shadow-md transition duration-300">
                    Tree Chart
                    <svg class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 01-1.414 1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </a>
                <a href="#" data-modal-target="default-modal" data-modal-toggle="default-modal"
                    class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-gray-800 hover:bg-gray-100 font-semibold rounded-xl transition duration-300">
                    Teaser
                </a>
                @include('dashboard.modalVidio')
            </div>
        </div>

        <!-- IMAGES -->
        <div class="hidden lg:flex lg:col-span-5 gap-4">
            <div class="flex flex-col justify-center w-1/2">
                <img class="rounded-2xl shadow-lg object-cover transition-transform duration-300 hover:scale-105"
                    src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-10.jpg" alt="Image 3">
            </div>
            <div class="flex flex-col gap-4 w-1/2 items-center justify-center">
                <img class="rounded-2xl shadow-lg object-cover transition-transform duration-300 hover:scale-105"
                    src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-9.jpg" alt="Image 1">
                <img class="rounded-2xl shadow-lg object-cover transition-transform duration-300 hover:scale-105"
                    src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-8.jpg" alt="Image 2">
            </div>
        </div>
    </div>
</section>
