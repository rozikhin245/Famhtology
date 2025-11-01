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
                <div>
                    <label for="parent_id" class="block text-sm font-semibold text-gray-700 mb-2">
                        Hubungan Orang Tua
                    </label>
                    <select name="parent_id" id="parent_id"
                        class="w-full rounded-xl border border-gray-300 bg-gray-50 text-gray-900 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2.5 transition-all">
                        <option value="">— Pilih orang tua —</option>
                        @foreach ($family as $families)
                            <option value="{{ $families->id }}"
                                {{ old('parent_id', $families->parent_id ?? '') == $families->id ? 'selected' : '' }}>
                                {{ $families->Full_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Spouse --}}
                <div>
                    <label for="spouse_id" class="block text-sm font-semibold text-gray-700 mb-2">
                        Hubungan Pasangan
                    </label>
                    <select name="spouse_id" id="spouse_id"
                        class="w-full rounded-xl border border-gray-300 bg-gray-50 text-gray-900 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2.5 transition-all">
                        <option value="">— Pilih pasangan —</option>
                        @foreach ($family as $families)
                            <option value="{{ $families->id }}"
                                {{ old('spouse_id', $families->spouse_id ?? '') == $families->id ? 'selected' : '' }}>
                                {{ $families->Full_name }}
                            </option>
                        @endforeach
                    </select>
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
@endsection
