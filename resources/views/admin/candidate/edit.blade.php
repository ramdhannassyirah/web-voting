<x-admin.layout>

    <form action="{{ route('candidates.update', $candidate->slug) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="">
            <label class="block " for="image">Upload Image</label>
            <input class="w-full py-2 border border-white rounded-md" type="file" name="image" accept="image/*">
        </div>
        <div class="">
            <label class="block " for="image">Title</label>
            <input class="w-full py-2 border border-white rounded-md" type="text" name="title"
                value="{{ $candidate->title }}" required>
        </div>
        <div class="">
            <label class="block " for="image">Chairman</label>
            <input class="w-full py-2 border border-white rounded-md" type="text" name="chairman"
                value="{{ $candidate->chairman }}" required>
        </div>
        <div class="">
            <label class="block " for="image">Vice Chairman</label>
            <input class="w-full py-2 border border-white rounded-md" type="text" name="vice_chairman"
                value="{{ $candidate->vice_chairman }}" required>
        </div>
        <div class="">
            <label class="block " for="image">Vision</label>
            <textarea class="w-full h-48 border-none rounded-md" name="vision" required>{{ $candidate->vision }}</textarea>
        </div>
        <div class="">
            <label class="block " for="image">Mision</label>
            <textarea class="w-full h-48 border-none rounded-md" name="mision" required>{{ $candidate->mision }}</textarea>
        </div>
        <button type="submit">Submit</button>
    </form>

</x-admin.layout>
