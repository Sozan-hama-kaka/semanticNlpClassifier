{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--    <div class="mt-2">--}}
{{--        <h3>Document Classification Statistics by Subfield</h3>--}}
{{--    </div>--}}

{{--    <table class="table table-striped">--}}
{{--        <thead>--}}
{{--        <tr>--}}
{{--            <th scope="col">Subfield</th>--}}
{{--            <th scope="col">Term</th>--}}
{{--            <th scope="col">Document Count</th>--}}
{{--        </tr>--}}
{{--        </thead>--}}
{{--        <tbody>--}}
{{--        @foreach($subfieldStats as $subfield => $stats)--}}
{{--            <tr>--}}
{{--                <td colspan="3"><strong>{{ $subfield }}</strong> ({{ $stats['total_documents'] }} documents)</td>--}}
{{--            </tr>--}}
{{--            @foreach($stats['terms'] as $termStat)--}}
{{--                <tr>--}}
{{--                    <td></td>--}}
{{--                    <td>{{ $termStat['term'] }}</td>--}}
{{--                    <td>{{ $termStat['document_count'] }}</td>--}}
{{--                </tr>--}}
{{--            @endforeach--}}
{{--        @endforeach--}}
{{--        </tbody>--}}
{{--    </table>--}}
{{--@endsection--}}

{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--    <div class="container mt-4">--}}
{{--        <h3 class="text-center mb-4">Document Classification Statistics</h3>--}}

{{--        <div class="table-responsive">--}}
{{--            <table class="table table-bordered table-striped ">--}}
{{--                <thead class="thead-light">--}}
{{--                <tr>--}}
{{--                    <th scope="col">Term</th>--}}
{{--                    <th scope="col">Document Count</th>--}}
{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--                @php--}}
{{--                    $totalDocuments = 0; // Initialize total document count--}}
{{--                @endphp--}}

{{--                @foreach($subfieldStats as $stats)--}}
{{--                    @foreach($stats['terms'] as $termStat)--}}
{{--                        @php--}}
{{--                            $totalDocuments += $termStat['document_count']; // Accumulate total documents--}}
{{--                        @endphp--}}
{{--                        <tr>--}}
{{--                            <td>{{ $termStat['term'] }}</td>--}}
{{--                            <td>{{ $termStat['document_count'] }}</td>--}}
{{--                        </tr>--}}
{{--                    @endforeach--}}
{{--                @endforeach--}}
{{--                </tbody>--}}
{{--                <tfoot>--}}
{{--                <tr class="table-secondary">--}}
{{--                    <td><strong>Total Documents</strong></td>--}}
{{--                    <td><strong>{{ $totalDocuments }}</strong></td>--}}
{{--                </tr>--}}
{{--                </tfoot>--}}
{{--            </table>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}

@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h3 class="text-center mb-4">Document Classification Statistics</h3>

        <!-- Canvas element for Chart.js -->
        <div class="text-center">
            <canvas id="documentChart"></canvas>
        </div>
        <div class="mt-4 text-center">
            <h4>Total Documents: <span id="totalDocuments">{{ $totalDocuments }}</span></h4> <!-- Display total documents -->
        </div>

        <div class="mt-4 text-center">
            <button class="btn btn-primary" id="downloadChart">Download Chart</button>
        </div>


    </div>

{{--    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>--}}
    <script>
        // Prepare data for the pie chart
        const labels = [];
        const dataCounts = [];

        @foreach($subfieldStats as $stats)
        @foreach($stats['terms'] as $termStat)
        labels.push("{{ $termStat['term'] }}");
        dataCounts.push({{ $termStat['document_count'] }});
        @endforeach
        @endforeach

        const ctx = document.getElementById('documentChart').getContext('2d');
        const documentChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Document Count',
                    data: dataCounts,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)', // Color 1
                        'rgba(54, 162, 235, 0.6)', // Color 2
                        'rgba(255, 206, 86, 0.6)', // Color 3
                        'rgba(75, 192, 192, 0.6)', // Color 4
                        'rgba(153, 102, 255, 0.6)', // Color 5
                        'rgba(255, 159, 64, 0.6)', // Color 6
                        'rgba(255, 99, 71, 0.6)', // Color 7 (Tomato)
                        'rgba(100, 149, 237, 0.6)', // Color 8 (Cornflower Blue)
                        'rgba(173, 216, 230, 0.6)', // Color 9 (Light Blue)
                        'rgba(144, 238, 144, 0.6)', // Color 10 (Light Green)
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)', // Color 1
                        'rgba(54, 162, 235, 1)', // Color 2
                        'rgba(255, 206, 86, 1)', // Color 3
                        'rgba(75, 192, 192, 1)', // Color 4
                        'rgba(153, 102, 255, 1)', // Color 5
                        'rgba(255, 159, 64, 1)', // Color 6
                        'rgba(255, 99, 71, 1)', // Color 7 (Tomato)
                        'rgba(100, 149, 237, 1)', // Color 8 (Cornflower Blue)
                        'rgba(173, 216, 230, 1)', // Color 9 (Light Blue)
                        'rgba(144, 238, 144, 1)', // Color 10 (Light Green)
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, // Allow custom size
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Document Classification by Term'
                    }
                }
            }
        });

        // Set canvas size after rendering
        document.getElementById('documentChart').style.width = '100%';
        document.getElementById('documentChart').style.height = '100%';

        // Optional: Function to download the chart as an image
        document.getElementById('downloadChart').addEventListener('click', function() {
            const link = document.createElement('a');
            link.href = documentChart.toBase64Image();
            link.download = 'document-classification-chart.png';
            link.click();
        });
    </script>

    <style>
        /* Center the chart container */
        .text-center {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
    </style>

@endsection


