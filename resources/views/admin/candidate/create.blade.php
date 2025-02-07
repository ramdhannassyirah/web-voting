<x-admin.layout>
    <div class="mb-4">
        <a href="{{ route('candidates.index') }}" class="text-blue-500">Back</a>
    </div>

    <!-- Form -->
    <form action="{{ route('candidates.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="">

            <input type="file" name="image" accept="image/*">
        </div>
        <div class="">

            <input type="text" name="title" required>
        </div>
        <div class="">

            <input type="text" name="chairman" required>
        </div>
        <div class="">

            <input type="text" name="vice_chairman" required>
        </div>
        <div class="">

            <textarea name="vision" required></textarea>
        </div>
        <div class="">

            <textarea name="mision" required></textarea>
        </div>
        <button type="submit">Submit</button>
    </form>

</x-admin.layout>
