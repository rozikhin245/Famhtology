<section id="members" class="bg-white mt[-40px] rounded-t-3xl shadow-inner">
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">
        <div class="mx-auto max-w-screen-lg text-center mb-8 lg:mb-16 font-poppins">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 ">Beloved Family</h2>
            <p class="font-light text-gray-500 lg:mb-16 sm:text-xl">
                Celebrating the love, strength, and connections that bind our family together. Here we honor the
                memories, share laughter, and build a future filled with warmth and support.
            </p>
        </div>
        <div class="grid gap-8 mb-6 lg:mb-16 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($family as $families)
                <div class="relative w-full bg-white rounded-3xl shadow-md transition-all duration-500 overflow-hidden">
                    <!-- Header Foto/Icon -->
                    <div
                        class="relative h-48 bg-gradient-to-br bg-gray-200 flex items-center justify-center group transition-all duration-300 rounded-t-3xl overflow-hidden">

                        {{-- Jika ada foto, tampilkan gambar --}}
                        @if ($families->photo)
                            <div class="absolute inset-0 z-0">
                                <!-- Gambar background blur -->
                                <img src="{{ asset('storage/' . $families->photo) }}" alt="{{ $families->photo }}"
                                    class="w-full h-full object-cover blur-sm scale-110" />

                                <!-- Overlay gelap opsional agar foreground lebih jelas -->
                                <div class="absolute inset-0 bg-slate-500/50"></div>
                            </div>

                            <!-- Gambar utama -->
                            <div class="absolute inset-0 flex items-center justify-center z-10">
                                <img src="{{ asset('storage/' . $families->photo) }}" alt="{{ $families->photo }}"
                                    class="h-full w-auto object-contain drop-shadow-lg rounded-xl" />
                            </div>
                        @else
                            <div
                                class="z-10 flex items-center justify-center w-24 h-24 rounded-full bg-white/20 backdrop-blur-sm shadow-md">
                                <svg id="modalIcon" class="w-12 h-12 text-white drop-shadow-lg"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5.121 17.804A13.937 13.937 0 0112 15c2.042 0 3.97.457 5.879 1.274M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                        @endif


                    </div>

                    <!-- Konten Modal -->
                    <div class="px-8 py-6 space-y-4">
                        <div class="text-center">
                            <h3
                                class="text-2xl font-bold capitalize text-gray-800 font-poppins transition-all duration-300 group-hover:text-blue-600">
                                {{ $families->Full_name }}
                            </h3>
                            <p id="modalNickName" class="text-sm text-gray-500 font-poppins">
                                {{ $families->Nick_name ?? '---' }}
                            </p>
                        </div>
                        <div class="space-y-3">
                            <div
                                class="flex items-start gap-3 text-sm text-gray-700 font-poppins hover:text-blue-600 transition">
                                <svg class="w-5 h-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 13V7a2 2 0 00-2-2H6a2 2 0 00-2 2v6m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6" />
                                </svg>
                                <span class="capitalize">Gender:
                                    {{ $families->gender === 'P' ? 'Perempuan' : 'Laki - laki' }}
                                </span>
                            </div>
                            <div
                                class="flex items-start gap-3 text-sm font-poppins text-gray-700 hover:text-blue-600 transition">
                                <svg class="w-5 h-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13 21.314l-4.657-4.657A8 8 0 1117.657 16.657z" />
                                </svg>
                                <span class="capitalize">Domisili : {{ $families->domisili }}</span>
                            </div>
                            <div
                                class="flex items-start gap-3 text-sm font-poppins text-gray-700 hover:text-blue-600 transition">
                                <svg class="w-5 h-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                <span class="capitalize">Orang Tua :
                                    @if ($families->parent)
                                        {{ $families->parent->Full_name }}
                                    @else
                                        <span class="text-red-300 italic">No Parent</span>
                                    @endif
                                </span>
                            </div>
                            <div
                                class="flex items-start gap-3 text-sm font-poppins text-gray-700 hover:text-blue-600 transition">
                                <svg class="w-5 h-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 10h4.586a1 1 0 01.707 1.707l-5.586 5.586a1 1 0 01-1.414 0l-5.586-5.586A1 1 0 015.414 10H10V5a1 1 0 011-1h2a1 1 0 011 1v5z" />
                                </svg>
                                <span class="capitalize">Pasangan :
                                    @if ($families->spouse)
                                        {{ $families->spouse->Full_name }}
                                    @else
                                        <span class="text-red-300 italic">No Spouse</span>
                                    @endif
                                </span>
                            </div>
                            <div
                                class="flex items-start gap-3 text-sm font-poppins text-gray-700 hover:text-blue-600 transition">
                                <svg class="w-5 h-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                <span class="capitalize">Kode Generasi : {{ $families->generation_code }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="w-full flex justify-center">
            <a href="{{ route('allmembersfamily') }}"
                class="group bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm py-3 px-6 rounded-xl shadow-md transition duration-300 ease-in-out flex items-center gap-2">
                View All
                <span class="hidden group-hover:flex  transition-opacity duration-300 ease-in-out">
                    →
                </span>
            </a>
        </div>
    </div>
</section>
