@extends('layouts.app')
@section("title") Question Banks @endsection
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
        <th> Question </th>
        <th> Answer </th>
        <th> Type </th>
        <th> Action </th>
    </thead>
    <tbody>

        @if(count($banks) > 0)
        @foreach($banks as $bank)
        <tr>
            <td> {{$bank->id}} </td>
            <td> {{$bank->question}} </td>
            <td> {{$bank->getAnswer()}} </td>
            <td> {{$bank->getTypeName()}} </td>
            <td>
                <form action="{{route('qbank.delete', $bank->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger"> Delete </button>
                </form>
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>

{!! $banks->links() !!}
@endsection