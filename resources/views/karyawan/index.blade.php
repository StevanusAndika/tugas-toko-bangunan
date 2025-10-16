@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Data Karyawan</h2>
    <a href="{{ route('karyawan.create') }}" class="btn btn-primary">Tambah Karyawan</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Gender</th>
            <th>Sandi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($karyawan as $item)
        <tr>
            <td>{{ $item['id'] }}</td>
            <td>{{ $item['Nama'] }}</td>
            <td>{{ $item['Gender'] == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
            <td>{{ $item['Sandi'] }}</td>
            <td>
                <form action="{{ route('karyawan.destroy', $item['id']) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Hapus data ini?')">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center">Tidak ada data</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
