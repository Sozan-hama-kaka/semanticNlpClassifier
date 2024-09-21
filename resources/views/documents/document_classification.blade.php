@extends('layouts.app')

@section('content')
    <div class="mx-1">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Sr#</th>
                <th scope="col">Classifications</th>
            </tr>
            </thead>
            <tbody>
            @foreach($classifications as $key => $classification)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$classification->term}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
@endsection
