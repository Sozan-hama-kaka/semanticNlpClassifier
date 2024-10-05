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
