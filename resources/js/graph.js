import { Chart } from 'chart.js/auto';

window.addEventListener('load', function () {
    const statistics = {
        LLM: {
            accuracy: 0.9800,
            precision: 0.9840,
            recall: 0.9800,
            f1_score: 0.9711
        },
        SBERT: {
            accuracy: 0.8400,
            precision: 0.8700,
            recall: 0.8200,
            f1_score: 0.8600
        },
        Word2Vec: {
            accuracy: 0.6000,
            precision: 0.7000,
            recall: 0.5500,
            f1_score: 0.6150
        }
    };

    let charts = {};

    function createChart(chartId, dataset) {
        let ctx = document.getElementById(chartId).getContext('2d');
        return new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Accuracy', 'Precision', 'Recall', 'F1-Score'],
                datasets: [{
                    label: dataset.label,
                    data: [
                        dataset.accuracy * 100,
                        dataset.precision * 100,
                        dataset.recall * 100,
                        dataset.f1_score * 100
                    ],
                    backgroundColor: 'rgba(54, 162, 235, 0.8)'
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        ticks: {
                            callback: function (value) {
                                return value + '%';  // Show percentage symbol on Y-axis
                            }
                        }
                    }
                }
            }
        });
    }

    // Initialize Overview Chart by default
    charts.overview = new Chart(document.getElementById('overviewChart'), {
        type: 'bar',
        data: {
            labels: ['Accuracy', 'Precision', 'Recall', 'F1-Score'],
            datasets: [
                {
                    label: 'LLM',
                    data: [
                        statistics.LLM.accuracy * 100,
                        statistics.LLM.precision * 100,
                        statistics.LLM.recall * 100,
                        statistics.LLM.f1_score * 100
                    ],
                    backgroundColor: 'rgba(54, 162, 235, 0.8)'
                },
                {
                    label: 'SBERT',
                    data: [
                        statistics.SBERT.accuracy * 100,
                        statistics.SBERT.precision * 100,
                        statistics.SBERT.recall * 100,
                        statistics.SBERT.f1_score * 100
                    ],
                    backgroundColor: 'rgba(75, 192, 192, 0.8)'
                },
                {
                    label: 'Word2Vec',
                    data: [
                        statistics.Word2Vec.accuracy * 100,
                        statistics.Word2Vec.precision * 100,
                        statistics.Word2Vec.recall * 100,
                        statistics.Word2Vec.f1_score * 100
                    ],
                    backgroundColor: 'rgba(255, 159, 64, 0.8)'
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    ticks: {
                        callback: function (value) {
                            return value + '%';  // Show percentage symbol on Y-axis
                        }
                    }
                }
            }
        }
    });

    // Handle tab clicks and create charts as needed
    document.getElementById('graphTabs').addEventListener('click', function (e) {
        const targetId = e.target.getAttribute('aria-controls');

        if (targetId === 'llm' && !charts.llm) {
            charts.llm = createChart('llmChart', { label: 'LLM', ...statistics.LLM });
        } else if (targetId === 'sbert' && !charts.sbert) {
            charts.sbert = createChart('sbertChart', { label: 'SBERT', ...statistics.SBERT });
        } else if (targetId === 'word2vec' && !charts.word2vec) {
            charts.word2vec = createChart('word2vecChart', { label: 'Word2Vec', ...statistics.Word2Vec });
        }
    });
});
