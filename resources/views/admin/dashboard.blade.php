<x-admin.layout>
    <div class="container mx-auto mt-10">
        <h1 class="text-2xl font-bold text-center mb-6">Generate Token Voting</h1>

        <div class="flex flex-col items-center">
            <button onclick="generateToken()"
                class="px-6 py-3 bg-blue-500 text-white font-bold rounded-md hover:bg-blue-700 transition">
                Generate Token
            </button>

            <div id="tokenContainer" class="mt-6 hidden">
                <p class="text-lg font-semibold">Token:</p>
                <input type="text" id="generatedToken" readonly class="px-4 py-2 border rounded-md w-80 text-center">
                <button onclick="copyToken()"
                    class="mt-2 px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-700 transition">
                    Copy Token
                </button>
            </div>
        </div>
    </div>

    <script>
        function generateToken() {
            fetch("{{ route('invite.generate') }}")
                .then(response => response.json())
                .then(data => {
                    document.getElementById('generatedToken').value = data.invite_link;
                    document.getElementById('tokenContainer').classList.remove('hidden');
                })
                .catch(error => console.error("Error:", error));
        }

        function copyToken() {
            let tokenInput = document.getElementById('generatedToken');
            tokenInput.select();
            document.execCommand("copy");
            alert("Token berhasil disalin!");
        }
    </script>
</x-admin.layout>
