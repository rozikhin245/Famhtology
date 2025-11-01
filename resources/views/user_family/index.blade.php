@extends('user_family.template')
@section('familytemplate')


    {{-- Header Section --}}
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-12 lg:px-8 w-full">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">

            {{-- Bagian Judul & Navigasi --}}
            <div>
                <div class="flex items-center gap-2 mb-3">
                    <a href="{{ route('welcome') }}"
                        class="inline-flex items-center text-blue-600 hover:text-blue-700 transition-all text-sm font-medium group">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-4 h-4 mr-1 group-hover:-translate-x-1 transition-transform">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                        Kembali ke Beranda
                    </a>
                </div>

                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight">
                    Tambah Anggota Keluarga
                </h1>

            </div>

            {{-- Search Bar --}}
            <div class="w-full md:w-1/3">
                <form method="GET" action="#" class="relative">
                    <input type="text" id="simple-search" name="search" placeholder="Cari anggota keluarga..."
                        class="block w-full rounded-lg border border-gray-300 bg-white py-2.5 pl-4 pr-10 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 shadow-sm transition-all" />

                    <button type="submit"
                        class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-blue-600 transition-colors">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>


    {{-- Table Section --}}
    <div class="flex w-full h-fit"></div>
    <div class="flex-1 px-6 md:px-8 lg:px-32">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                @if ($family->isNotEmpty())
                    <table class="w-full text-sm text-left text-gray-600">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                            <tr>
                                <th class="px-4 py-3 text-center">No.</th>
                                <th class="px-4 py-3 text-left">Nama Lengkap</th>
                                <th class="px-4 py-3 text-center">Jenis Kelamin</th>
                                <th class="px-4 py-3 text-center">Anak dari</th>
                                <th class="px-4 py-3 text-center">Pasangan</th>
                                <th class="px-4 py-3 text-center">Status</th>
                                <th class="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($family as $index => $families)
                                @php
                                    $no = $family->firstItem() + $index;
                                    $dropdownId = 'dropdown-' . $families->id;
                                    $buttonId = 'dropdown-button-' . $families->id;
                                @endphp
                                <tr
                                    class="border-b even:bg-gray-50 hover:bg-blue-50 transition-colors duration-150 text-center">
                                    <td class="px-4 py-2 font-semibold">{{ $no }}</td>
                                    <td class="px-4 py-2 text-left font-medium text-gray-800">{{ $families->Full_name }}
                                    </td>
                                    <td class="px-4 py-3">
                                        @if ($families->gender === 'L')
                                            <span
                                                class="inline-flex items-center gap-1 bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full ">
                                                {{-- Ikon Gender Male --}}
                                                <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        d="M20 4h-5a1 1 0 000 2h2.586l-4.95 4.95a6 6 0 10 1.414 1.414L19 7.414V10a1 1 0 102 0V5a1 1 0 00-1-1zM10 20a4 4 0 110-8 4 4 0 010 8z" />
                                                </svg>
                                                Male
                                            </span>
                                        @elseif ($families->gender === 'P')
                                            <span
                                                class="inline-flex items-center gap-1 bg-pink-100 text-pink-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full
                                                ">
                                                {{-- Ikon Gender Female --}}
                                                <svg class="w-4 h-4 text-pink-600" fill="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        d="M12 2a6 6 0 00-1 11.917V16H9a1 1 0 000 2h2v2a1 1 0 102 0v-2h2a1 1 0 000-2h-2v-2.083A6 6 0 0012 2zm0 10a4 4 0 110-8 4 4 0 010 8z" />
                                                </svg>
                                                Female
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-4 py-2 text-gray-700">
                                        {{ $families->parent->Full_name ?? '-' }}
                                    </td>

                                    <td class="px-4 py-2 text-gray-700">
                                        {{ $families->spouse->Full_name ?? '-' }}
                                    </td>

                                    <td class="px-4 py-2 text-center">
                                        @if ($families->status === 'approved')
                                            <span
                                                class="inline-block px-3 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">
                                                Approved
                                            </span>
                                        @elseif ($families->status === 'rejected')
                                            <span
                                                class="inline-block px-3 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded-full">
                                                Rejected
                                            </span>
                                        @else
                                            <span
                                                class="inline-block px-3 py-1 text-xs font-semibold text-yellow-700 bg-yellow-100 rounded-full">
                                                Pending
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-4 py-2 text-center">
                                        <div class="flex justify-center gap-2">
                                            @if ($families->status === 'pending' && $families->created_by === auth()->id())
                                                {{-- Tombol hapus aktif (bisa diklik) --}}
                                                <form action="{{ route('family.destroy', $families->id) }}" method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus anggota ini?')"
                                                    class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-600 hover:text-red-800 transition"
                                                        title="Hapus anggota ini">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                            stroke-width="2" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4a1 1 0 011 1v1H9V4a1 1 0 011-1z" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            @else
                                                {{-- Tombol nonaktif (abu-abu dan tidak bisa diklik) --}}
                                                <button type="button" class="text-gray-400 cursor-not-allowed"
                                                    title="Tidak dapat dihapus">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        stroke-width="2" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4a1 1 0 011 1v1H9V4a1 1 0 011-1z" />
                                                    </svg>
                                                </button>
                                            @endif
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="p-8 text-center text-gray-500 bg-gray-50">
                        Tidak ada data keluarga ditemukan.
                    </div>
                @endif
            </div>

            {{-- Pagination --}}
            <div
                class="p-4 border-t bg-white  flex flex-col sm:flex-row justify-between items-center text-sm text-gray-700  gap-3">
                <div class="text-center sm:text-left">
                    Menampilkan
                    <strong>{{ $family->firstItem() ?? 0 }}</strong> -
                    <strong>{{ $family->lastItem() ?? 0 }}</strong>
                    dari <strong>{{ $family->total() }}</strong> data
                </div>

                <div class="flex items-center gap-2">
                    {{-- Tombol Sebelumnya --}}
                    @if ($family->onFirstPage())
                        <span
                            class="px-4 py-2 rounded-lg bg-gray-100  text-gray-400 cursor-not-allowed">Sebelumnya</span>
                    @else
                        <a href="{{ $family->previousPageUrl() }}"
                            class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition-all duration-150">
                            Sebelumnya
                        </a>
                    @endif

                    {{-- Nomor Halaman --}}
                    <span class="px-3 py-1 bg-gray-100  rounded-lg">
                        Halaman <strong>{{ $family->currentPage() }}</strong> / {{ $family->lastPage() }}
                    </span>

                    {{-- Tombol Berikutnya --}}
                    @if ($family->hasMorePages())
                        <a href="{{ $family->nextPageUrl() }}"
                            class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition-all duration-150">
                            Berikutnya
                        </a>
                    @else
                        <span
                            class="px-4 py-2 rounded-lg bg-gray-100  text-gray-400 cursor-not-allowed">Berikutnya</span>
                    @endif
                </div>
            </div>

        </div>
    </div>

    {{-- Floating Button --}}
    <div class="fixed bottom-6 right-6">
        <a href="{{ route('family.create') }}"
            class="group flex items-center justify-center w-14 h-14 bg-blue-600 rounded-full shadow-lg hover:bg-blue-700 transition-all focus:ring-4 focus:ring-blue-300">
            <svg class="w-6 h-6 text-white group-hover:rotate-90 transition-transform" fill="none"
                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
        </a>
    </div>


@endsection
