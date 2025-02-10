<div class="container mx-auto px-4 py-8">
    <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Token Sudah Digunakan!</strong>
        <span class="block sm:inline">{{ $message }}</span>
        @if (isset($voted_at))
            <p class="mt-2">Waktu voting: {{ $voted_at->format('d M Y H:i:s') }}</p>
        @endif
    </div>
</div>
