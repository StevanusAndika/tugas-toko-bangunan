@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4>Tambah Produk</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('produk.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="Produk" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="Produk" name="Produk" required maxlength="30"
                               placeholder="Masukkan nama produk">
                    </div>
                    <div class="mb-3">
                        <label for="Harga" class="form-label">Harga</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" id="Harga" name="Harga" required min="0"
                                   placeholder="Masukkan harga">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="Stok" class="form-label">Stok</label>
                        <input type="number" class="form-control" id="Stok" name="Stok" required min="0"
                               placeholder="Masukkan jumlah stok">
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Simpan Produk</button>
                        <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
