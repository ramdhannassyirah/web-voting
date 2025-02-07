<x-admin.layout>

    <form action="{{ route('candidates.update', $candidate->slug) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input type="text" name="title" value="{{ $candidate->title }}" required>
        <input type="text" name="chairman" value="{{ $candidate->chairman }}" required>
        <input type="text" name="vice_chairman" value="{{ $candidate->vice_chairman }}" required>
        <textarea name="vision" required>{{ $candidate->vision }}</textarea>
        <textarea name="mision" required>{{ $candidate->mision }}</textarea>

        <button type="submit">Update</button>
    </form>

</x-admin.layout>
