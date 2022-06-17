@extends('layouts.admin_app')
@section('content')
@if (session()->has('done'))
<div class="alert alert-success">
    {!! session()->get('done') !!}
</div>
@endif

<h1>Bill</h1>
<?php
$id =1;
?>
<table class="table table-responsive table-striped table-hover">
    <tr>
        <th>#</th>
        <th>Customer</th>
        <th>Collected Bill</th>
        <th>Received Bill</th>
        <th>Loss/Profit</th>
        <th>Customer Total Bill</th>
        <th>View All Orders</th>
        <th>Payment Date</th>
    </tr>
    @foreach (\App\Models\Customer::get() as $bill)
    <tr>
        <td>{{ $id }}</td>
        <td>{{ $bill->name }}</td>
        <td>
            <?php $e1 =[];$o1 =[];?>
            @foreach (\App\Models\Bill::where([
            'customer'=>$bill->name,
            ])->get() as $s)
            <?php
            if($s->id % 2 == 0){
                array_push($e1,$s->bill);
            }else{
                array_push($o1,$s->bill);
            }
            ?>
            @endforeach
            {{ $j1 = array_sum($e1) + array_sum($o1) }}
        </td>
        <td>
            <?php $e2 =[];$o2 =[];?>
            @foreach (\App\Models\Bill::where([
            'bills.customer'=>$bill->name,
            ])
            ->join('customers','customers.name','=','bills.customer')
            ->select('bills.*','customers.*')
            ->get() as $p)
            <?php
            if($s->id % 2 == 0){
                if($p->total_bill >= $p->bill && $p->bill != 0){
                $swq = $p->total_bill - $p->bill;
                }else{
                    $swq = $p->total_bill;
                }
                array_push($e2,$swq);
            }else{
                if($p->total_bill >= $p->bill && $p->bill != 0){
                $swq = $p->total_bill - $p->bill;
                }else{
                    $swq = $p->total_bill;
                }
                array_push($o2,$swq);
            }
            ?>
            @endforeach
            {{ $j2 = array_sum($e2) + array_sum($o2) }}
        </td>
        <td>
            @if ($j1 >= $j2 || $j1 != 0) <span style="color:red">Loss</span>
            @elseif($j1 <= $j2&& $j1==0) <span style="color:green">Profit</span>
                @endif
        </td>
        <td>{{ $j1 + $j2 }}</td>
        <td><a href="{{ route('bill_details',['id'=>$bill->id,'status'=>0]) }}"><i class="fa fa-eye"
                    style="color: dodgerblue"></i></a></td>
        <td><a href="{{ route('payment_date',['id'=>$bill->id,'status'=>0]) }}"><i class="fa fa-eye"
                    style="color: dodgerblue"></i></a></td>
    </tr>
    <?php $id++ ?>
    @endforeach

</table>

@endsection