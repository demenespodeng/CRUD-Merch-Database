@extends('merch.layout')

@section('content')


<p>Cari Data:</p>
<div class="pb-3">
    <form class="d-flex" action="{{ url('/produsen') }}" method="get">
        <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search">
        <button class="btn btn-secondary" type="submit">Cari</button>
    </form>
</div>

<a href="{{ route('merch.index') }}" type="button" class="btn btn-primary rounded-3">Halaman Utama</a>
<a href="{{ route('warehouse.index') }}" type="button" class="btn btn-primary rounded-3">Cek Stok</a>

<h4 class="mt-5">Data Produsen</h4>


<a href="{{ route('produsen.create') }}" type="button" class="btn btn-success rounded-3">Tambah Data</a>

@if($message = Session::get('success'))
    <div class="alert alert-success mt-3" role="alert">
        {{ $message }}
    </div>
@endif

<table class="table table-hover mt-2">
    <thead>
      <tr>
        <th>ID Produsen</th>
        <th>Nama Produsen</th>
        <th>Domisili</th>
        <th>ID Merch</th>
        <th>Action</th>
      </tr>
    </thead>


    <tbody>
        @foreach ($datas as $produsen)
            <tr>
                <td>{{ $produsen->id_produsen }}</td>
                <td>{{ $produsen->nama_produsen }}</td>
                <td>{{ $produsen->domisili }}</td>
                <td>{{ $produsen->id_merch }}</td>
                <td>
                    <a href="{{ route('produsen.edit', $produsen->id_produsen) }}" type="button" class="btn btn-warning rounded-3">Ubah</a>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal2{{ $produsen->id_produsen }}">
                        Hapus
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="hapusModal2{{ $produsen->id_produsen }}" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="hapusModalLabel">Konfirmasi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('produsen.delete', $produsen->id_produsen) }}">
                                    @csrf
                                    <div class="modal-body">
                                        Apakah anda yakin ingin menghapus {{ $produsen->nama_produsen}} ini?
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

<h4 class="mt-5">Tabel List Produsen</h4>
<table class="table table-hover mt-2">
    <thead>
      <tr>
        <th>Nama Merch</th>
        <th>Keyword</th>
        <th>Harga Merch</th>
        <th>Nama Produsen</th>
        <th>Domisili</th>
      </tr>
    </thead>
<tbody>
    @foreach ($joins as $join)
        <tr>
            <td>{{ $join->nama_merch }}</td>
            <td>{{ $join->keyword }}</td>
            <td>{{ $join->harga_merch }}</td>
            <td>{{ $join->nama_produsen }}</td>
            <td>{{ $join->domisili }}</td>
    @endforeach
</tbody>
</table>

@stop