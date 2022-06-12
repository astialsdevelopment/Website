@extends('layouts.admin_app')
@section('content')
<?php $id=1;?>
<div class="row">
<div class="col-lg-6">
<h1>Add Two Wheeler</h1>
@if (session()->has('done2'))
<div class="alert alert-success">
    {!! session()->get('done2') !!}
</div>
@endif
@if (session()->has('error2'))
<div class="alert alert-danger">
    {!! session()->get('error2') !!}
</div>
@endif
<form action="{{ route('add_bike') }}" method="POST">
    @csrf
    <div class="form-group">
        <input class="form-control" type="text" name="bike_name" placeholder="Bike name" required>
    </div>
    <button type="submit" class="btn btn-primary btn-lg">
        Add
    </button>
</form>
</div>

<div class="col-lg-6">
    <h1>Two Wheeler</h1>
<table class="table table-responsive table-striped table-hover">
    <tr>
        <th>#</th>
        <th>Bike Name</th>
        <th>Actions</th>
    </tr>
    @foreach (\App\Models\Bikes::all() as $bike)
    <tr>
        <td>{{ $id }}</td>
        <td>{{ $bike->bike_name }}</td>
        <td>
            <form action="{{ route('delete_bike') }}" method="POST">
                @csrf
                <input name="id" type="hidden" value="{{ $bike->id }}">
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