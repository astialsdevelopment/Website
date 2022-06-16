@extends('layouts.admin_app')
@section('content')
<style>
    .box {
        padding: 20px 20px 20px 20px;
        border-radius: 0.90rem;
        border: 2px solid #cbfdb5;
        /* box-shadow: rgb(0, 0, 0, 0.1) 2px 2px 5px 5px */
    }

    .box2 {
        padding: 20px 20px 20px 20px;
        border-radius: 0.90rem;
        border: 2px solid #fbbebe;
        /* box-shadow: rgb(0, 0, 0, 0.1) 2px 2px 5px 5px */
    }

    .box3 {
        padding: 20px 20px 20px 20px;
        border-radius: 0.90rem;
        background: rgb(30, 144, 255, 0.2);
        border: 2px solid rgb(30, 144, 255, 0.4);
        /* box-shadow: rgb(0, 0, 0, 0.1) 2px 2px 5px 5px */
    }

    .box4 {
        padding: 20px 20px 20px 20px;
        border-radius: 0.90rem;
        background: rgba(0, 0, 0, 0.1);
        border: 2px solid rgb(0, 0, 0);
        /* box-shadow: rgb(0, 0, 0, 0.1) 2px 2px 5px 5px */
    }
</style>
<?php
$e1=[];
$o1=[];
$e3=[];
$o3=[];
        foreach (\App\Models\Order::join('bills', 'bills.invoice', '=', 'orders.id')
            ->select('orders.*','bills.bill as bill')
            ->get() as $p) {
            if ($p->id % 2 == 0) {
                array_push($e1, $p->bill);
            } else {
                array_push($o1, $p->bill);
            }
        }

        foreach (\App\Models\Order::join('bills', 'bills.invoice', '=', 'orders.id')
        ->select('orders.*','bills.bill as bill')
        ->get() as $p) {
        if ($p->id % 2 == 0) {
        if($p->total_price >= $p->bill && $p->bill != 0){
        $swq = $p->total_price - $p->bill;
        }else{
        $swq = $p->total_price;
        }
        array_push($e3, $swq);
        } else {
        if($p->total_price >= $p->bill && $p->bill != 0){
        $swq2 = $p->total_price - $p->bill;
        }else{
        $swq2 = $p->total_price;
        }
        array_push($o3, $swq2);
        }
        }

        $e1 = array_sum($e1);
        $o1 = array_sum($o1);
        $j3 = array_sum($e3);
        $q3 = array_sum($o3);
?>

<h1 class="text-center">Dashboard</h1>
<div class="row">
    <div class="col-lg-6 col-sm-6 col-md-6">
        <br>
        <div onclick="change_location('{{ route('bill') }}')" class="bg-success box">
            <div class="row">
                <div class="col-lg-6">
                    <h1>₹ <span>{{ (int)$j3 + (int)$q3 }}</span></h1>
                    <h2><span style="color: green">To Collect </span> <i class="fa fa-arrow-down"
                            style="color: green;float: right;"></i>
                    </h2>
                </div>
                <div class="col-lg-6">
                    <h3 style="float:right"><i class="fa fa-arrow-right"
                            style="color:green;font-size: 40px;float:right"></i></h3>
                </div>
            </div>
        </div>
        <br>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6">
        <br>
        <div onclick="change_location('{{ route('bill') }}')" class="bg-danger box2">
            <div class="row">
                <div class="col-lg-6">
                    <h1>₹ <span>{{ (int)$e1 + (int)$o1 }}</span></h1>
                    <h2><span style="color: red">Received </span> <i class="fa fa-arrow-down"
                            style="color: red;float: right;"></i>
                    </h2>
                </div>
                <div class="col-lg-6">
                    <h3 style="float:right"><i class="fa fa-arrow-right"
                            style="color:red;font-size: 40px;float:right"></i></h3>
                </div>
            </div>
        </div>
        <br>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6">
        <br>
        <div onclick="change_location('{{ route('add_customer') }}')" class="box3">
            <div class="row">
                <div class="col-lg-6">
                    <h1><span>{{ count(\App\Models\Customer::all()) }}</span></h1>
                    <h2><span style="color: dodgerblue">Customers </span> <i class="fa fa-arrow-down"
                            style="color: dodgerblue;float: right;"></i>
                    </h2>
                </div>
                <div class="col-lg-6">
                    <h3 style="float:right"><i class="fa fa-arrow-right"
                            style="color:dodgerblue;font-size: 40px;float:right"></i></h3>
                </div>
            </div>
        </div>
        <br>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6">
        <br>
        <div class="box4">
            <div class="row">
                <div class="col-lg-6">
                    <h1><span>{{
                            count(\App\Models\Order::where('bills.status','=',false)->join('bills','bills.invoice','=','orders.id')->select('bills.*')->get())
                            }}</span></h1>
                    <h2><span style="color: black">Total Orders </span> <i class="fa fa-arrow-down"
                            style="color: black;float: right;"></i>
                    </h2>
                </div>
                <div class="col-lg-6">
                    <h3 style="float:right"><i class="fa fa-arrow-right"
                            style="color:black;font-size: 40px;float:right"></i></h3>
                </div>
            </div>
        </div>
        <br>
    </div>
</div>
@endsection