<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\UserOrder;
use App\Models\Customer;
use App\Models\Bill;
use Livewire\Component;

class OrderQuantityLivewire extends Component
{
    public $e1 = [];
    public $o1 = [];
    public $e2 = [];
    public $o2 = [];
    public function render()
    {
        if (count(Bill::where('status', '=', false)->get()) != 0) {
            foreach (Order::all() as $p) {
                if ($p->id % 2 == 0) {
                    array_push($this->e1, $p->total_price);
                } else {
                    array_push($this->o1, $p->total_price);
                }
            }
            foreach (UserOrder::where('bills.status', '=', false)
                ->join('orders', 'orders.id', '=', 'user_orders.order_id')
                ->join('bills', 'bills.customer', '=', 'orders.order_name')
                ->select('user_orders.*')
                ->get()
                as $q) {
                if ($q->id % 2 == 0) {
                    array_push($this->e2, $q->order_countity);
                } else {
                    array_push($this->o2, $q->order_countity);
                }
            }
        }
        $this->e1 = array_sum($this->e1);
        $this->o1 = array_sum($this->o1);
        $this->e2 = array_sum($this->e2);
        $this->o2 = array_sum($this->o2);
        return view('livewire.order-quantity-livewire')->with([
            'customer' => Customer::all(),
            'orders' => Order::where('bills.status', '=', false)->join(
                'bills',
                'bills.customer',
                '=',
                'orders.order_name'
            )
                ->select('orders.*')
                ->get(),
        ]);
    }
}
