<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\UserOrder;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function invoice($id)
    {
        $e1 = [];
        $o1 = [];
        $e2 = [];
        $o2 = [];
        $e3 = [];
        $o3 = [];
        $e4 = [];
        $o4 = [];
        $name = Customer::where('id', '=', $id)->first()->name;
        $orders = Order::where([
            'orders.order_name' => $name,
        ])
            ->join('bills', 'bills.invoice', '=', 'orders.id')
            ->select('orders.*','bills.*')
            ->get();
        foreach (Order::where([
            'orders.order_name' => $name,
            'bills.status' => false,
        ])
            ->join('bills', 'bills.invoice', '=', 'orders.id')
            ->select('orders.*','bills.bill as bill')
            ->get() as $p) {
            if ($p->id % 2 == 0) {
                array_push($e1, $p->bill);
            } else {
                array_push($o1, $p->bill);
            }
        }

        foreach (Order::where([
            'orders.order_name' => $name,
        ])
            ->join('bills', 'bills.invoice', '=', 'orders.id')
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

        foreach (Order::where([
            'orders.order_name' => $name,
        ])
            ->join('bills', 'bills.invoice', '=', 'orders.id')
            ->select('orders.*','bills.bill as bill')
            ->get() as $p) {
            if ($p->id % 2 == 0) {
                array_push($e4, $p->total_price);
            } else {
                array_push($o4, $p->total_price);
            }
        }
        foreach (UserOrder::where('orders.order_name', '=', $name)
            ->join('orders', 'orders.id', '=', 'user_orders.order_id')
            ->select('user_orders.*')
            ->get() as $q) {
            if ($q->id % 2 == 0) {
                array_push($e2, $q->order_countity);
            } else {
                array_push($o2, $q->order_countity);
            }
        }
        $j1 = array_sum($e1);
        $q1 = array_sum($o1);
        $j2 = array_sum($e2);
        $q2 = array_sum($o2);
        $j3 = array_sum($e3);
        $q3 = array_sum($o3);
        $j4 = array_sum($e4);
        $q4 = array_sum($o4);
    $data = Customer::where('id', '=', $id)->first();
    return view('invoice')->with([
        'data'=>$data,
        'j1'=>$j1,
        'q1'=>$q1,
        'j2'=>$j2,
        'q2'=>$q2,
        'j3'=>$j3,
        'q3'=>$q3,
        'j4'=>$j4,
        'q4'=>$q4,
        'orders' => $orders,
    ]);
    }

    public function payment_date($id)
    {
        return view('admin.payment_date')->with([
            'id'=>$id
        ]);
    }
}
