@extends('layouts.app')

@section('content')
    <div class="mt-2">
       <h3>Classified Documents For {{$classificationName}}</h3>
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Sr#</th>
            <th scope="col">Title</th>
            <th scope="col">Document Name</th>
        </tr>
        </thead>
        <tbody>
        @foreach($relevantDocuments as $key => $document)
            <tr>
                <th>{{$key + 1}}</th>
                <td>{{$document->title}}</td>
                <td>{{$document->document_name}}</td>
                <td>
                    <form>
                        @csrf
                        <input type="hidden" value="{{$document->id}}" name="document_id">
                        <button type="submit" class="btn btn-secondary-nav ms-auto">View Document</button>
                    </form>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
