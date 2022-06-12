@extends('layouts.admin_app')
@section('content')

@if (session()->has('done'))
<div class="alert alert-success">
    {!! session()->get('done') !!}
</div>
@endif
@if (session()->has('error'))
<div class="alert alert-danger">
    {!! session()->get('error') !!}
</div>
@endif
<form action="{{ route('add_orders') }}" method="POST">
    @csrf
    <div class="row">
        <div class="form-group col-lg-6">
            <h1>Two Wheeler</h1>
            <input class="form-control" type="name" list="brow" name="bike_name" placeholder="Select Bike Name"
                autocomplete="off">
            <datalist id="brow">
                {{-- <option value="">Select...</option> --}}
                @foreach (\App\Models\Bikes::all() as $bike)
                <option value="{{ $bike->bike_name }}">{{ $bike->bike_name }}</option>
                @endforeach
            </datalist>
        </div>
        <div class="form-group col-lg-6">
            <h1>Customer Name</h1>
            <input class="form-control" type="name" list="brow2" name="order_name" placeholder="Select Customer"
                autocomplete="off">

            <datalist id="brow2">
                {{-- <option value="">Select...</option> --}}
                @foreach (\App\Models\Customer::all() as $bike)
                <option value="{{ $bike->name }}">{{ $bike->name }}</option>
                @endforeach
            </datalist>
        </div>
        <div class="form-group col-lg-2">
            <h1>Standart</h1>
            <input class="form-control" id="std" type="text" name="std" placeholder="Standard" required>

        </div>
        @foreach (\App\Models\Order_no::all() as $order)
        <div class="col-lg-1">
            <h1>{{ $order->order_no }}</h1>
            <input id="order_no" type="hidden" name="{{" order_no". $order->id }}" value="{{ $order->order_no }}">
            <input class="form-control" id="order_quantity" type="number" name="{{" order_quantity". $order->id }}"
            value="">
        </div>

        <script>

        </script>
        @endforeach
        <div class="form-group col-lg-12">
            <h1>Price</h1>
            <input class="form-control" id="price" type="number" onchange="$('#total_price').val($('#price').val())"
                name="price" placeholder="Price" required>
            <input class="form-control" id="total_price" type="hidden" name="total_price" required>
        </div>
    </div>
    <button type="submit" class="btn btn-success btn-lg">
        Add
    </button>
</form>

<script>
    var oo = [];
    var oq = [];

</script>
@endsection