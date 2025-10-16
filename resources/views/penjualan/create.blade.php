@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4>Tambah Penjualan</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('penjualan.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="tgl" class="form-label">Tanggal Penjualan</label>
                        <input type="datetime-local" class="form-control" id="tgl" name="tgl" required
                               value="{{ old('tgl', now()->format('Y-m-d\TH:i')) }}">
                    </div>
                    <div class="mb-3">
                        <label for="pengguna_id" class="form-label">Karyawan</label>
                        <select class="form-control" id="pengguna_id" name="pengguna_id" required>
                            <option value="">Pilih Karyawan</option>
                            @foreach($karyawan as $k)
                                <option value="{{ $k['id'] }}">
                                    {{ $k['Nama'] }} ({{ $k['Gender'] == 'L' ? 'Laki-laki' : 'Perempuan' }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Simpan Penjualan</button>
                        <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
