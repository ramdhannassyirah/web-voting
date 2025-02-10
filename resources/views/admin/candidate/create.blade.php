<x-admin.layout>
    <nav>
        <ol class="flex items-center gap-2 mb-4">
            <li>
                <a class="font-medium" href="index.html">Dashboard /</a>
            </li>
            <li class="font-medium text-primary">Buat Kandidat</li>
        </ol>
    </nav>
    <!-- Form -->
    <form action="{{ route('candidates.store') }}" method="POST"
        class="flex flex-col gap-4 bg-white p-4 rounded-md shadow-md" enctype="multipart/form-data">
        @csrf
        <div class="">
            <label class="block " for="image">Upload Image</label>
            <input class="w-full p-2 border border-gray-300   rounded-md" type="file" name="image"
                accept="image/*">
        </div>
        <div class="">
            <label class="block " for="title">Nama Paslon</label>
            <input class="w-full p-2 border border-gray-300   rounded-md" type="text" name="title" required>
        </div>
        <div class="">
            <label class="block " for="ordinal_number">Nomer Urut</label>
            <input class="w-full p-2 border border-gray-300   rounded-md" type="number" name="ordinal_number" required>
        </div>
        <div class="">
            <label class="block " for="chairman">Ketua</label>
            <input class="w-full p-2 border border-gray-300   rounded-md" type="text" name="chairman" required>
        </div>
        <div class="">
            <label class="block " for="vice_chairman">Wakil Ketua</label>
            <input class="w-full p-2 border border-gray-300   rounded-md" type="text" name="vice_chairman" required>
        </div>
        <div class="">
            <label class="block " for="vision">Visi</label>
            <textarea class="w-full p-2 h-48 border-gray-300  rounded-md" name="vision" required></textarea>
        </div>
        <div class="">
            <label class="block " for="mision">Misi</label>
            <textarea class="w-full p-2 h-48 border-gray-300  rounded-md" name="mision" required></textarea>
        </div>

        <button class="bg-primary rounded-md w-full p-2 text-white hover:opacity-50" type="submit">Buat</button>
    </form>

</x-admin.layout>
