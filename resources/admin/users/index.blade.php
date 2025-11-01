<x-app-layout>
    <div class="max-w-7xl mx-auto p-6">
        <h2 class="text-3xl font-bold mb-6 text-gray-800 border-b pb-2">👥 Kelola Pengguna</h2>

        {{-- Notifikasi sukses --}}
        @if (session('success'))
            <div class="mb-4 p-4 rounded-md bg-green-100 border border-green-300 text-green-800 font-medium shadow-sm">
                ✅ {{ session('success') }}
            </div>
        @endif

        {{-- Table container --}}
        <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-100">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $user->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $user->email }}</td>

                            {{-- Role dropdown --}}
                            <td class="px-6 py-4">
                                <form action="{{ route('users.update', $user) }}" method="POST" class="inline-flex items-center space-x-2">
                                    @csrf
                                    @method('PUT')
                                    <select name="role" onchange="this.form.submit()"
                                        class="border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm px-2 py-1 bg-gray-50 hover:bg-white transition">
                                        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                    </select>
                                </form>
                            </td>

                            {{-- Tombol aksi --}}
                            <td class="px-6 py-4 text-right">
                                <form action="{{ route('users.destroy', $user) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus user ini?')"
                                      class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-sm font-semibold shadow-sm transition transform hover:-translate-y-0.5">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="p-4 border-t bg-gray-50">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
