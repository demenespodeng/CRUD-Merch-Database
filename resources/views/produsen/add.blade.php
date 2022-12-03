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

            <h5 class="card-title fw-bolder mb-3">Tambah Produsen</h5>

            <form method="post" action="{{ route('produsen.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="id_produsen" class="form-label">ID Produsen</label>
                    <input type="text" class="form-control" id="id_produsen" name="id_produsen">
                </div>
                <div class="mb-3">
                    <label for="nama_produsen" class="form-label">Nama Produsen</label>
                    <input type="text" class="form-control" id="nama_produsen" name="nama_produsen">
                </div>
                <div class="mb-3">
                    <label for="domisili" class="form-label">Domisili</label>
                    <input type="text" class="form-control" id="domisili" name="domisili">
                </div>
                <div class="mb-3">
                    <label for="id_merch" class="form-label">ID merch</label>
                    <input type="text" class="form-control" id="id_merch" name="id_merch">
                </div>
                <div class="text-center">
                    <input type="submit" class="btn btn-primary" value="Tambah" />
                </div>
            </form>
        </div>
    </div>

@stop