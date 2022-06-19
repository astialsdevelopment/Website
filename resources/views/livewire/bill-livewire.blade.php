<div>
    <a class="btn btn-success btn-lg" href="{{ route('invoice',['id'=>$id2]) }}">Print</a>
    <br>
    <br>
    @if (session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
    <br>
    @endif
    @if (session()->has('done'))
    <div id="done" class="alert alert-success">
        {{ session()->get('done') }}
    </div>
    <br>
    @endif
    @if ($customer->status == 1)
    <h1 style="color:green">Payment Completed</h1>
    <br>

    @else
    <input class="form-control" type="number" id="bill_fill" placeholder="{{ $customer->bill }}">
    <input class="form-control" type="date" id="bill_date" placeholder="Date">
    <button class="btn btn-primary btn-lg" type="button"
        wire:click="bill_status($('#bill_fill').val(),$('#bill_date').val())">Modify</button>
    @endif
    <table style="overflow-x: scroll" id="hero" class="table table-responsive table-striped table-hover">
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
        <h3>Collect Ammount: <span style="color: green">{{ (int)$j1 + (int)$q1 }}</span></h3>
        <h3>Received Ammount: <span style="color: green">{{ (int)$j3+ (int)$q3 }}</span></h3>
        <h3>Total Bill: <span style="color: green">{{ (int)$j4+ (int)$q4 }}</span></h3>
        <h3>Total Quantity: <span style="color: green">{{ (double)$j2 + (double)$q2 }}</span></h3>
        <h3>Total Orders: <span style="color: green">{{ count($orders) }}</span></h3>
    </div>
</div>
{{-- <script>
    document.getElementById(' hero').style.width=screen.width; 
</script> --}}