<div>
    <table class="table table-responsive table-striped table-hover">
        <tr>
            <th>
                #
            </th>
            <th>
                Bike Name
            </th>
            <th>
                Customer
            </th>
            <th>
                Each Price
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
                Total Price
            </th>
            <th>
                Total Quantity
            </th>
        </tr>
        <?php $id3 =1;?>
        @foreach ($orders as $order)
        <?php
    ${"quantity$order->id"} = [];
    ?>
        <tr>
            <td>{{ $id3 }}</td>
            <td>{{ $order->bike_name }}</td>
            <td>{{ $order->order_name }}</td>
            <td>{{ $order->price }}</td>
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
        <h3>Total Price: <span style="color: green">{{ (int)$e1 + (int)$o1 }}</span></h3>
        <h3>Total Quantity: <span style="color: green">{{ (int)$e2 + (int)$o2 }}</span></h3>
        <h3>Total Orders: <span style="color: green">{{ count($orders) }}</span></h3>
    </div>
</div>