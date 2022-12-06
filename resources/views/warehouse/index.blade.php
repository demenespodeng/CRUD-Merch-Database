@extends('merch.layout')

@section('content')


<p>Cari Data:</p>
<div class="pb-3">
    <form class="d-flex" action="{{ url('/warehouse') }}" method="get">
        <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search">
        <button class="btn btn-secondary" type="submit">Cari</button>
    </form>
</div>

<a href="{{ route('merch.index') }}" type="button" class="btn btn-primary rounded-3">Halaman Utama</a>
<a href="{{ route('produsen.index') }}" type="button" class="btn btn-primary rounded-3">List Produsen</a>

@if($message = Session::get('success'))
    <div class="alert alert-success mt-3" role="alert">
        {{ $message }}
    </div>
@endif

<h4 class="mt-5">Data Warehouse</h4>

<a href="{{ route('warehouse.create') }}" type="button" class="btn btn-success rounded-3">Tambah Data</a>

<table class="table table-hover mt-2">
    <thead>
      <tr>
        <th>ID Warehouse</th>
        <th>Stok Merch</th>
        <th>ID Merch</th>
        <th>Action</th>
      </tr>
    </thead>


    <tbody>
        @foreach ($datas as $warehouse)
            <tr>
                <td>{{ $warehouse->id_warehouse }}</td>
                <td>{{ $warehouse->stok_merch }}</td>
                <td>{{ $warehouse->id_merch }}</td>
                <td>
                    <a href="{{ route('warehouse.edit', $warehouse->id_warehouse) }}" type="button" class="btn btn-warning rounded-3">Ubah</a>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal3{{ $warehouse->id_warehouse }}">
                        Hapus
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="hapusModal3{{ $warehouse->id_warehouse }}" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="hapusModalLabel">Konfirmasi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('warehouse.delete', $warehouse->id_warehouse) }}">
                                    @csrf
                                    <div class="modal-body">
                                        Apakah anda yakin ingin menghapus id {{ $warehouse->id_warehouse}} ini?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Ya</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<h4 class="mt-5">Tabel data stok</h4>
<table class="table table-hover mt-2">
    <thead>
      <tr>
        <th>Nama Merch</th>
        <th>Keyword</th>
        <th>Harga Merch</th>
        <th>Stok Merch</th>
      </tr>
    </thead>
<tbody>
    @foreach ($joins as $join)
        <tr>
            <td>{{ $join->nama_merch }}</td>
            <td>{{ $join->keyword }}</td>
            <td>{{ $join->harga_merch }}</td>
            <td>{{ $join->stok_merch }}</td>
    @endforeach
</tbody>
</table>

@stop