<x-admin.layout>

    <nav>
        <ol class="flex items-center gap-2">
            <li>
                <a class="font-medium" href="index.html">Dashboard /</a>
            </li>
            <li class="font-medium text-primary">Edit Kandidat</li>
        </ol>
    </nav>

    <form action="{{ route('candidates.update', $candidate->slug) }}" method="POST"
        class="flex flex-col gap-4 bg-white p-4 rounded-md shadow-md" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="">
            <label class="block " for="image">Upload Image</label>
            <input class="w-full p-2 border border-gray-300   rounded-md" type="file" name="image"
                accept="image/*">
        </div>
        <div class="">
            <label class="block " for="image">Nama Paslon</label>
            <input class="w-full p-2 border border-gray-300   rounded-md" type="text" name="title"
                value="{{ $candidate->title }}" required>
        </div>
        <div class="">
            <label class="block " for="image">Ketua</label>
            <input class="w-full p-2 border border-gray-300   rounded-md" type="text" name="chairman"
                value="{{ $candidate->chairman }}" required>
        </div>
        <div class="">
            <label class="block " for="image">Wakil Ketua</label>
            <input class="w-full p-2 border border-gray-300   rounded-md" type="text" name="vice_chairman"
                value="{{ $candidate->vice_chairman }}" required>
        </div>
        <div class="">
            <label class="block " for="image">Visi</label>
            <textarea class="w-full p-2 h-48 border-gray-300  rounded-md" name="vision" required>{{ $candidate->vision }}</textarea>
        </div>
        <div class="">
            <label class="block " for="image">Misi</label>
            <textarea class="w-full p-2 h-48 border-gray-300  rounded-md" name="mision" required>{{ $candidate->mision }}</textarea>
        </div>
        <button class="bg-primary rounded-md w-full p-2 text-white hover:opacity-50" type="submit">Edit </button>
    </form>

</x-admin.layout>
