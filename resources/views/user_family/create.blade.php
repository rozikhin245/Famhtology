@extends('user_family.template')
@section('familytemplate')
    <div class="min-h-screen bg-gray-50  py-12 px-4">
        <div class="max-w-3xl mx-auto bg-white  rounded-2xl shadow-xl p-8 transition-all">

            {{-- Judul --}}
            <div class="mb-8 border-b border-gray-200  pb-4">
                <h2 class="text-3xl font-extrabold text-gray-800 ">
                    Tambah Anggota Keluarga
                </h2>
                <p class="text-sm text-gray-500  mt-1">
                    Lengkapi data berikut dengan benar untuk menambahkan anggota keluarga baru.
                </p>
            </div>

            {{-- Pesan Error --}}
            @if ($errors->any())
                <div class="mb-6 bg-red-50  border border-red-300  text-red-700  p-4 rounded-lg">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li class="text-sm">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('family.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                {{-- Nama Lengkap --}}
                <div>
                    <label for="Full_name" class="block text-sm font-semibold text-gray-700  mb-2">
                        Nama Lengkap
                    </label>
                    <input type="text" name="Full_name" id="Full_name" value="{{ old('Full_name') }}"
                        placeholder="Masukkan nama lengkap..."
                        class="w-full rounded-xl border border-gray-300  bg-gray-50  text-gray-900  shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2.5 transition-all">
                </div>

                {{-- Nama Panggilan --}}
                <div>
                    <label for="Nick_name" class="block text-sm font-semibold text-gray-700  mb-2">
                        Nama Panggilan
                    </label>
                    <input type="text" name="Nick_name" id="Nick_name" value="{{ old('Nick_name') }}"
                        placeholder="Masukkan nama panggilan..."
                        class="w-full rounded-xl border border-gray-300  bg-gray-50 text-gray-900 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2.5 transition-all">
                </div>

                {{-- Jenis Kelamin --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Kelamin</label>
                    <div class="flex gap-6">
                        <label class="flex items-center text-gray-800 cursor-pointer">
                            <input type="radio" name="gender" value="L" {{ old('gender') == 'L' ? 'checked' : '' }}
                                class="mr-2 text-indigo-600 focus:ring-indigo-500">
                            Laki-laki
                        </label>
                        <label class="flex items-center text-gray-800 cursor-pointer">
                            <input type="radio" name="gender" value="P" {{ old('gender') == 'P' ? 'checked' : '' }}
                                class="mr-2 text-indigo-600 focus:ring-indigo-500">
                            Perempuan
                        </label>
                    </div>
                </div>

                {{-- Domisili --}}
                <div>
                    <label for="domisili" class="block text-sm font-semibold text-gray-700 mb-2">
                        Domisili
                    </label>
                    <input type="text" name="domisili" id="domisili" value="{{ old('domisili') }}"
                        placeholder="Masukkan domisili..."
                        class="w-full rounded-xl border border-gray-300 bg-gray-50 text-gray-900shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2.5 transition-all">
                </div>

                {{-- Parent --}}
<div x-data="{ open: false, search: '', selectedName: '', selectedId: '' }" class="relative">
    <label for="parent_id" class="block text-sm font-semibold text-gray-700 mb-2">
        Hubungan Orang Tua
    </label>

    <!-- Input utama -->
    <div @click="open = !open"
        class="cursor-pointer w-full rounded-xl border border-gray-300 bg-gray-50 text-gray-900 shadow-sm
               focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2.5 transition-all flex justify-between items-center">
        <span x-text="selectedName || '— Pilih orang tua —'"></span>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M19 9l-7 7-7-7" />
        </svg>
    </div>

    <!-- Dropdown -->
    <div x-show="open" @click.outside="open = false"
        class="absolute z-50 mt-2 w-full bg-white border border-gray-200 rounded-xl shadow-xl overflow-hidden">
        <!-- Kolom pencarian -->
        <div class="p-2 border-b border-gray-100">
            <input type="text" x-model="search" placeholder="Ketik untuk mencari..."
                class="w-full rounded-lg border-gray-300 text-sm focus:ring-2 focus:ring-indigo-500 px-3 py-2">
        </div>

        <!-- Daftar hasil -->
        <ul class="max-h-48 overflow-y-auto">
            @foreach ($family as $families)
                <li @click="selectedId = '{{ $families->id }}'; selectedName = '{{ $families->Full_name }}'; open = false;"
                    x-show="'{{ Str::lower($families->Full_name) }}'.includes(search.toLowerCase())"
                    class="px-4 py-2 text-sm text-gray-700 hover:bg-indigo-100 cursor-pointer transition">
                    {{ $families->Full_name }}
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Input hidden untuk dikirim ke server -->
    <input type="hidden" name="parent_id" x-model="selectedId">

    <p class="text-xs text-gray-500 mt-1 italic">Ketik nama untuk mencari anggota keluarga.</p>
</div>

{{-- Spouse --}}
<div x-data="{ open: false, search: '', selectedName: '', selectedId: '' }" class="relative">
    <label for="spouse_id" class="block text-sm font-semibold text-gray-700 mb-2">
        Hubungan Pasangan
    </label>

    <!-- Input utama -->
    <div @click="open = !open"
        class="cursor-pointer w-full rounded-xl border border-gray-300 bg-gray-50 text-gray-900 shadow-sm
               focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2.5 transition-all flex justify-between items-center">
        <span x-text="selectedName || '— Pilih pasangan —'"></span>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M19 9l-7 7-7-7" />
        </svg>
    </div>

    <!-- Dropdown -->
    <div x-show="open" @click.outside="open = false"
        class="absolute z-50 mt-2 w-full bg-white border border-gray-200 rounded-xl shadow-xl overflow-hidden">
        <!-- Kolom pencarian -->
        <div class="p-2 border-b border-gray-100">
            <input type="text" x-model="search" placeholder="Ketik untuk mencari..."
                class="w-full rounded-lg border-gray-300 text-sm focus:ring-2 focus:ring-indigo-500 px-3 py-2">
        </div>

        <!-- Daftar hasil -->
        <ul class="max-h-48 overflow-y-auto">
            @foreach ($family as $families)
                <li @click="selectedId = '{{ $families->id }}'; selectedName = '{{ $families->Full_name }}'; open = false;"
                    x-show="'{{ Str::lower($families->Full_name) }}'.includes(search.toLowerCase())"
                    class="px-4 py-2 text-sm text-gray-700 hover:bg-indigo-100 cursor-pointer transition">
                    {{ $families->Full_name }}
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Input hidden untuk dikirim ke server -->
    <input type="hidden" name="spouse_id" x-model="selectedId">

    <p class="text-xs text-gray-500 mt-1 italic">Ketik nama untuk mencari pasangan yang sudah terdaftar.</p>
</div>


                {{-- Foto --}}
                <div>
                    <label for="photo" class="block text-sm font-semibold text-gray-700 mb-2">
                        Foto (opsional)
                    </label>
                    <input type="file" name="photo" id="photo" accept="image/*"
                        class="w-full text-sm file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-indigo-600 file:text-white hover:file:bg-indigo-700  cursor-pointer transition">
                </div>

                {{-- Tombol Aksi --}}
                <div class="flex justify-end gap-4 pt-6 border-t border-gray-200 ">
                    <a href="{{ route('family.index') }}"
                        class="px-4 py-2.5 rounded-lg bg-gray-200  text-gray-800  font-medium hover:bg-gray-300 transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-5 py-2.5 rounded-lg bg-indigo-600 text-white font-semibold hover:bg-indigo-700 shadow-md hover:shadow-lg transition">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        {{-- Import Select2 + jQuery --}}
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <style>
            /* ✨ Styling biar lebih mirip Tailwind */
            .select2-container--default .select2-selection--single {
                height: 42px;
                border-radius: 0.75rem;
                border: 1px solid #d1d5db;
                background-color: #f9fafb;
                padding: 6px 10px;
            }

            .select2-container--default .select2-selection__rendered {
                color: #111827;
                font-size: 0.875rem;
                line-height: 1.5rem;
            }

            .select2-results__option--highlighted {
                background-color: #3b82f6 !important;
                color: white !important;
            }

            .select2-container--default .select2-selection__arrow {
                height: 38px;
            }
        </style>

        <script>
            $(document).ready(function() {
                $('.select2').select2({
                    placeholder: "Ketik untuk mencari nama...",
                    allowClear: true,
                    width: '100%',
                    language: {
                        inputTooShort: function() {
                            return "Ketik minimal 1 huruf untuk mencari...";
                        },
                        searching: function() {
                            return "Mencari...";
                        },
                        noResults: function() {
                            return "Tidak ditemukan hasil yang cocok.";
                        }
                    }
                });
            });
        </script>
    @endpush
@endsection
