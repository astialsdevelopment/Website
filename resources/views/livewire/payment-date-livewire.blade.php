<div>
    <table style="overflow-x: scroll" id="hero" class="table table-responsive table-striped table-hover">
        <tr>
            <th>
                #
            </th>
            <th>
                Payment
            </th>
            <th>
                Date
            </th>
        </tr>
        <?php $id=1;?>
        @foreach ($dates as $date)
        <tr>
            <td>{{ $id }}</td>
            <td>
                ₹ <span style="color: green">{{ $date->payment }}</span>
            </td>
            <td>
                <h4><span style="color:green"><b>{!! $date->payment_date !!}</b></span></h4>
            </td>
        </tr>
        <?php $id++;?>
        @endforeach
    </table>
</div>