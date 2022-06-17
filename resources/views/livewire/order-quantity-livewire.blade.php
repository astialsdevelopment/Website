<div>
    <div style="border:5px solid black;border-radius:0.50rem;padding:20px">
        @foreach ($customer as $customers)
        @if (count(\App\Models\Order::where(['bills.status'=> false,'order_name'=>$customers->name])->join(
        'bills',
        'bills.customer',
        '=',
        'orders.order_name'
        )
        ->select('orders.*')
        ->get()) == 0)

        @else
        <?php
    $e6 = [];
    $o6 = [];
    $e7 = [];
    $o7 = [];
    foreach (\App\Models\Order::where(['bills.status'=> false,'order_name'=>$customers->name])->join(
            'bills',
            'bills.customer',
            '=',
            'orders.order_name'
            )
            ->select('orders.*')
            ->get() as $p) {
            if ($p->id % 2 == 0) {
                array_push($e6, $p->total_price);
            } else {
                array_push($o6, $p->total_price);
            }
        }
        foreach (\App\Models\UserOrder::where('orders.order_name','=',$customers->name)
        ->join('orders','orders.id','=','user_orders.order_id')->select('user_orders.*')->get() as $q) {
            if ($q->id % 2 == 0) {
                array_push($e7, $q->order_countity);
            } else {
                array_push($o7, $q->order_countity);
            }
        }
        $e6 = array_sum($e6);
        $o6 = array_sum($o6);
        $e7 = array_sum($e7);
        $o7 = array_sum($o7);
    ?>
        <h1>{{$customers->name}}</h1>

        <table class="table table-responsive table-striped table-hover">
            <tr>
                <th>
                    #
                </th>
                <th>
                    Bike Name
                </th>
                @foreach (\App\Models\Order_no::all() as $order_no)
                <th>
                    {{ $order_no->order_no }}
                </th>
                @endforeach
                <th>
                    Actions
                </th>
                <th>
                    STD
                </th>
                <th>
                    Each Price
                </th>
                <th>
                    Total Price
                </th>
                <th>
                    Total Quantity
                </th>
            </tr>
            <?php $id3 =1;?>
            @foreach (\App\Models\Order::where(['bills.status'=> false,'order_name'=>$customers->name])->join(
            'bills',
            'bills.customer',
            '=',
            'orders.order_name'
            )
            ->select('orders.*')
            ->get() as $order)
            <?php
    ${"quantity$order->id"} = [];
    ?>
            <tr>
                <td>{{ $id3 }}</td>
                <td>{{ $order->bike_name }}</td>

                @foreach (\App\Models\UserOrder::where('user_orders.order_id','=',$order->id)
                ->select('user_orders.*')
                ->get() as $userorder)
                <td>
                    <span style="color:green">{{ $userorder->order_countity }}</span>
                    .pcs
                </td>
                <?php
        if ($userorder->id % 2 == 0) {
        array_push(${"quantity$order->id"}, $userorder->order_countity);
        } else {
        array_push(${"quantity$order->id"}, $userorder->order_countity);
        }
        ?>
                @endforeach

                <td>
                    <form action="{{ route('delete_orders') }}" method="POST">
                        @csrf
                        <input name="id" type="hidden" value="{{ $order->id }}">
                        <button class="btn btn-danger" type="submit">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                </td>
                <td>
                    <span style="color:green">{{ $order->std }}</span>
                </td>
                <td>
                    <h4>₹ <span style="color:green">{{ $order->price }}</span></h4>
                </td>
                <td>
                    <h4>₹ <span style="color:green">{{ $order->total_price }}</span></h4>
                </td>
                <td>
                    <?php
                    ${"quantity$order->id"} = array_sum(${"quantity$order->id"});
                    ?>
                    <h4>
                        <span style="color:green">
                            <?php
            echo ${"quantity$order->id"};
            ?>
                        </span>
                        .pcs
                    </h4>
                </td>
            </tr>
            <?php $id3++;?>
            @endforeach
        </table>
        <div class="bg-secondary p-4 text-right">
            <h3>Total Price: <span style="color: green">{{ (int)$e6 + (int)$o6 }}</span></h3>
            <h3>Total Quantity: <span style="color: green">{{ (int)$e7 + (int)$o7 }}</span></h3>
            <h3>Total Orders: <span style="color: green">{{
                    count(\App\Models\Order::where(['bills.status'=> false,'order_name'=>$customers->name])->join(
                    'bills',
                    'bills.customer',
                    '=',
                    'orders.order_name'
                    )
                    ->select('orders.*')
                    ->get()) }}</span></h3>
        </div>
        <hr>
        @endif
        @endforeach
    </div>
    <div class="bg-secondary p-4 text-right">
        <h3>Total Price: <span style="color: green">{{ (int)$e1 + (int)$o1 }}</span></h3>
        <h3>Total Quantity: <span style="color: green">{{ (int)$e2 + (int)$o2 }}</span></h3>
        <h3>Total Orders: <span style="color: green">{{
                count(\App\Models\Order::where('bills.status','=',false)->join('bills', 'bills.customer', '=',
                'orders.order_name')
                ->select('orders.*', 'bills.*')
                ->get()) }}</span></h3>
    </div>

</div>