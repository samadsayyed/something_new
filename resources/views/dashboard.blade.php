<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 px-4">
        <div class="max-w-4xl mx-auto p-4 bg-white shadow-md rounded-lg">
            <!-- Recitation Chart -->
            <div class="bg-gray-50 p-3 rounded-md shadow mb-4">
                <canvas id="recitationChart" class="w-full h-48"></canvas>
            </div>

            <!-- Recitation Table -->
            <div class="mt-4">
                <h3 class="text-md font-semibold text-gray-700 mb-2">Recitation History</h3>
                <div class="overflow-x-auto bg-gray-50 p-3 rounded-md shadow" style="max-height: 400px; overflow-y: auto;">
                    <table class="w-full text-sm border border-gray-200">
                        <thead class="bg-gray-100 text-gray-700">
                            <tr>
                                <th class="border px-2 py-1">Date</th>
                                <th class="border px-2 py-1">Durud Count</th>
                                <th class="border px-2 py-1">Quran Para Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalDurud = $dailyTotals->sum('total_durud');
                                $totalPara = $dailyTotals->sum('total_para');
                            @endphp
                            @foreach ($dailyTotals as $total)
                                <tr class="text-gray-600 text-center">
                                    <td class="border px-2 py-1">{{ $total['date'] }}</td>
                                    <td class="border px-2 py-1">{{ $total['total_durud'] }}</td>
                                    <td class="border px-2 py-1">{{ $total['total_para'] }}</td>
                                </tr>
                            @endforeach
                            <!-- Total row -->
                            <tr class="font-semibold text-gray-700 text-center">
                                <td class="border px-2 py-1">Total</td>
                                <td class="border px-2 py-1">{{ $totalDurud }}</td>
                                <td class="border px-2 py-1">{{ $totalPara }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>

        <!-- Recitation Submission Form -->
        <div class="max-w-3xl mx-auto mt-8 bg-white p-4 sm:p-8 rounded-lg mb-7">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Submit Your Durood and Recitation</h2>

            <!-- Error message div, initially hidden -->
            <div id="error-message"
                class="hidden p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-md border border-red-400">
                <strong>Error:</strong> At least one of the fields (Durood Sharif or Para(s) of Quran) must be greater
                than 0 to submit.
            </div>

            <!-- Success message div, initially hidden -->
            <div id="success-message"
                class="hidden p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-md border border-green-400">
                <strong>Success:</strong> Your submission was successful!
            </div>

            <form method="POST" action="{{ route('recitation.create') }}" class="grid gap-4" id="recitationForm">
                @csrf
                <div class="grid grid-cols-2 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="durud_count" class="block text-sm font-medium text-gray-700 mb-1">
                            Read Durood Sharif(times) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="durud_count" name="durud_count" value="0"
                            placeholder="Read Durood Sharif(times)"
                            class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm p-2"
                            required>
                    </div>
                    <div>
                        <label for="para_count" class="block text-sm font-medium text-gray-700 mb-1">
                            Para(s) of Quran Majeed
                        </label>
                        <input type="number" id="para_count" name="para_count" value="0"
                            placeholder="Para(s) of Quran Majeed"
                            class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm p-2">
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="submit"
                        class="px-6 py-2 bg-black text-white font-medium text-sm rounded-lg shadow-md hover:bg-green-800">
                        Submit
                    </button>
                </div>
            </form>
        </div>

        <!-- Include Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const ctx = document.getElementById("recitationChart").getContext("2d");
        
                const data = {
                    labels: @json($dailyTotals->pluck('date')),
                    datasets: [
                        {
                            label: "Durud Read",
                            data: @json($dailyTotals->pluck('total_durud')),
                            backgroundColor: "rgba(0, 0, 255, 0.5)",
                            borderColor: "blue",
                            borderWidth: 1
                        },
                        {
                            label: "Quran Para Read",
                            data: @json($dailyTotals->pluck('total_para')),
                            backgroundColor: "rgba(0, 128, 0, 0.5)",
                            borderColor: "green",
                            borderWidth: 1
                        }
                    ]
                };
        
                new Chart(ctx, {
                    type: "bar",
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
        

        <script>
            document.getElementById('recitationForm').addEventListener('submit', function(event) {
                // Get the values of the input fields
                const durudCount = parseInt(document.getElementById('durud_count').value);
                const paraCount = parseInt(document.getElementById('para_count').value);

                // Check if both are 0
                if (durudCount <= 0 && paraCount <= 0) {
                    // Prevent form submission
                    event.preventDefault();

                    // Show the error message
                    const errorMessage = document.getElementById('error-message');
                    errorMessage.classList.remove('hidden');

                    // Hide the error message after 5 seconds (5000 milliseconds)
                    setTimeout(function() {
                        errorMessage.classList.add('hidden');
                    }, 5000);
                } else {
                    // Show the success message
                    const successMessage = document.getElementById('success-message');
                    successMessage.classList.remove('hidden');

                    // Hide the success message after 5 seconds (5000 milliseconds)
                    setTimeout(function() {
                        successMessage.classList.add('hidden');
                    }, 5000);
                }
            });
        </script>
    </div>
</x-app-layout>
