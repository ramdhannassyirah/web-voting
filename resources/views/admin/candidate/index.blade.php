<x-admin.layout>


    <div class="flex w-full justify-between items-center  mb-4">
        <ol class="flex items-center gap-2 mb-4">
            <li>
                <a class="font-medium" href="index.html">Dashboard /</a>
            </li>
            <li class="font-medium text-primary">Daftar Calon</li>
        </ol>
        <a href="{{ route('candidates.create') }}" class="px-4 py-2 text-white bg-blue-500 rounded-md">Buat Calon</a>
    </div>

    @if (session('success'))
        <div class="p-4 mb-4 text-white bg-green-500 rounded">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border border-collapse border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2 border">No</th>
                <th class="p-2 border">Nama Paslon</th>
                <th class="p-2 border">Ketua</th>
                <th class="p-2 border">Wakil Ketua</th>
                <th class="p-2 border">Total Suara</th>
                <th class="p-2 border">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($candidates as $candidate)
                <tr>
                    <td class="p-2 border text-center">{{ $loop->iteration }}</td>
                    <td class="p-2 border">{{ $candidate->title }}</td>
                    <td class="p-2 border">{{ $candidate->chairman }}</td>
                    <td class="p-2 border">{{ $candidate->vice_chairman }}</td>
                    <td class="p-2 border">{{ $candidate->votes_count }} Suara</td>
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
