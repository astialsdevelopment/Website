@extends('layouts.admin_app')
@section('content')
@if (session()->has('done'))
<div class="alert alert-success">
    {!! session()->get('done') !!}
</div>
@endif
<a class="btn btn-primary btn-lg" href="{{ route('add_orders') }}">Add Orders</a>
<br>
<h1>Orders</h1>
@livewire('order-quantity-livewire')
@livewireScripts
@endsection