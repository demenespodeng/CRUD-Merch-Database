@extends('merch.layout')

@section('content')

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach
        </ul>
    </div>
@endif

<div class="card mt-4">
	<div class="card-body">

        <h5 class="card-title fw-bolder mb-3">Ubah Data Warehouse</h5>

		<form method="post" action="{{ route('warehouse.update', $data->id_warehouse) }}">
			@csrf
            <div class="mb-3">
                <label for="id_warehouse" class="form-label">ID Warehouse</label>
                <input type="text" class="form-control" id="id_warehouse" name="id_warehouse" value="{{ $data->id_warehouse }}">
            </div>
			<div class="mb-3">
                <label for="stok_merch" class="form-label">Stok Merch</label>
                <input type="text" class="form-control" id="stok_merch" name="stok_merch" value="{{ $data->stok_merch }}">
            </div>
            <div class="mb-3">
                <label for="id_merch" class="form-label">ID Merch</label>
                <input type="text" class="form-control" id="id_merch" name="id_merch" value="{{ $data->id_merch }}">
            </div>
			<div class="text-center">
				<input type="submit" class="btn btn-primary" value="Ubah" />
			</div>
		</form>
	</div>
</div>

@stop