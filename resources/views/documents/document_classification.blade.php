@extends('layouts.app')

@section('content')
    <div class="mx-1">
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
                <th scope="col">Term Classifications</th>
            </tr>
            </thead>
            <tbody>
            @foreach($classifications as $key => $classification)
                <tr>
                    <th>{{$key + 1}}</th>
                    <td>{{$classification->term}}</td>
                    <td>
                        <form method="post" action="{{url('/view-single-classification')}}">
                            @csrf
                            <input type="hidden" value="{{$classification->id}}" name="classification_id">
                            <input type="hidden" value="{{$classification->term}}" name="classification_name">
                            <button type="submit" class="btn btn-secondary-nav ms-auto">View Classified Documents</button>
                        </form>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
@endsection
