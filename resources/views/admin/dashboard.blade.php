<x-admin.layout>
    {{-- Container responsif untuk chart --}}
    <div class="container mx-auto p-4">
        <div class="bg-white p-4 mb-4 rounded-md shadow-md">
            <h1 class="text-xl font-semibold">Total Voting</h1>
            @foreach ($candidates as $candidate)
                <div class="flex gap-4 items-center">
                    <p>{{ $candidate->title }} : <span>{{ $candidate->votes_count }}</span></p>
                </div>
            @endforeach
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold mb-4 text-center">Hasil Voting</h2>
            {{-- Gunakan div responsif dengan rasio aspek yang terjaga --}}
            <div class="w-full flex justify-center items-center max-w-3xl mx-auto" style="min-height: 300px;">
                <canvas id="myChart"></canvas>
            </div>
        </div>

    </div>

    {{-- Loading indicator --}}
    <div id="loadingIndicator" class="text-center p-4 hidden">
        <p>Loading chart...</p>
    </div>

    {{-- Error message container --}}
    <div id="errorContainer" class="text-red-500 p-4 hidden">
    </div>

    {{-- Chart.js dari CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loadingIndicator = document.getElementById('loadingIndicator');
            const errorContainer = document.getElementById('errorContainer');
            const ctx = document.getElementById('myChart').getContext('2d');

            // Fungsi untuk mengatur ukuran chart
            function resizeChart() {
                const container = document.querySelector('[style*="min-height"]');
                if (container) {
                    // Atur tinggi berdasarkan lebar untuk menjaga rasio aspek
                    const width = container.offsetWidth;
                    const height = Math.min(width * 0.75, 600); // Maksimum tinggi 600px
                    container.style.height = `${height}px`;
                }
            }

            // Panggil fungsi resize saat halaman dimuat dan saat ukuran window berubah
            window.addEventListener('resize', resizeChart);
            resizeChart();

            // Tampilkan loading
            loadingIndicator.classList.remove('hidden');

            try {
                // Data dari controller Laravel
                const chartData = @json($candidates);

                // Validasi data
                if (!Array.isArray(chartData)) {
                    throw new Error('Data harus berupa array');
                }

                if (chartData.length === 0) {
                    throw new Error('Data kosong');
                }

                // Persiapkan data untuk chart
                const labels = chartData.map(candidate => candidate.title);
                const votes = chartData.map(candidate => candidate.votes_count);

                // Warna untuk setiap slice pie chart
                const backgroundColors = [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(153, 102, 255)',
                    'rgb(255, 159, 64)',
                    'rgb(201, 203, 207)',
                    'rgb(0, 162, 71)',
                ];

                // Konfigurasi chart yang responsif
                const config = {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Jumlah Suara',
                            data: votes,
                            backgroundColor: backgroundColors.slice(0, labels.length),
                            borderColor: 'rgb(255, 255, 255)',
                            borderWidth: 2,
                            hoverOffset: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    padding: 20,
                                    font: {
                                        size: 12
                                    },
                                    // Membuat legend responsif
                                    boxWidth: (context) => {
                                        const width = context.chart.width;
                                        return width < 400 ? 10 : 15;
                                    },
                                    // Memendekkan teks yang terlalu panjang
                                    generateLabels: (chart) => {
                                        const datasets = chart.data.datasets;
                                        const labels = chart.data.labels;
                                        return labels.map((label, i) => ({
                                            text: label.length > 20 ? label.substring(0, 20) +
                                                '...' : label,
                                            fillStyle: datasets[0].backgroundColor[i],
                                            hidden: !chart.getDataVisibility(i),
                                            index: i
                                        }));
                                    }
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const label = context.label || '';
                                        const value = context.raw || 0;
                                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                        const percentage = ((value / total) * 100).toFixed(1);
                                        return `${label}: ${value} suara (${percentage}%)`;
                                    }
                                }
                            }
                        },
                        // Layout responsif
                        layout: {
                            padding: {
                                top: 10,
                                right: 10,
                                bottom: 10,
                                left: 10
                            }
                        }
                    }
                };

                // Buat chart
                new Chart(ctx, config);

                // Sembunyikan loading
                loadingIndicator.classList.add('hidden');

            } catch (error) {
                console.error('Error creating chart:', error);
                errorContainer.classList.remove('hidden');
                errorContainer.textContent = `Error: ${error.message}`;
                loadingIndicator.classList.add('hidden');
            }
        });
    </script>
</x-admin.layout>
