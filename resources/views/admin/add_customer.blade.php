@extends('layouts.admin_app')
@section('content')
<?php $id=1;?>
<div class="row">
    <div class="col-lg-6">
        @if (session()->has('done3'))
        <div class="alert alert-success">
            {!! session()->get('done3') !!}
        </div>
        @endif
        @if (session()->has('error3'))
        <div class="alert alert-danger">
            {!! session()->get('error3') !!}
        </div>
        @endif
        @if (session()->has('error4'))
        <div class="alert alert-danger">
            {!! session()->get('error4') !!}
        </div>
        @endif
        @if (session()->has('error5'))
        <div class="alert alert-danger">
            {!! session()->get('error5') !!}
        </div>
        @endif
        <h1>Add Customer</h1>
        <form action="{{ route('add_customer') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <input class="form-control" type="name" name="name" placeholder="Customer Name"
                            value="{{ old('name') }}" required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <input class="form-control" type="number" name="mobile" placeholder="Customer Mobile No."
                            maxlength="10" value="{{ old('mobile') }}" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <textarea class="form-control" name="address"
                    placeholder="Customer Address">{{ old('address') }}</textarea>
            </div>
            <button type="submit" class="btn btn-light btn-lg">
                Add
            </button>
        </form>

    </div>
    <div class="col-lg-6">
        <h1>Customers</h1>
        @livewire('search-customer-livewire')
        @livewireScripts()
    </div>
</div>

@endsection