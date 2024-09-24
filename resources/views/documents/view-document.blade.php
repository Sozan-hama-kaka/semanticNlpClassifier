@extends('layouts.app')

@section('content')
    <div class="mx-1">
        <div class="row">
            @if(!empty($document) && !empty($classification))
                <div class="col-md-6">
                    <div class="d-flex mb-2">
                        <span class="fw-bold">Document Name: &nbsp;</span>
                        <span>{{$document->document_name}}</span>
                    </div>
                    <div class="d-flex mb-2">
                        <span class="fw-bold">Document Title: &nbsp;</span>
                        <span>{{$document->title}}</span>
                    </div>
                    <div class="d-flex mb-2">
                        <span class="fw-bold">Classification: &nbsp;</span>
                        <span class="text-success fw-bold">{{$classification}}</span>
                    </div>
                    <div class="d-flex mb-2">
                        <span class="fw-bold">Classification: &nbsp;</span>
                        <span>&nbsp;{{$document->summary}}</span>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
