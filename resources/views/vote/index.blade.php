@extends('layouts.votes')
@section('content')
    <div class="  mt-10">
        <h1 class="text-4xl font-semibold text-center mb-6">Pilih Kandidat Anda</h1>
        <div class="flex gap-2 flex-wrap p-2 md:px-0 items-center justify-center">
            @foreach ($candidates as $candidate)
                <div class="bg-white max-w-sm  rounded-lg shadow-lg text-center overflow-hidden shrink-0">
                    <img src="{{ asset('storage/' . $candidate->image_url) }}" class="mx-auto w-full h-48 object-center   "
                        alt="{{ $candidate->title }}">
                    <div class="px-6 py-4">
                        <h2 class="text-xl font-semibold">{{ $candidate->title }}</h2>
                        <p class="text-gray-600">Nomor Urut: {{ $candidate->ordinal_number }}</p>
                        <div class="flex justify-between items-center gap-4">
                            <p>{{ $candidate->chairman }}</p>
                            <p>{{ $candidate->vice_chairman }}</p>
                        </div>
                        <div class="flex  gap-4">
                            <button onclick="vote({{ $candidate->id }})"
                                class="mt-4 w-full px-4 py-2 text-white transition bg-[#02559e] rounded-md hover:bg-[#243140]">
                                Vote
                            </button>
                            <button
                                class="mt-4 w-full px-4 py-2 text-white transition bg-[#02559e] rounded-md hover:bg-[#243140]">
                                Detail
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection



<script>
    function getTokenFromUrl() {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get('token');
    }

    async function vote(candidateId) {
        try {
            const token = getTokenFromUrl();

            if (!token) {
                alert("Token tidak ditemukan! Pastikan Anda menggunakan link yang benar.");
                return;
            }

            const response = await fetch('/vote', { // Use absolute path
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content'),
                    'Accept': 'application/json' // Add this header
                },
                body: JSON.stringify({
                    candidate_id: candidateId,
                    token: token
                })
            });

            // Check if response is JSON
            const contentType = response.headers.get('content-type');
            if (!contentType || !contentType.includes('application/json')) {
                throw new Error('Server response was not JSON');
            }

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.message || 'Terjadi kesalahan pada server');
            }

            alert(data.message || 'Vote berhasil!');
            window.location.href = '/login'; // Redirect to success page
        } catch (error) {
            console.error('Error details:', error);
            alert('Terjadi kesalahan: ' + error.message);
        }
    }
</script>
