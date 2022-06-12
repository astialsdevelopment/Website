@extends('layouts.admin_app')
@section('content')
@if (session()->has('done'))
<div class="alert alert-success">
    {!! session()->get('done') !!}
</div>
@endif

<h1>Payment</h1>
@livewire('payment-date-livewire',['id2'=>$id])
@livewireScripts()


@endsection