@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Data Penjualan</h2>
    <a href="{{ route('penjualan.create') }}" class="btn btn-primary">Tambah Penjualan</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tanggal</th>
            <th>Karyawan</th>
            <th>Detail Items</th>
            <th>Tanggal Dibuat</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($penjualan as $item)
        <tr>
            <td>{{ $item['id'] }}</td>
            <td>{{ \Carbon\Carbon::parse($item['tgl'])->format('d/m/Y H:i') }}</td>
            <td>
                <strong>{{ $item['karyawan']['Nama'] ?? 'N/A' }}</strong>
                <br><small class="text-muted">({{ $item['karyawan']['Gender'] ?? '' == 'L' ? 'Laki-laki' : 'Perempuan' }})</small>
            </td>
            <td>
                <a href="{{ route('penjualan.detail', $item['id']) }}" class="btn btn-info btn-sm">
                    Lihat Detail ({{ count($item['detail_penjualan'] ?? []) }} items)
                </a>
            </td>
            <td>{{ \Carbon\Carbon::parse($item['created_at'])->format('d/m/Y H:i') }}</td>
            <td>
                <div class="btn-group">
                    <a href="{{ route('penjualan.detail', $item['id']) }}" class="btn btn-info btn-sm">Detail</a>
                    <form action="{{ route('penjualan.destroy', $item['id']) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Hapus penjualan ini? Semua detail akan terhapus.')">Hapus</button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center">Tidak ada data penjualan</td>
        </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-3">
    <strong>Total Penjualan:</strong> {{ count($penjualan) }}
</div>
@endsection
