<div id="customModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="relative w-full max-w-md bg-white rounded-3xl shadow-2xl transition-all duration-500 overflow-hidden">

        <!-- Header Foto/Icon -->
        <div
            class="relative h-48 bg-gradient-to-br from-indigo-200 via-blue-300 to-blue-200 flex items-center justify-center group transition-all duration-300 rounded-t-3xl overflow-hidden">
            <!-- Foto -->
            <img id="modalPhoto" src="" alt="Profile Photo"
                class="absolute inset-0 w-full h-full hidden z-0">

            <!-- Icon -->
            <div
                class="z-10 flex items-center justify-center w-24 h-24 rounded-full bg-white/20 backdrop-blur-sm shadow-md">
                <svg id="modalIcon" class="w-12 h-12 text-white drop-shadow-lg" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5.121 17.804A13.937 13.937 0 0112 15c2.042 0 3.97.457 5.879 1.274M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
        </div>


        <!-- Konten Modal -->
        <div class="px-8 py-6 space-y-4">
            <div class="text-center">
                <h3 id="modalFullName"
                    class="text-2xl font-bold capitalize text-gray-800 font-poppins transition-all duration-300 group-hover:text-blue-600">
                    Full Name
                </h3>
                <p id="modalNickName" class="text-sm text-gray-500 font-roboto">Nickname</p>
            </div>

            <div class="space-y-3">
                <div class="flex items-start gap-3 text-sm text-gray-700 font-poppins hover:text-blue-600 transition">
                    <svg class="w-5 h-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 13V7a2 2 0 00-2-2H6a2 2 0 00-2 2v6m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6" />
                    </svg>
                    <span id="modalGender">Gender: -</span>
                </div>

                <div class="flex items-start gap-3 text-sm font-poppins text-gray-700 hover:text-blue-600 transition">
                    <svg class="w-5 h-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13 21.314l-4.657-4.657A8 8 0 1117.657 16.657z" />
                    </svg>
                    <span id="modalDomisili">Domisili: -</span>
                </div>

                <div class="flex items-start gap-3 text-sm font-poppins text-gray-700 hover:text-blue-600 transition">
                    <svg class="w-5 h-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    <span id="modalParent">Orang Tua: -</span>
                </div>

                <div class="flex items-start gap-3 text-sm font-poppins text-gray-700 hover:text-blue-600 transition">
                    <svg class="w-5 h-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 10h4.586a1 1 0 01.707 1.707l-5.586 5.586a1 1 0 01-1.414 0l-5.586-5.586A1 1 0 015.414 10H10V5a1 1 0 011-1h2a1 1 0 011 1v5z" />
                    </svg>
                    <span id="modalSpouse">Pasangan: -</span>
                </div>

                <div class="flex items-start gap-3 text-sm font-poppins text-gray-700 hover:text-blue-600 transition">
                    <svg class="w-5 h-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span id="modalGeneration">Kode Generasi: -</span>
                </div>
            </div>

            <button onclick="closeModal()"
                class="w-full mt-4 px-4 py-2 bg-white text-gray-400 font-semibold rounded-lg border-2 border-gray-200 hover:bg-red-600 hover:text-white transition duration-300 transform hover:scale-105 active:scale-95">
                Close Detail
            </button>
        </div>
    </div>
</div>


<script>
    document.querySelectorAll('.show-button').forEach(button => {
        button.addEventListener('click', () => {
            document.getElementById('modalFullName').textContent = button.dataset.fullname;
            document.getElementById('modalNickName').textContent = button.dataset.nickname || '-';

            // ✅ Ubah singkatan gender ke bentuk lengkap
            const genderRaw = button.dataset.gender;
            const genderText = genderRaw === 'L' ? 'Laki - Laki' :
                genderRaw === 'P' ? 'Perempuan' : '-';
            document.getElementById('modalGender').textContent = `Gender: ${genderText}`;

            document.getElementById('modalDomisili').textContent = 'Domisili: ' + (button.dataset
                .domisili || '-');
            document.getElementById('modalParent').textContent = 'Orang Tua: ' + (button.dataset
                .parent || '-');
            document.getElementById('modalSpouse').textContent = 'Pasangan: ' + (button.dataset
                .spouse || '-');
            document.getElementById('modalGeneration').textContent = 'Kode Generasi: ' + (button.dataset
                .generation || '-');

            // ✅ Gambar atau SVG fallback
            const photo = button.dataset.photo;
            const photoEl = document.getElementById('modalPhoto');
            const iconEl = document.getElementById('modalIcon');

            if (photo && photo !== 'null') {
                photoEl.src = `/storage/${photo}`; // sesuaikan path ini jika perlu
                photoEl.classList.remove('hidden');
                iconEl.classList.add('hidden');
            } else {
                photoEl.classList.add('hidden');
                iconEl.classList.remove('hidden');
            }

            document.getElementById('customModal').classList.remove('hidden');
        });
    });

    function closeModal() {
        document.getElementById('customModal').classList.add('hidden');
    }
</script>
