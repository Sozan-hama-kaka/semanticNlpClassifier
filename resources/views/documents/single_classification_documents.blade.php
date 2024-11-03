{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--    <div class="mt-2">--}}
{{--       <h3>Classified Documents For {{$classificationName}}</h3>--}}
{{--    </div>--}}

{{--    <table class="table table-striped">--}}
{{--        <thead>--}}
{{--        <tr>--}}
{{--            <th scope="col">Nr.</th>--}}
{{--            <th scope="col">Document Title</th>--}}
{{--        </tr>--}}
{{--        </thead>--}}
{{--        <tbody>--}}
{{--        @foreach($relevantDocuments as $key => $document)--}}
{{--            <tr>--}}
{{--                <th>{{$key + 1}}</th>--}}
{{--                <td>{{$document->title}}</td>--}}
{{--                <td>--}}
{{--                    <form method="post" action="{{url('/view-document')}}">--}}
{{--                        @csrf--}}
{{--                        <input type="hidden" value="{{$document->id}}" name="document_id">--}}
{{--                        <button type="submit" class="btn btn-secondary-nav ms-auto">View Document</button>--}}
{{--                    </form>--}}

{{--                </td>--}}
{{--            </tr>--}}
{{--        @endforeach--}}
{{--        </tbody>--}}
{{--    </table>--}}
{{--@endsection--}}

@extends('layouts.app')

@section('content')
    <div class="mt-2">
        <h3>Classified Documents For {{$classificationName}}</h3>
    </div>

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
                <td>
                    <form method="post" action="{{ url('/view-document') }}" class="d-inline">
                        @csrf
                        <input type="hidden" value="{{$document->id}}" name="document_id">
                        <button type="submit" class="btn btn-secondary-nav ms-auto">View Document</button>
                    </form>

                    <form method="post" action="{{ url('/delete-document/' . $document->id) }}" class="d-inline"
                          onsubmit="return confirm('Are you sure you want to delete this document?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-secondary-nav ms-auto">Delete Document</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
