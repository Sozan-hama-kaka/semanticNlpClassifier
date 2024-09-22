@extends('layouts.app')

@section('content')
    <div class="mx-1">
        <h5>To classify document please write the abstract of your document here</h5>

        <div class="row">
            <div class="col-md-8">
                <form method="post" action="{{url('/findSemanticSimilarity')}}">
                    @csrf
                    <div class="mb-3">
                        <label for="summary" class="form-label">Document Abstract</label>
                        <textarea name="summary" required class="form-control" id="summary" rows="10"></textarea>
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
            <div class="col-md-4">
                <img class="w-100" src="{{url('images/document-bg.png')}}" alt="bg-image"/>
            </div>
        </div>
    </div>
@endsection
