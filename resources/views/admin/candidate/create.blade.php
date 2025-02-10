<x-admin.layout>
    <div class="mb-4">
        <a href="{{ route('candidates.index') }}" class="text-blue-500">Back</a>
    </div>

    <!-- Form -->
    <form action="{{ route('candidates.store') }}" method="POST" class="flex flex-col gap-4" enctype="multipart/form-data">
        @csrf
        <div class="">
            <label class="block " for="image">Upload Image</label>
            <input class="w-full py-2 border border-white rounded-md" type="file" name="image" accept="image/*">
        </div>
        <div class="">
            <label class="block " for="title">Title</label>
            <input class="w-full py-2 border border-white rounded-md" type="text" name="title" required>
        </div>
        <div class="">
            <label class="block " for="ordinal_number">Ordinal Number</label>
            <input class="w-full py-2 border border-white rounded-md" type="number" name="ordinal_number" required>
        </div>
        <div class="">
            <label class="block " for="chairman">Chairman</label>
            <input class="w-full py-2 border border-white rounded-md" type="text" name="chairman" required>
        </div>
        <div class="">
            <label class="block " for="vice_chairman">Vice Chairman</label>
            <input class="w-full py-2 border border-white rounded-md" type="text" name="vice_chairman" required>
        </div>
        <div class="">
            <label class="block " for="vision">Vision</label>
            <textarea class="w-full p-2 h-48 border-none rounded-md" name="vision" required></textarea>
        </div>
        <div class="">
            <label class="block " for="mision">Mision</label>
            <textarea class="w-full p-2 h-48 border-none rounded-md" name="mision" required></textarea>
        </div>
        <button type="submit">Submit</button>
    </form>

</x-admin.layout>
