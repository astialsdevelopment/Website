<div>
    <a class="btn btn-success btn-lg" href="{{ route('invoice',['id'=>$id2]) }}">Print</a>
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
            <th>
                Collect Bill
            </th>
            <th>
                Receive Bill
            </th>
            <th>
                Paid
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
            <td>
                <h4>₹ <span style="color:green">{{ $order->bill }}</span></h4>
            </td>
            <td>
                <h4>₹ <span style="color:green">
                <?php
                if($order->total_price >= $order->bill && $order->bill != 0){
                echo $order->total_price - $order->bill;
                }else{
                    echo $order->total_price;
                }    
                ?>
                </span></h4>
            </td>
            <td>             
                {{-- <input id="bill_fill" style="display: none" type="number"wire wire:model="bill_fill"> --}}
                @if ($order->status == true)
                    <h4 class="text-success">Payment Completed</h4>
                @else
                <input id="bill_fill{{ $order->id }}" class="form-control" type="number" min="0.0" placeholder="{{ $order->bill }}" value="">
                <button class="btn btn-primary" type="button" wire:click="bill_status({{ \App\Models\Bill::where("invoice","=",$order->id)->first()->status }},$('#bill_fill{{ $order->id }}').val(),{{ \App\Models\Bill::where("invoice","=",$order->id)->first()->id }})">
                        Press
                </button>
                @endif                
                
                
                {{-- <label class="switch">
                    <input type="checkbox" id="set_status" onclick="st()" @if (\App\Models\Bill::where('invoice','=',$order->id)->first()->status == true)
                            checked
                        @endif
                        wire:click="bill_status({{ \App\Models\Bill::where("invoice","=",$order->id)->first()->status }},
                        {{ \App\Models\Bill::where("invoice","=",$order->id)->first()->id }})">
                        <span class="slider round"></span>
                    </label>
                </form> --}}
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
    document.getElementById('hero').style.width = screen.width;
</script> --}}