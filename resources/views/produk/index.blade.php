@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Data Produk</h2>
    <a href="{{ route('produk.create') }}" class="btn btn-primary">Tambah Produk</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Tanggal Dibuat</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($produk as $item)
        <tr>
            <td>{{ $item['id'] ?? 'N/A' }}</td>
            <td>{{ $item['Produk'] ?? 'N/A' }}</td>
            <td>Rp {{ number_format($item['Harga'] ?? 0, 0, ',', '.') }}</td>
            <td>
                <span class="badge {{ ($item['Stok'] ?? 0) > 10 ? 'bg-success' : (($item['Stok'] ?? 0) > 0 ? 'bg-warning' : 'bg-danger') }}">
                    {{ $item['Stok'] ?? 0 }}
                </span>
            </td>
            <td>
                @if(isset($item['created_at']))
                    {{ \Carbon\Carbon::parse($item['created_at'])->format('d/m/Y H:i') }}
                @else
                    N/A
                @endif
            </td>
            <td>
                @if(isset($item['id']))
                <form action="{{ route('produk.destroy', $item['id']) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Hapus produk ini?')">Hapus</button>
                </form>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center">Tidak ada data produk</td>
        </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-3">
    <strong>Total Produk:</strong> {{ count($produk) }}
</div>
@endsection
