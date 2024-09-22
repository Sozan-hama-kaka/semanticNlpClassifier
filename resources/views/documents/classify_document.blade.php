@extends('layouts.app')

@section('content')
    <div class="mx-1">
        <h5>Please provide the abstract of your document for classification</h5>

        <div class="row">
            <div class="col-md-5">
                <form method="post" action="{{url('/findSemanticSimilarity')}}">
                    @csrf
                    <div class="mb-3">
                        <textarea name="summary" required class="form-control" id="summary" rows="20"
                                  placeholder="Document Abstract"></textarea>
                    </div>
                    <div class="mb-3">
                        <select class="form-select" aria-label="Default select example" required name="method">
                            <option value="" disabled selected>Select NLP Methodology</option>
                            <option value="llm">LLM</option>
                            <option value="sbert">S-BERT</option>
                            <option value="word2vec">Word2Vec</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-secondary-nav">Suggest Classification</button>
                    </div>
                </form>
            </div>
            <!-- Display the result here if it exists -->
            @if(isset($results))
                <div class="offset-2 col-md-4 mt-6">
                    <h5 class="text-success">Classification Result:</h5>

                    @foreach($results as $key=> $classification)
                        <div class="card mb-3">
                            <div class="card-body">
                                <!-- Show both method and term for the first card -->
                                @if($loop->first)
                                    <p class="card-text">
                                        <strong>Method:</strong> {{ isset($classification['method']) ? $classification['method'] : 'N/A' }}
                                    </p>
                                @else
                                    <!-- Show only the term for the rest of the cards -->

                                    <form method="post" action="{{url('/save-classification')}}">
                                        @csrf
                                        <h6 class="card-title d-flex">
                                            <strong>Term:</strong> {{ isset($classification['term']) ? $classification['term'] : 'N/A' }}
                                            <input type="hidden" name="termId" value="{{$termIds[$key-1]}}">
                                            <input type="hidden" name="summary" value="{{$classification['summary']}}">
                                            <button type="submit" class="btn btn-secondary-nav ms-auto">Classify
                                            </button>
                                        </h6>
                                    </form>

                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            <!-- Display any error messages here if they exist -->
            @if(isset($errorMessage))
                <div class="alert alert-danger mt-4">
                    <h5>Error:</h5>
                    <p>{{ $errorMessage }}</p>
                </div>
            @endif
        </div>
    </div>
@endsection
