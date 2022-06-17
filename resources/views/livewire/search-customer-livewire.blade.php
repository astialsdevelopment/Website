<div>
    @if (session()->has('done2'))
    <div class="alert alert-success">
        {!! session()->get('done2') !!}
    </div>
    @endif
    <?php $id=1;?>
    <input class="form-control" type="text" wire:model="search" wire:keypress="search2" placeholder="Search.....">
    <table class="table table-responsive table-striped table-hover">
        <tr>
            <th>#</th>
            <th>Customer Name</th>
            <th>Customer Mobile No.</th>
            <th>Customer Address</th>
            <th>Actions</th>
        </tr>
        @foreach ($customer as $customer)
        <tr>
            <td>{{ $id }}</td>
            <td>{{ $customer->name }}</td>
            <td>{{ $customer->mobile }}</td>
            <td>{{ $customer->address }}</td>

            <td>
                <button class="btn btn-danger" wire:click="delete({{ $customer->id }})" type="button">
                    <i class="fa fa-trash"></i>
                </button>
            </td>
            <td>
                <a class="btn btn-success" href="{{ route('bill_details',['id'=>$customer->id,'status'=>0]) }}">
                    <i class="fa fa-eye"></i>
                </a>
            </td>
        </tr>
        <?php $id++;?>
        @endforeach
    </table>
</div>