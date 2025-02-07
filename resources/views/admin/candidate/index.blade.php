<x-admin.layout>
    <div class="flex justify-between mb-4">
        <h1 class="text-xl font-bold">Candidate List</h1>
        <a href="{{ route('candidates.create') }}" class="px-4 py-2 text-white bg-blue-500 rounded-lg">Add Candidate</a>
    </div>

    @if (session('success'))
        <div class="p-4 mb-4 text-white bg-green-500 rounded">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border border-collapse border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2 border">#</th>
                <th class="p-2 border">Title</th>
                <th class="p-2 border">Chairman</th>
                <th class="p-2 border">Vice Chairman</th>
                <th class="p-2 border">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($candidates as $candidate)
                <tr>
                    <td class="p-2 border">{{ $loop->iteration }}</td>
                    <td class="p-2 border">{{ $candidate->title }}</td>
                    <td class="p-2 border">{{ $candidate->chairman }}</td>
                    <td class="p-2 border">{{ $candidate->vice_chairman }}</td>
                    <td class="p-2 border">
                        <a href="{{ route('candidates.edit', $candidate->slug) }}" class="text-blue-500">Edit</a>
                        <form action="{{ route('candidates.destroy', $candidate->slug) }}" method="POST"
                            class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-admin.layout>
