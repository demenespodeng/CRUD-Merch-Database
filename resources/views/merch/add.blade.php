@extends('merch.layout')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card mt-4">
        <div class="card-body">

            <h5 class="card-title fw-bolder mb-3">Tambah Merch</h5>

            <form method="post" action="{{ route('merch.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="id_merch" class="form-label">ID merch</label>
                    <input type="text" class="form-control" id="id_merch" name="id_merch">
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Merch</label>
                    <input type="text" class="form-control" id="nama_merch" name="nama_merch">
                </div>
                <div class="mb-3">
                    <label for="asal" class="form-label">Keyword</label>
                    <input type="text" class="form-control" id="keyword" name="keyword">
                </div>
                <div class="mb-3">
                    <label for="asal" class="form-label">Harga Merch</label>
                    <input type="text" class="form-control" id="harga_merch" name="harga_merch">
                </div>
                <div class="text-center">
                    <input type="submit" class="btn btn-primary" value="Tambah" />
                </div>
            </form>
        </div>
    </div>

@stop