<x-admin.layout>
    <div class="grid grid-cols-3 gap-2">
        @foreach (range(1, 5) as $i)
            <x-admin.partial.card-candidate />
        @endforeach
    </div>
</x-admin.layout>
