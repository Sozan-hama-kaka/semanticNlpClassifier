@extends('layouts.app')

@section('content')
    <div class="mt-2">
       <h3>Classified Documents For {{$classificationName}}</h3>
    </div>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Nr.</th>
            <th scope="col">Document Title</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($relevantDocuments as $key => $document)
            <tr>
                <th>{{$key + 1}}</th>
                <td>{{$document->title}}</td>
                <td>{{$document->document_name}}</td>
                <td>
                    <form method="post" action="{{url('/view-document')}}">
                        @csrf
                        <input type="hidden" value="{{$document->id}}" name="document_id">
                        <button type="submit" class="btn btn-secondary-nav ms-auto">View Document</button>
                    </form>
                </td>
                <td>
                    <form method="post" action="{{url('/delete-single-classification')}}">
                        @csrf
                        <input type="hidden" value="{{$document->id}}" name="document_id">
                        <input type="hidden" value="{{$classificationId}}" name="classification_id">
                        <button type="submit" class="btn btn-danger-nav ms-auto">Delete Document Classification</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
