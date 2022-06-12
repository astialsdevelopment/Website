@extends('layouts.admin_app')
@section('content')
@if (session()->has('done'))
<div class="alert alert-success">
    {!! session()->get('done') !!}
</div>
@endif

<h1>Bill</h1>
@livewire('bill-livewire',['id2'=>$id,'status'=>$status])
@livewireScripts()


@endsection