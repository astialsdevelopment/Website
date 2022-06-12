<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Order;
use App\Models\Order_no;
use App\Models\UserOrder;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function order()
    {
        return view('admin.order');
    }

    public function add_order()
    {
        request()->total_price = request()->price;

            $d = Order::create([
                'order_name' => request()->order_name,
                'bike_name' => request()->bike_name,
                'price' => request()->price,
                'std' => request()->std,
                'total_price' => request()->total_price,
            ]);

            foreach (Order_no::all() as $order_no) {
                UserOrder::create([
                    'order_id' => $d->id,
                    'order_no' => request()->{"order_no$order_no->id"},
                    'order_countity' => request()->{"order_quantity$order_no->id"},
                ]);
            }
            $e1 = [];
            $o1 = [];
            foreach (UserOrder::where('order_id', '=', $d->id)->get() as $p) {
                if ($p->id % 2 == 0) {
                    array_push($e1, $p->order_countity);
                } else {
                    array_push($o1, $p->order_countity);
                }
            }

            $sde = array_sum($e1) + array_sum($o1);
            $f = Bill::create([
                'customer' => request()->order_name,
                'invoice' => $d->id,
                'bill' => $sde * $d->price,
            ]);

            Order::where('id', '=', $d->id)->update([
                'total_price' => $f->bill,
            ]);

            session()->flash('done', 'SuccessFully <b>ADDED</b>');
       
        return redirect()->back()->withInput();
    }
    public function delete_order()
    {
        Order::where('id', '=', request()->id)->delete();
        UserOrder::where('order_id', '=', request()->id)->delete();
        Bill::where('invoice', '=', request()->d)->delete();
        session()->flash('done', 'SuccessFully <b>Deleted</b>');
        return redirect()->back()->withInput();
    }
}
