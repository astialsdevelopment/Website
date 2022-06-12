<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Customer;
use App\Models\Order;
use App\Models\UserOrder;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function bill_details($id, $status)
    {
        return view('admin.bill_details', [
            'id' => $id,
            'status' => $status,
        ]);
    }
}
