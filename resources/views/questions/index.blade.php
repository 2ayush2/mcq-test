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
        @else
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">× </button>
            {{Session::get('failed')}}
        </div>
        @endif
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

        @if(count($banks) > 0)
        @foreach($banks as $bank)
        <tr>
            <td> {{$bank->id}} </td>
            <td> {{$bank->title}} </td>
            <td> {{$bank->getMailStatus()}} </td>
            <td>
                <a href="{{route('articles.show', $article->id)}}" class="btn btn-sm btn-info"> View </a>
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>

{!! $banks->links() !!}
@endsection