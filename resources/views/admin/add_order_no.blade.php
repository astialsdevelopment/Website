@extends('layouts.admin_app')
@section('content')
<?php $id=1;?>
<div class="row">   
<div class="col-lg-6">
    @if (session()->has('done1'))
    <div class="alert alert-success">
        {!! session()->get('done1') !!}
    </div>
@endif
@if (session()->has('error1'))
<div class="alert alert-danger">
    {!! session()->get('error1') !!}
</div>
@endif
<h1>Add Order No.</h1>
<form action="{{ route('add_order_no') }}" method="POST">
    @csrf
    <div class="form-group">
        <input class="form-control" type="number" name="order_no" placeholder="Order No." required>
    </div>
    <button type="submit" class="btn btn-success btn-lg">
        Add
    </button>
</form>

</div>
<div class="col-lg-6">
    <h1>Order No</h1>
<table class="table table-responsive table-striped table-hover">
<tr>
    <th>#</th>
    <th>Order No</th>
    <th>Actions</th>
</tr>
@foreach (\App\Models\Order_no::all() as $order)
<tr>
    <td>{{ $id }}</td>
    <td>{{ $order->order_no }}</td>
    
    <td>
        <form action="{{ route('delete_order_no') }}" method="POST">
            @csrf
            <input name="id" type="hidden" value="{{ $order->id }}">
            <button class="btn btn-danger" type="submit">
                <i class="fa fa-trash"></i>
            </button>
        </form>
    </td>
</tr>
<?php $id++;?>
@endforeach
</table>

</div>
</div>

@endsection