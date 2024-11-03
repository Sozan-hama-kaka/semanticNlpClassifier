@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center align-items-center ">
        <div class="row">
            @if(!empty($document) && !empty($classification))
                <div class="col-md-6 offset-md-3" style="margin-top: 25px;">
                    <div class="text-center ">
                        <div class="d-flex justify-content-center mb-2">
                            <span class="fw-bold">Term Classifications: &nbsp;</span>
                            <span class="text-success fw-bold">{{$classification}}</span>
                        </div>
                        <div class="d-flex justify-content-center mb-2">
                            <span class="fw-bold">Document Title: &nbsp;</span>
                            <span>{{$document->title}}</span>
                        </div>
                        <div class="mb-2">
                            <span>{{$document->summary}}</span>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
