@extends('layouts.app')
@section("title") Question Sets @endsection
@section("content")

<div class="row mb-4">
    <div class="col-xl-6">
        @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">× </button>
            {{Session::get('success')}}
        </div>
        @elseif(Session::has('failed'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">× </button>
            {{Session::get('failed')}}
        </div>
        @endif
    </div>
    <div class="col-xl-6 text-right">
        <a href="{{route('questions.create')}}" class="btn btn-success "> Add New </a>
    </div>
</div>

<table class="table table-striped">
    <thead>
        <th> Id </th>
        <th> Title </th>
        <th> Expire </th>
        <th> Mail Status </th>
        <th> Action </th>
    </thead>
    <tbody>

        @if(count($questions) > 0)
        @foreach($questions as $bank)
        <tr>
            <td> {{$bank->id}} </td>
            <td> {{$bank->title}} </td>
            <td> {{$bank->expiry_date}} </td>
            <td> {{$bank->getMailStatus()}} </td>
            <td>
                <a href="{{route('questions.email', $bank->id)}}" class="btn btn-sm btn-info"> Send </a>
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>

{!! $questions->links() !!}
@endsection