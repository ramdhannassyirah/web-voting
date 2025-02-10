<x-admin.layout>
    <div class="container mx-auto mt-10">
        <h1 class="text-2xl font-bold text-center mb-6">Daftar Token Voting</h1>

        <div class="mb-4">
            <a href="{{ route('dashboard') }}"
                class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-700 transition">
                Kembali ke Dashboard
            </a>
        </div>

        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border px-4 py-2">No</th>
                    <th class="border px-4 py-2">Email</th>
                    <th class="border px-4 py-2">Token</th>
                    <th class="border px-4 py-2">Status</th>
                    <th class="border px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invites as $index => $invite)
                    <tr class="text-center">
                        <td class="border px-4 py-2">{{ $index + $invites->firstItem() }}</td>
                        <td class="border px-4 py-2">{{ $invite->email }}</td>
                        <td class="border px-4 py-2">
                            <input type="text" id="token-{{ $invite->id }}"
                                value="{{ url('/vote?token=' . $invite->token) }}" readonly
                                class="w-48 px-2 py-1 border rounded-md">
                            <button onclick="copyToken('token-{{ $invite->id }}')"
                                class="ml-2 px-2 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-700 transition">
                                Copy
                            </button>
                        </td>
                        <td class="border px-4 py-2">
                            @if ($invite->used)
                                <span class="text-green-600 font-semibold">Digunakan</span>
                            @else
                                <span class="text-red-600 font-semibold">Belum Digunakan</span>
                            @endif
                        </td>
                        <td class="border px-4 py-2">
                            <form action="{{ route('invites.destroy', $invite->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-2 py-1 bg-red-500 text-white rounded-md hover:bg-red-700 transition">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $invites->links() }} <!-- Pagination -->
        </div>
    </div>


    <script>
        function copyToken(elementId) {
            let tokenInput = document.getElementById(elementId);

            if (!tokenInput) {
                console.error("Elemen input tidak ditemukan!");
                return;
            }

            tokenInput.select();
            document.execCommand("copy");
            alert("Token berhasil disalin (metode lama)!");
        }
    </script>
</x-admin.layout>
