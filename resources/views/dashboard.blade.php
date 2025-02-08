<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 px-4">
        
        <div class="max-w-4xl mx-auto p-4 bg-white shadow-md rounded-lg px-4 ">

            <!-- Recitation Chart -->
            <div class="bg-gray-50 p-3 rounded-md shadow">
                <canvas id="recitationChart" class="w-full h-40"></canvas>
            </div>

            <!-- Recitation Table -->
            <div class="mt-4">
                <h3 class="text-md font-semibold text-gray-700 mb-2">Recitation History</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm border border-gray-200">
                        <thead class="bg-gray-100 text-gray-700">
                            <tr>
                                <th class="border px-2 py-1">Date</th>
                                <th class="border px-2 py-1">Durud Count</th>
                                <th class="border px-2 py-1">Quran Para Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recitations as $recitation)
                                <tr class="text-gray-600 text-center">
                                    <td class="border px-2 py-1">{{ $recitation->date }}</td>
                                    <td class="border px-2 py-1">{{ $recitation->durud_count }}</td>
                                    <td class="border px-2 py-1">{{ $recitation->quran_para_count }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>

        <!-- Include Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const ctx = document.getElementById("recitationChart").getContext("2d");

                const data = {
                    labels: @json($recitations->pluck('date')),
                    datasets: [{
                            label: "Durud Read",
                            data: @json($recitations->pluck('durud_count')),
                            borderColor: "blue",
                            backgroundColor: "rgba(0, 0, 255, 0.2)",
                            fill: true
                        },
                        {
                            label: "Quran Para Read",
                            data: @json($recitations->pluck('quran_para_count')),
                            borderColor: "green",
                            backgroundColor: "rgba(0, 128, 0, 0.2)",
                            fill: true
                        }
                    ]
                };

                new Chart(ctx, {
                    type: "line",
                    data: data,
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            x: {
                                title: {
                                    display: false
                                }
                            },
                            y: {
                                title: {
                                    display: false
                                },
                                ticks: {
                                    stepSize: 1
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: true,
                                position: "top"
                            }
                        }
                    }
                });
            });
        </script>
    </div>
</x-app-layout>
