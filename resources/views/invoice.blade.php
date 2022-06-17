<?php

function AmountInWords(float $amount)
{
   $amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;
   // Check if there is any number after decimal
   $amt_hundred = null;
   $count_length = strlen($num);
   $x = 0;
   $string = array();
   $change_words = array(0 => '', 1 => 'One', 2 => 'Two',
     3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
     7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
     10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
     13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
     16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
     19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
     40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
     70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
    $here_digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
    while( $x < $count_length ) {
      $get_divider = ($x == 2) ? 10 : 100;
      $amount = floor($num % $get_divider);
      $num = floor($num / $get_divider);
      $x += $get_divider == 10 ? 1 : 2;
      if ($amount) {
       $add_plural = (($counter = count($string)) && $amount > 9) ? 's' : null;
       $amt_hundred = ($counter == 1 && $string[0]) ? ' and ' : null;
       $string [] = ($amount < 21) ? $change_words[$amount].' '. $here_digits[$counter]. $add_plural.' 
       '.$amt_hundred:$change_words[floor($amount / 10) * 10].' '.$change_words[$amount % 10]. ' 
       '.$here_digits[$counter].$add_plural.' '.$amt_hundred;
        }
   else $string[] = null;
   }
   $implode_to_Rupees = implode('', array_reverse($string));
   $get_paise = ($amount_after_decimal > 0) ? "And " . ($change_words[$amount_after_decimal / 10] . " 
   " . $change_words[$amount_after_decimal % 10]) . ' Paise' : '';
   return ($implode_to_Rupees ? $implode_to_Rupees . 'Rupees ' : '') . $get_paise;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <style>
        body {
            padding: 2px
        }

        #sew {
            margin-top: -8%;
            margin-left: 11%
        }

        #sew p {
            line-height: 4px;
            font-weight: bold
        }

        #sew p span {
            font-weight: bolder
        }

        #ssq {
            margin-top: 3%;
            border: hidden;
            border-top: 10px solid black;
            font-weight: bolder
        }

        #ssw {
            margin-top: -1%;
            border-top: 10px solid black;
            font-weight: bolder
        }

        #sss p {
            line-height: 8px
        }

        #ssaw {
            /* width: 50%; */
        }

        #ssaw2 {
            /* width: 50%; */
            /* float:right; */
            /* align-items: right/ */
            text-align: right
                /* float: rig/ht; */
                /* position: absolute */
        }

        #juyk {
            border-bottom: 1px solid lightgray;
            margin-top: 10px;
            font-size: 13px
        }

        #ssqs {
            margin-top: 2%
        }

        #ssqs p {
            line-height: 8px
        }

        #sqa {
            text-align: right
        }

        #swaw p {
            text-align: right
        }

        #swaw p span {
            color: lightgray;
            border: 2px solid lightgray;
            border-radius: 0.25rem;
            padding: 2px
        }

        @media (max-width: 800px) {
            body {
                padding: 0px
            }

            #ssqs p {
                line-height: 10px
            }

            #sss p {
                line-height: 14px
            }

            #ssqs p {
                line-height: 6px;
                font-size: 11px;
                width: 100%
            }

            #ssqs h5 {
                font-size: 15px
            }

            #sew {
                margin-left: 20%;
                margin-top: -12%
            }
        }
    </style>
    <div class="container">
        <div id="swaw">
            <p><span>ORIGINAL FOR RECIPIENT</span> BILL OF SUPPlY</p>
        </div>
        <div>
            <img height="100" src="/images/logo.jpeg" alt="">
            <div id="sew">
                <h1>Ashish Auto Agency (A3)</h1>
                <p>27/142, Ashok Nagar , Agra, Uttar Pradesh 282002 India, Uttar Pradesh</p>
                <p><span>Mobile: </span> 7037111101</p>
            </div>
        </div>

        <div>
            <table id="ssq" class="table">
                <tr style="background: rgb(0,0,0,0.1)">
                    <td style="text-align: left">Invoice No.</td>
                    <td style="text-align: left">Invoice Date: </td>
                </tr>
                <tr>
                    <td>
                        <div>
                            <h3>BILL TO</h3>
                            <p>{{ $data->name }} <br>
                                {{ $data->address }} <br>
                                Mobile: {{ $data->mobile }}</p>
                        </div>
                    </td>
                    <td>
                        <span style="color: green;font-size:30px">
                            {{\App\Models\Order::where([
                            'order_name' => $name,
                            ])
                            ->latest()
                            ->first()->created_at}}
                        </span>
                    </td>

                </tr>
            </table>
        </div>

        <div>
            <table id="ssw" class="table">
                <tr style="background: rgb(0,0,0,0.1)">
                    <td style="text-align: left">ITEMS</td>
                    @foreach (\App\Models\Order_no::all() as $order_no)
                    <td style="text-align: right">
                        Size :{{ $order_no->order_no }}
                    </td>
                    @endforeach
                    <td style="text-align: right">QTY. </td>
                    <td style="text-align: right">RATE. </td>
                    <td style="text-align: right">AMOUNT. </td>
                </tr>
                <?php $id3 =1;?>
                @foreach ($orders as $order)
                <?php
        ${"quantity$order->id"} = [];
        ?>
                <tr>
                    <td>{{ $order->bike_name }}</td>
                    @foreach (\App\Models\UserOrder::where('user_orders.order_id','=',$order->id)
                    ->select('user_orders.*')
                    ->get() as $userorder)
                    <td style="text-align: right">
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
                    <td style="text-align: right">

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
                    </td>
                    <td style="text-align: right">₹<span style="color: green">{{ $order->price }}</span></td>
                    <td style="text-align: right">
                        <h4>₹ <span style="color:green">{{ $order->total_price }}</span></h4>
                    </td>
                </tr>
                <?php $id3++;?>
                @endforeach
                <tr style="border-bottom: 10px solid black">
                    <td style="text-align: left">
                        <b>SUB TOTAL:</b>
                    </td>
                    <td></td>
                    <td></td>
                    <td style="text-align: right">
                        <b><span style="color: green">{{ (double)$j2 + (double)$q2 }}</span></b> pcs
                    </td>
                    <td></td>
                    <td style="text-align: right">
                        <b>₹ <span style="color: green">{{ (int)$j4+ (int)$q4 }}</span></b>
                    </td>
                </tr>
            </table>
        </div>
        <div id="sss">
            <div class="row">
                <div class="col-8">
                    <h4>BANK DETAILS</h4>
                    <div id="ssaw" class="row">
                        <div class="col-3">

                            <p>Name: </p>
                            <p>IFSC Code: </p>
                            <p>Accountant No: </p>
                            <p>Bank: </p>
                        </div>
                        <div class="col-9">
                            <p>Ashish Gautam </p>
                            <p>punb0003000 </p>
                            <p>000000022323223 </p>
                            <p>Punjab National Bank, Raja Mandi, Agra </p>
                            <p>ss</p>
                        </div>
                    </div>
                </div>

                <div class="col-4">
                    <div id="ssaw2">
                        <div id="juyk" class="row">
                            {{-- <div class="col-8">
                                <b>TAXABLE AMOUNT</b>
                            </div>
                            <div class="col-4">
                                <b>₹ <span style="color: green">{{ (int)$j4+ (int)$q4}}</span></b>
                            </div>
                        </div> --}}
                        <div id="juyk" class="row">
                            <div class="col-6">
                                <b>TOTAL</b>
                            </div>
                            <div class="col-6">
                                <b>₹ <span style="color: green">{{ (int)$j4+ (int)$q4}}</span></b>
                            </div>
                        </div>
                        <div id="juyk" class="row">
                            <div class="col-6">
                                <b>Received Amount</b>
                            </div>
                            <div class="col-6">
                                <b>₹ <span style="color: green">{{ (int)$j3+ (int)$q3 }}</span></b>
                            </div>
                        </div>
                        <div id="juyk" class="row">
                            <div class="col-6">
                                <b>Balance</b>
                            </div>
                            <div class="col-6">
                                <b>₹ <span style="color: green">{{ $j1 + $q1 }}</span></b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="ssqs">
            <div class="row">
                <div class="col-6">
                    <div class="row">
                        <div class="col-6">
                            <h5><b>Payment QR CODE</b></h5>
                            <p>PhonePe/ GooglePay / PayTM</p>
                            <p>UPI ID:</p>
                            <p>ashishgautam25@ybi</p>
                        </div>
                        <div class="col-6">
                            <img src="/images/qr.png" height="100" alt="">
                        </div>
                    </div>
                </div>
                <div id="sqa" class="col-6">
                    <p><b>Invoice Amount [in words]</b></p>
                    <h5><b>

                            {{AmountInWords( $j1 + $q1 )}}

                        </b></h5>
                    <img src="/images/qr.png" height="50" alt="">

                    <p><b>AUTHORISED SIGNATURE FOR</b></p>
                    <p>Ashish Auto Agency (A3)</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>