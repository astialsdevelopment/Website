<div>
    @if (session()->has('done2'))
    <div class="alert alert-success">
        {!! session()->get('done2') !!}
    </div>
    @endif
    <?php $id=1;?>
    <input class="form-control" type="name" wire:model="search" wire:keypress="search2" placeholder="Search....">
    <table class="table table-responsive table-striped table-hover">
        <tr>
            <th>#</th>
            <th>Bike Name</th>
            <th>Actions</th>
        </tr>
        @foreach ($bikes as $bike)
        <tr>
            <td>{{ $id }}</td>
            <td>{{ $bike->bike_name }}</td>
            <td>
                <button class="btn btn-danger" wire:click="delete({{ $bike->id }})" type="submit">
                    <i class="fa fa-trash"></i>
                </button>
            </td>
        </tr>
        <?php $id++;?>
        @endforeach
    </table>
</div>