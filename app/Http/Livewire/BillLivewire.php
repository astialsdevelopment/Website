<?php

namespace App\Http\Livewire;

use App\Models\Bill;
use App\Models\Customer;
use App\Models\Order;
use App\Models\PaymentDate;
use App\Models\UserOrder;
use Livewire\Component;

class BillLivewire extends Component
{
    public $e1 = [];
    public $o1 = [];
    public $e2 = [];
    public $o2 = [];
    public $e3 = [];
    public $o3 = [];
    public $e4 = [];
    public $o4 = [];
    public $id2;
    public $bill_fill = [];
    public $status;
    public function mount()
    {
        $this->render();
    }
    public function render()
    {
        $this->e1 = [];
        $this->o1 = [];
        $this->e2 = [];
        $this->o2 = [];
        $this->e3 = [];
        $this->o3 = [];
        $this->e4 = [];
        $this->o4 = [];
        $name = Customer::where('id', '=', $this->id2)->first()->name;
        $orders = Order::where([
            'orders.order_name' => $name,
        ])
            ->join('bills', 'bills.customer', '=', 'orders.order_name')
            ->select('orders.*', 'bills.bill')
            ->get();

        foreach (Customer::where([
            'customers.name' => $name,
        ])
            ->join('bills', 'bills.customer', '=', 'customers.name')
            ->select('bills.bill as bill')
            ->get() as $p) {
            if ($p->id % 2 == 0) {
                array_push($this->e1, $p->bill);
            } else {
                array_push($this->o1, $p->bill);
            }
        }

        foreach (Customer::where([
            'customers.name' => $name,
        ])
            ->join('bills', 'bills.customer', '=', 'customers.name')
            ->select('bills.bill as bill', 'customers.total_bill')
            ->get() as $p) {

            if ($p->total_bill >= $p->bill && $p->bill != 0) {
                $swq = $p->total_bill - $p->bill;
            } else {
                $swq = $p->total_bill;
            }
            array_push($this->e3, $swq);
        }

        foreach (Order::where([
            'orders.order_name' => $name,
        ])
            ->join('bills', 'bills.customer', '=', 'orders.order_name')
            ->select('orders.*', 'bills.bill as bill')
            ->get() as $p) {
            if ($p->id % 2 == 0) {
                array_push($this->e4, $p->total_price);
            } else {
                array_push($this->o4, $p->total_price);
            }
        }
        foreach (UserOrder::where('orders.order_name', '=', $name)
            ->join('orders', 'orders.id', '=', 'user_orders.order_id')
            ->select('user_orders.*')
            ->get() as $q) {
            if ($q->id % 2 == 0) {
                array_push($this->e2, $q->order_countity);
            } else {
                array_push($this->o2, $q->order_countity);
            }
        }
        $this->j1 = array_sum($this->e1);
        $this->q1 = array_sum($this->o1);
        $this->j2 = array_sum($this->e2);
        $this->q2 = array_sum($this->o2);
        $this->j3 = array_sum($this->e3);
        $this->q3 = array_sum($this->o3);
        $this->j4 = array_sum($this->e4);
        $this->q4 = array_sum($this->o4);
        return view('livewire.bill-livewire')->with([
            'orders' => $orders,
            'customer_name' => $name,
            'customer' => Customer::where('customers.id', '=', $this->id2)->join('bills', 'bills.customer', '=', 'customers.name')->select('customers.*', 'bills.*')->first(),
        ]);
    }
    public function bill_status($bill_fill, $bill_date)
    {
        // dd
        $name = Customer::where('id', '=', $this->id2)->first()->name;

        $date = $bill_date;


        $d = Bill::where('customer', '=', $name)->first();

        if ($d->bill >= $bill_fill) {

            Bill::where('customer', '=', $name)->update([
                'bill' => $d->bill - $bill_fill,
            ]);
            if ($bill_date != null) {
                PaymentDate::create([
                    'payment_date' => $date,
                    'payment' => $bill_fill,
                    'invoice' => 0,
                    'customer' => $name,
                ]);
            } else if ($bill_date == null) {
                PaymentDate::create([
                    'payment_date' => date('Y-m-d'),
                    'payment' => $bill_fill,
                    'invoice' => 0,
                    'customer' => $name
                ]);
            }
            if ($d->bill == $bill_fill) {
                Bill::where('customer', '=', $name)->update([
                    'status' => true,
                ]);
            }
            session()->flash('done', 'Successfully Updated');
        } else {
            session()->flash('error', 'This is not the correct bill');
        }

        $this->render();
    }
}
