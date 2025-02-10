<x-admin.layout>
    <div class="container mx-auto mt-10">
        <h1 class="text-2xl font-bold text-center mb-6">Buat & Kirim Token Voting</h1>

        @if (session('success'))
            <div class="p-4 mb-4 text-green-700 bg-green-200 rounded-lg">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="p-4 mb-4 text-red-700 bg-red-200 rounded-lg">{{ session('error') }}</div>
        @endif

        <form action="{{ route('invites.store') }}" method="POST" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-semibold mb-2">Email Tujuan</label>
                <input type="email" id="email" name="email" required
                    class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-blue-300"
                    placeholder="Masukkan email tujuan">
            </div>

            <button type="submit"
                class="px-6 py-3 bg-blue-500 text-white font-bold rounded-md hover:bg-blue-700 transition w-full">
                Generate & Kirim Token
            </button>
        </form>
    </div>
</x-admin.layout>
