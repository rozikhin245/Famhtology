<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-3xl font-bold font-poppins text-gray-900 mb-4 capitalize">
                Welcome, {{ Auth::user()->name }} 👋
            </h1>

            <p class="text-lg text-gray-700">
                Senang melihatmu kembali. Semoga harimu produktif dan menyenangkan!
            </p>
        </div>
    </div>
</x-app-layout>
