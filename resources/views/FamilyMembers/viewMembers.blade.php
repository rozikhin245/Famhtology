@extends('FamilyMembers.index')

@section('section')
    <div class="flex flex-col w-full mt-5">

        <div class="bg-white relative shadow-md sm:rounded-lg overflow-hidden">
            <div class="flex flex-row-reverse md:items-center justify-between gap-4 p-4">
                <!-- form Search -->
                <div class="w-full md:w-1/3">
                    <form class="relative" method="GET" action="{{ route('FamilyMembers.index') }}">
                        <label for="simple-search" class="sr-only">Search</label>

                        <!-- Input -->
                        <input type="text" id="simple-search" name="search" value="{{ request('search') }}"
                            class="w-full pr-12 py-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Search..." required>

                        <!-- Tombol search kanan -->
                        <button type="submit"
                            class="absolute inset-y-0 right-0 flex items-center px-2 font-poppins text-xs rounded-r-lg transition">
                            <svg class="w-5 h-5 text-gray-400 hover:text-gray-600" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                    d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>

            {{-- table data --}}
            <div class="overflow-x-auto">
                @if ($family->isNotEmpty())
                    <table class="w-full text-sm text-left text-gray-500 mb-10">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100 ">
                            <tr class="font-poppins text-center text-gray-700 uppercase tracking-wide">
                                <th scope="col" class="px-6 py-3 text-center">No.</th>
                                <th scope="col" class="px-6 py-3 text-start">Full Name</th>
                                <th scope="col" class="px-6 py-3">Gender</th>
                                <th scope="col" class="px-6 py-3">Parent Relation</th>
                                <th scope="col" class="px-6 py-3">Spouse Relation</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3">Toggle</th>
                            </tr>

                        </thead>
                        <tbody>
                            @foreach ($family as $index => $families)
                                @php
                                    $dropdownId = 'dropdown-' . $families->id;
                                    $buttonId = 'dropdown-button-' . $families->id;
                                    $no = $family->firstItem() + $index;
                                @endphp
                                <tr
                                    class="even:bg-gray-100 odd:bg-white border-b font-poppins text-sm capitalize text-center hover:bg-gray-50 tracking-wide transition-colors">
                                    <td class="px-4 py-3 text-center pl-7 font-semibold">
                                        {{ $no }}
                                    </td>
                                    <td class="px-4 py-3 text-start pl-7">
                                        {{ $families->Full_name }}
                                    </td>
                                    <td class="px-4 py-3">
                                        @if ($families->gender === 'L')
                                            <span
                                                class="inline-flex items-center gap-1 bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">
                                                {{-- Ikon Gender Male --}}
                                                <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        d="M20 4h-5a1 1 0 000 2h2.586l-4.95 4.95a6 6 0 10 1.414 1.414L19 7.414V10a1 1 0 102 0V5a1 1 0 00-1-1zM10 20a4 4 0 110-8 4 4 0 010 8z" />
                                                </svg>
                                                Male
                                            </span>
                                        @elseif ($families->gender === 'P')
                                            <span
                                                class="inline-flex items-center gap-1 bg-pink-100 text-pink-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-pink-900 dark:text-pink-300">
                                                {{-- Ikon Gender Female --}}
                                                <svg class="w-4 h-4 text-pink-600" fill="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        d="M12 2a6 6 0 00-1 11.917V16H9a1 1 0 000 2h2v2a1 1 0 102 0v-2h2a1 1 0 000-2h-2v-2.083A6 6 0 0012 2zm0 10a4 4 0 110-8 4 4 0 010 8z" />
                                                </svg>
                                                Female
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        @if ($families->parent)
                                            {{ $families->parent->Full_name }}
                                        @else
                                            <span class="text-red-300 italic">No Parent</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        @if ($families->spouse)
                                            {{ $families->spouse->Full_name }}
                                        @else
                                            <span class="text-red-300 italic">No Spouse</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($families->status === 'pending')
                                            <div class="relative inline-block text-left">
                                                <!-- Tombol utama -->
                                                <button id="dropdownButton-{{ $families->id }}"
                                                        data-dropdown-toggle="dropdownMenu-{{ $families->id }}"
                                                        class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-yellow-700 bg-yellow-100 border border-yellow-300 rounded-lg hover:bg-yellow-200 focus:outline-none focus:ring-2 focus:ring-yellow-300">
                                                    <svg class="w-4 h-4 mr-2 text-yellow-700" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm1 12H9v-2h2v2zm0-4H9V6h2v4z"/>
                                                    </svg>
                                                    Pending
                                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2"
                                                        viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19 9l-7 7-7-7"></path></svg>
                                                </button>

                                                <!-- Dropdown menu -->
                                                <div id="dropdownMenu-{{ $families->id }}"
                                                     class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-40 dark:bg-gray-700">
                                                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                                                        <li>
                                                            <form action="{{ route('FamilyMembers.approve', $families->id) }}" method="POST">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit"
                                                                    onclick="return confirm('Yakin ingin menyetujui data ini?')"
                                                                    class="w-full px-4 py-2 text-left hover:bg-green-100 dark:hover:bg-green-600 dark:hover:text-white flex items-center gap-2">
                                                                    <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                                                        <path fill-rule="evenodd"
                                                                            d="M16.707 5.293a1 1 0 010 1.414l-7.364 7.364a1 1 0 01-1.414 0L3.293 9.414a1 1 0 011.414-1.414L8 11.293l6.293-6.293a1 1 0 011.414 0z"
                                                                            clip-rule="evenodd"></path>
                                                                    </svg>
                                                                    Approve
                                                                </button>
                                                            </form>
                                                        </li>
                                                        <li>
                                                            <form action="{{ route('FamilyMembers.reject', $families->id) }}" method="POST">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit"
                                                                    onclick="return confirm('Yakin ingin menolak data ini?')"
                                                                    class="w-full px-4 py-2 text-left hover:bg-red-100 dark:hover:bg-red-600 dark:hover:text-white flex items-center gap-2">
                                                                    <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                                                        <path fill-rule="evenodd"
                                                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                            clip-rule="evenodd"></path>
                                                                    </svg>
                                                                    Reject
                                                                </button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded text-sm font-medium
                                                {{ $families->status === 'approved' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    @if ($families->status === 'approved')
                                                        <path fill-rule="evenodd"
                                                            d="M16.707 5.293a1 1 0 010 1.414l-7.364 7.364a1 1 0 01-1.414 0L3.293 9.414a1 1 0 011.414-1.414L8 11.293l6.293-6.293a1 1 0 011.414 0z"
                                                            clip-rule="evenodd"></path>
                                                    @else
                                                        <path fill-rule="evenodd"
                                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                            clip-rule="evenodd"></path>
                                                    @endif
                                                </svg>
                                                {{ ucfirst($families->status) }}
                                            </span>
                                        @endif
                                    </td>



                                    <td class="px-4 py-3 flex items-center justify-center">
                                        <button id="{{ $buttonId }}" data-dropdown-toggle="{{ $dropdownId }}"
                                            class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 rounded-lg focus:outline-none"
                                            type="button">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                        <div id="{{ $dropdownId }}"
                                            class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow"
                                            aria-labelledby="{{ $buttonId }}">
                                            <ul class="py-1 text-sm text-gray-700">
                                                <li>
                                                    <button type="button"
                                                        class="block py-1 px-4 hover:text-green-500 w-full text-left show-button"
                                                        data-fullname="{{ $families->Full_name }}"
                                                        data-nickname="{{ $families->Nick_name }}"
                                                        data-gender="{{ $families->gender }}"
                                                        data-domisili="{{ $families->domisili }}"
                                                        data-parent="{{ optional($families->parent)->Full_name ?? '-' }}"
                                                        data-spouse="{{ optional($families->spouse)->Full_name ?? '-' }}"
                                                        data-photo="{{ $families->photo }}"
                                                        data-generation="{{ $families->generation_code }}">

                                                        Detail
                                                    </button>
                                                </li>
                                                <li>
                                                    <a href="{{ route('FamilyMembers.edit', $families->id) }}"
                                                        class="block py-1 px-4 hover:text-blue-500 text-start">Edit</a>
                                                </li>
                                            </ul>
                                            <form action="{{ route('FamilyMembers.destroy', $families->id) }}"
                                                method="POST" onsubmit="return confirm('Hapus anggota ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="block py-1 px-4 text-sm text-gray-700 hover:text-red-500">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="col-span-full text-center p-6 bg-gray-100 rounded-lg">
                        <p class="text-sm font-medium text-gray-600 font-roboto">Tidak ada data keluarga yang
                            ditemukan.
                        </p>
                    </div>
                @endif
            </div>

            {{-- pagination --}}
            <nav class="flex flex-col md:flex-row justify-between items-center space-y-3 md:space-y-0 p-4 mx-5"
                aria-label="Table navigation">
                <div class="flex items-center justify-between px-4 py-2  rounded-md">
                    <span class="text-sm text-gray-600">
                        Showing
                        <span class="font-semibold text-gray-900">{{ $family->firstItem() }}</span>
                        –
                        <span class="font-semibold text-gray-900">{{ $family->lastItem() }}</span>
                        of
                        <span class="font-semibold text-blue-600">{{ $family->total() }}</span>
                        data
                    </span>
                </div>




                {{-- {{ $family->links('pagination::tailwind') }} --}}

                <ul class="inline-flex items-stretch -space-x-px">
                    {{-- Tombol Previous --}}
                    <li>
                        <a href="{{ $family->onFirstPage() ? '#' : $family->previousPageUrl() }}"
                            class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 {{ $family->onFirstPage() ? 'cursor-not-allowed opacity-50' : '' }}">
                            <span class="sr-only">Previous</span>
                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    </li>

                    {{-- Tombol Halaman --}}
                    @foreach ($family->getUrlRange(1, $family->lastPage()) as $page => $url)
                        <li>
                            <a href="{{ $url }}"
                                class="flex items-center justify-center text-sm py-2 px-3 text-blue-500 font-black leading-tight border border-gray-300
                                {{ $page == $family->currentPage()
                                    ? 'z-10 text-primary-600 bg-primary-50 border-primary-300 hover:bg-primary-100 hover:text-primary-700'
                                    : 'text-gray-400 bg-white hover:bg-gray-100 hover:text-gray-700' }}">
                                {{ $page }}
                            </a>
                        </li>
                    @endforeach

                    {{-- Tombol Next --}}
                    <li>
                        <a href="{{ $family->hasMorePages() ? $family->nextPageUrl() : '#' }}"
                            class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 {{ $family->hasMorePages() ? '' : 'cursor-not-allowed opacity-50' }}">
                            <span class="sr-only">Next</span>
                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    </li>
                </ul>

            </nav>
        </div>
    </div>

    {{-- button create data --}}
    <div class="fixed end-6 bottom-6 group">
        <a href="{{ route('FamilyMembers.create') }}">
            <button type="button"
                class="flex items-center justify-center text-white bg-blue-700 rounded-full w-14 h-14 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 focus:outline-none">
                <svg class="w-5 h-5 transition-transform group-hover:rotate-45" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 1v16M1 9h16" />
                </svg>
                <span class="sr-only">Open actions menu</span>
            </button>
        </a>
    </div>

    {{-- modal layout --}}
    @include('FamilyMembers.show')
@endsection
