<style>
    /* Font style */
    .font-elegant {
        font-family: 'Great Vibes', cursive;
    }

    .font-formal {
        font-family: 'Open Sans', sans-serif;
    }

    .font-title {
        font-family: 'Playfair Display', serif;
    }

    /* Animasi lembut */
    .fade-in {
        animation: fadeIn 0.6s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<section id="agenda" class="bg-gradient-to-b from-white to-blue-50">
    <div class="py-12 px-6 mx-auto max-w-screen-xl lg:py-16 lg:px-8">
        <!-- Header -->
        <div class="mx-auto max-w-screen-sm text-center mb-12 font-poppins">
            <h2 class="mb-4 text-3xl lg:text-5xl tracking-tight font-extrabold text-gray-900">
                Kegiatan Mendatang
            </h2>
            <p class="font-light text-gray-600 sm:text-lg">
                Daftar rencana kegiatan keluarga besar. Simpan dan tandai, jangan sampai terlewat!
            </p>
        </div>

        <!-- Undangan -->
        <div class="container mx-auto">
            <div class="flex flex-wrap justify-center gap-8 fade-in">
                @forelse($upcomingActivities as $activity)
                    <div
                        class="w-full sm:w-[90%] md:w-[45%] lg:w-[40%] max-w-xl bg-white/90 border border-blue-200 rounded-2xl p-8 shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300 ease-in-out backdrop-blur-sm">
                        <!-- Header -->
                        <div class="text-center mb-6">
                            <h1 class="text-4xl font-title italic text-blue-700">Undangan</h1>
                            <p class="mt-2 text-2xl font-elegant text-gray-700">
                                Keluarga Besar Abd Aziz
                            </p>
                        </div>

                        <!-- Isi -->
                        <div class="space-y-5 text-[15px] font-formal text-gray-800 leading-relaxed">
                            <p><strong>Assalamualaikum Wr. Wb</strong></p>
                            <p>
                                Dalam rangka <strong>{{ $activity->name }}</strong>, kami mohon kehadiran
                                seluruh keluarga besar pada:
                            </p>

                            <div class="space-y-2 text-sm sm:text-base">
                                <div class="flex flex-col sm:flex-row sm:items-start">
                                    <span class="font-semibold w-full sm:w-32 text-gray-700">Hari/Tanggal</span>
                                    <span class="sm:ml-2 text-gray-800">
                                        {{ \Carbon\Carbon::parse($activity->date)->translatedFormat('l, d F Y') }}
                                    </span>
                                </div>

                                <div class="flex flex-col sm:flex-row sm:items-start">
                                    <span class="font-semibold w-full sm:w-32 text-gray-700">Tempat</span>
                                    <span class="sm:ml-2 text-gray-800">
                                        {{ $activity->location }}
                                    </span>
                                </div>

                                <div class="flex flex-col sm:flex-row sm:items-start">
                                    <span class="font-semibold w-full sm:w-32 text-gray-700">Waktu</span>
                                    <span class="sm:ml-2 text-gray-800">
                                        {{ \Carbon\Carbon::parse($activity->start_time)->format('H:i') }} -
                                        {{ $activity->end_time ? \Carbon\Carbon::parse($activity->end_time)->format('H:i') : 'Selesai' }}
                                    </span>
                                </div>
                            </div>


                            <p>
                                Demikian undangan ini kami sampaikan. Atas perhatian dan kehadirannya,
                                kami ucapkan terima kasih.
                            </p>
                            <p><strong>Wassalamualaikum Wr. Wb</strong></p>

                            <!-- Catatan -->
                            @php
                                $notes = is_array($activity->notes)
                                    ? $activity->notes
                                    : json_decode($activity->notes, true);
                                $filteredNotes = array_filter($notes);
                            @endphp

                            @if (count($filteredNotes))
                                <div class="pt-4 text-sm bg-blue-50 rounded-lg p-3">
                                    <p class="font-semibold text-blue-700">Catatan:</p>
                                    <ul class="list-disc pl-6 text-gray-700">
                                        @foreach ($filteredNotes as $note)
                                            <li>{{ $note }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-center text-gray-500 mt-10">
                        Tidak ada undangan yang akan datang
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Pembatas -->
    <div class="max-w-7xl mx-auto px-6">
        <hr class="my-10 border-gray-300" />
    </div>

    <!-- Tabel Kegiatan -->
    <div class="max-w-6xl mx-auto px-6 py-6 mb-20 fade-in">
        <h1 class="mb-4 font-poppins text-3xl font-bold text-gray-800 border-b-2 border-blue-500 pb-2">
            Aktivitas Terbaru
        </h1>

        <div class="overflow-x-auto rounded-lg shadow-lg bg-white/90 backdrop-blur-sm">
            <table class="min-w-full text-sm text-left text-gray-700 border border-gray-200">
                <thead class="bg-blue-100 text-xs uppercase text-gray-700">
                    <tr class="text-center">
                        <th class="px-6 py-3">Nama Aktivitas</th>
                        <th class="px-6 py-3">Tanggal</th>
                        <th class="px-6 py-3">Lokasi</th>
                        <th class="px-6 py-3">Album ID</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pastActivities as $pastActivity)
                        <tr class="border-t hover:bg-blue-50 text-center transition-all duration-200">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $pastActivity->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ \Carbon\Carbon::parse($pastActivity->date)->translatedFormat('d F Y') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $pastActivity->location }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $pastActivity->album->name ?? '—' }}
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center px-6 py-4 text-gray-500">
                                Belum ada aktivitas yang tercatat
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>
