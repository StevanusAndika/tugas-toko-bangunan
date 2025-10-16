@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Detail Penjualan #{{ $penjualan_id }}</h2>
    <div>
        <a href="{{ route('penjualan.detail.create', $penjualan_id) }}" class="btn btn-primary">Tambah Item</a>
        <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">Kembali ke Penjualan</a>
    </div>
</div>

@if(count($details) > 0)
<div class="card mb-4">
    <div class="card-header">
        <h5>Ringkasan Penjualan</h5>
    </div>
    <div class="card-body">
        @php
            $totalQty = 0;
            $totalValue = 0;
            foreach($details as $detail) {
                $totalQty += $detail['qty'];
                $totalValue += $detail['qty'] * $detail['harga'];
            }
        @endphp
        <div class="row">
            <div class="col-md-3">
                <strong>Total Items:</strong> {{ $totalQty }}
            </div>
            <div class="col-md-3">
                <strong>Total Nilai:</strong> Rp {{ number_format($totalValue, 0, ',', '.') }}
            </div>
            <div class="col-md-3">
                <strong>Jumlah Produk:</strong> {{ count($details) }}
            </div>
        </div>
    </div>
</div>
@endif

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Produk</th>
            <th>Harga Satuan</th>
            <th>Qty</th>
            <th>Subtotal</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($details as $detail)
        <tr>
            <td>{{ $detail['id'] }}</td>
            <td>
                <strong>{{ $detail['produk']['Produk'] ?? 'N/A' }}</strong>
                <br><small class="text-muted">Stok: {{ $detail['produk']['Stok'] ?? 0 }}</small>
            </td>
            <td>Rp {{ number_format($detail['harga'], 0, ',', '.') }}</td>
            <td>
                <span class="badge bg-primary">{{ $detail['qty'] }}</span>
            </td>
            <td>
                <strong>Rp {{ number_format($detail['qty'] * $detail['harga'], 0, ',', '.') }}</strong>
            </td>
            <td>{{ \Carbon\Carbon::parse($detail['created_at'])->format('d/m/Y H:i') }}</td>
            <td>
                <form action="{{ route('penjualan.detail.destroy', $detail['id']) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Hapus item ini dari penjualan?')">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="text-center">
                <div class="py-4">
                    <h5>Belum ada item dalam penjualan ini</h5>
                    <p>Tambahkan item produk untuk melengkapi penjualan</p>
                    <a href="{{ route('penjualan.detail.create', $penjualan_id) }}" class="btn btn-primary">
                        Tambah Item Pertama
                    </a>
                </div>
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

@if(count($details) > 0)
<div class="card mt-3">
    <div class="card-body bg-light">
        <div class="row text-center">
            <div class="col-md-4">
                <h6>Total Quantity</h6>
                <h4 class="text-primary">{{ $totalQty }}</h4>
            </div>
            <div class="col-md-4">
                <h6>Total Items</h6>
                <h4 class="text-info">{{ count($details) }}</h4>
            </div>
            <div class="col-md-4">
                <h6>Total Value</h6>
                <h4 class="text-success">Rp {{ number_format($totalValue, 0, ',', '.') }}</h4>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
