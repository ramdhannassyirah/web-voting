@props(['candidate'])
<div class="max-w-sm p-4 overflow-hidden bg-white rounded-lg shadow-lg w-sm ">
    <div class="flex justify-center w-full">
        <img src="{{ asset('images/paslon1.png') }}" class="object-cover w-full h-64 rounded-md" alt="Paslon 1">
    </div>
    <div class="mt-4">
        <h1 class="text-xl font-semibold text-center">{{ $candidate->title }}</h1>
        <div class="flex justify-around mt-4 text-gray-700">
            <h2>{{ $candidate->chairman }}</h2>
            <h2>{{ $candidate->vice_chairman }}</h2>
        </div>

    </div>
    <div class="flex gap-2 mt-4 text-center">
        <button onclick="vote({{ $candidate->id }})"
            class="w-full px-4 py-2 mt-2 text-white transition bg-blue-500 rounded-md hover:bg-blue-700">
            Vote
        </button>
        <button class="w-full px-4 py-2 text-white transition bg-blue-500 rounded-md hover:bg-blue-700">
            Detail
        </button>
    </div>
</div>

<script>
    function vote(candidateId) {
        fetch("{{ route('vote.store') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    candidate_id: candidateId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.message === "Vote berhasil!") {
                    alert(data.message);
                    document.getElementById(`votes-count-${candidateId}`).innerText = data.totalVotes;
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error("Error:", error));
    }
</script>
