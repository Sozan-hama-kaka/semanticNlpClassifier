{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--    <div class="container mt-4">--}}
{{--        <h3 class="text-center mb-4">Document Classification Statistics</h3>--}}

{{--        <!-- Canvas element for Chart.js -->--}}
{{--        <div class="text-center">--}}
{{--            <canvas id="documentChart"></canvas>--}}
{{--        </div>--}}

{{--        <!-- Display Total Documents -->--}}
{{--        <div class="mt-4 text-center">--}}
{{--            <h4>Total Documents: <span id="totalDocuments">{{ $totalDocuments }}</span></h4>--}}
{{--        </div>--}}

{{--        <!-- Download Button for Chart -->--}}
{{--        <div class="mt-4 text-center">--}}
{{--            <button class="btn btn-primary" id="downloadChart">Download Chart</button>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <script>--}}
{{--        // Prepare data for the pie chart--}}
{{--        const labels = [];--}}
{{--        const dataCounts = [];--}}

{{--        @foreach($subfieldStats as $subfield => $stats)--}}
{{--        @foreach($stats['terms'] as $termStat)--}}
{{--        labels.push("{{ $termStat['term'] }}");--}}
{{--        dataCounts.push({{ $termStat['document_count'] }});--}}
{{--        @endforeach--}}
{{--        @endforeach--}}

{{--        const ctx = document.getElementById('documentChart').getContext('2d');--}}
{{--        const documentChart = new Chart(ctx, {--}}
{{--            type: 'pie',--}}
{{--            data: {--}}
{{--                labels: labels,--}}
{{--                datasets: [{--}}
{{--                    label: 'Document Count',--}}
{{--                    data: dataCounts,--}}
{{--                    backgroundColor: [--}}
{{--                        'rgba(255, 0, 0, 0.6)',      // Bright Red--}}
{{--                        'rgba(0, 255, 0, 0.6)',      // Bright Green--}}
{{--                        'rgba(0, 0, 255, 0.6)',      // Bright Blue--}}
{{--                        'rgba(255, 255, 0, 0.6)',    // Bright Yellow--}}
{{--                        'rgba(255, 165, 0, 0.6)',    // Bright Orange--}}
{{--                        'rgba(128, 0, 128, 0.6)',    // Purple--}}
{{--                        'rgba(0, 255, 255, 0.6)',    // Cyan--}}
{{--                        'rgba(255, 20, 147, 0.6)',   // Deep Pink--}}
{{--                        'rgba(128, 128, 0, 0.6)',    // Olive--}}
{{--                        'rgba(0, 128, 128, 0.6)'     // Teal--}}
{{--                    ],--}}
{{--                    borderColor: [--}}
{{--                        'rgba(255, 0, 0, 1)',        // Bright Red--}}
{{--                        'rgba(0, 255, 0, 1)',        // Bright Green--}}
{{--                        'rgba(0, 0, 255, 1)',        // Bright Blue--}}
{{--                        'rgba(255, 255, 0, 1)',      // Bright Yellow--}}
{{--                        'rgba(255, 165, 0, 1)',      // Bright Orange--}}
{{--                        'rgba(128, 0, 128, 1)',      // Purple--}}
{{--                        'rgba(0, 255, 255, 1)',      // Cyan--}}
{{--                        'rgba(255, 20, 147, 1)',     // Deep Pink--}}
{{--                        'rgba(128, 128, 0, 1)',      // Olive--}}
{{--                        'rgba(0, 128, 128, 1)'       // Teal--}}
{{--                    ],--}}
{{--                    borderWidth: 1--}}
{{--                }]--}}
{{--            },--}}
{{--            options: {--}}
{{--                responsive: true,--}}
{{--                maintainAspectRatio: false,--}}
{{--                plugins: {--}}
{{--                    legend: {--}}
{{--                        position: 'top',--}}
{{--                    },--}}
{{--                    title: {--}}
{{--                        display: true,--}}
{{--                        text: 'Document Classification by Term'--}}
{{--                    }--}}
{{--                }--}}
{{--            }--}}
{{--        });--}}

{{--        // Resize canvas--}}
{{--        document.getElementById('documentChart').style.width = '100%';--}}
{{--        document.getElementById('documentChart').style.height = '100%';--}}

{{--        // Download Chart functionality--}}
{{--        document.getElementById('downloadChart').addEventListener('click', function () {--}}
{{--            const link = document.createElement('a');--}}
{{--            link.href = documentChart.toBase64Image();--}}
{{--            link.download = 'document-classification-chart.png';--}}
{{--            link.click();--}}
{{--        });--}}
{{--    </script>--}}

{{--    <style>--}}
{{--        /* Center chart container */--}}
{{--        .text-center {--}}
{{--            display: flex;--}}
{{--            flex-direction: column;--}}
{{--            justify-content: center;--}}
{{--            align-items: center;--}}
{{--        }--}}
{{--    </style>--}}
{{--@endsection--}}
@extends('layouts.app')

@section('content')

    <ul class="nav nav-tabs" id="graphTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview"
                    type="button" role="tab" aria-controls="overview" aria-selected="true">Overview
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="llm-tab" data-bs-toggle="tab" data-bs-target="#llm" type="button" role="tab"
                    aria-controls="llm" aria-selected="false">LLM
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="sbert-tab" data-bs-toggle="tab" data-bs-target="#sbert" type="button"
                    role="tab" aria-controls="sbert" aria-selected="false">SBERT
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="word2vec-tab" data-bs-toggle="tab" data-bs-target="#word2vec" type="button"
                    role="tab" aria-controls="word2vec" aria-selected="false">Word2Vec
            </button>
        </li>
    </ul>

    <div class="tab-content mt-4" id="graphTabsContent">
        <div class="tab-pane fade show active chart-container" id="overview" role="tabpanel"
             aria-labelledby="overview-tab">
            <canvas id="overviewChart"></canvas>
        </div>
        <div class="tab-pane fade chart-container" id="llm" role="tabpanel" aria-labelledby="llm-tab">
            <canvas id="llmChart"></canvas>
        </div>
        <div class="tab-pane fade chart-container" id="sbert" role="tabpanel" aria-labelledby="sbert-tab">
            <canvas id="sbertChart"></canvas>
        </div>
        <div class="tab-pane fade chart-container" id="word2vec" role="tabpanel" aria-labelledby="word2vec-tab">
            <canvas id="word2vecChart"></canvas>
        </div>
    </div>

@endsection
