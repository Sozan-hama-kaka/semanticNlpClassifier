@extends('layouts.app')

@section('content')
    <div class="mx-1">


        <div class="row">
            <div class="col-md-5">
                @if(!empty($results))
                    <p class="fs-3 fw-bold mt-2 p-2">Text Provided by the User </p>
                    <p class="fs-6 mt-3 lh-lg text-md-justify p-2">
                        {{$results[1]['summary']}}
                    </p>
                @else
                    <h6>Please provide the Text for classification.</h6>
                    <form method="post" action="{{url('/findSemanticSimilarity')}}">
                        @csrf
                        <div class="mb-3">
                        <textarea name="summary" required class="form-control" id="summary" rows="8"
                                  placeholder="Document Abstract"></textarea>
                        </div>
                        <div class="mb-3">
                            <select class="form-select" aria-label="Default select example" required name="method">
                                <option value="" disabled selected>Select NLP Technique</option>
                                <option value="llm">LLM</option>
                                <option value="sbert">SBERT</option>
                                <option value="word2vec">Word2Vec</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-secondary-nav">Suggest Classification</button>
                        </div>
                    </form>
                @endif
            </div>
            @if(isset($results))
                <div class="offset-2 col-md-4 mt-6">
                    <h5 class="text-success">Classification Result:</h5>

                    @foreach($results as $key=> $classification)
                        <div class="card mb-3">
                            <div class="card-body">
                                @if($loop->first)
                                    <p class="card-text">
                                        <strong>Method:</strong> {{ isset($classification['method']) ? $classification['method'] : 'N/A' }}
                                    </p>
                                @else
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
            @if(isset($errorMessage))
                <div class="alert alert-danger mt-4">
                    <h5>Error:</h5>
                    <p>{{ $errorMessage }}</p>
                </div>
            @endif
        </div>
    </div>
@endsection
