@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4>Tambah Item ke Penjualan #{{ $penjualan_id }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('penjualan.detail.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="penjualan_id" value="{{ $penjualan_id }}">

                    <div class="mb-3">
                        <label for="produk_id" class="form-label">Pilih Produk</label>
                        <select class="form-control" id="produk_id" name="produk_id" required>
                            <option value="">Pilih Produk</option>
                            @foreach($produk as $p)
                                <option value="{{ $p['id'] }}"
                                        data-harga="{{ $p['Harga'] }}"
                                        data-stok="{{ $p['Stok'] }}">
                                    {{ $p['Produk'] }} - Rp {{ number_format($p['Harga'], 0, ',', '.') }}
                                    (Stok: {{ $p['Stok'] }})
                                </option>
                            @endforeach
                        </select>
                        <div class="form-text">
                            Stok tersedia: <span id="stok-info">-</span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga Satuan</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" id="harga" name="harga" required min="0"
                                   placeholder="Harga akan terisi otomatis">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="qty" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="qty" name="qty" required min="1"
                               placeholder="Masukkan jumlah" value="1">
                        <div class="form-text">
                            Subtotal: <span id="subtotal">Rp 0</span>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary" id="submit-btn">Tambah ke Penjualan</button>
                        <a href="{{ route('penjualan.detail', $penjualan_id) }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const produkSelect = document.getElementById('produk_id');
    const hargaInput = document.getElementById('harga');
    const qtyInput = document.getElementById('qty');
    const stokInfo = document.getElementById('stok-info');
    const subtotalSpan = document.getElementById('subtotal');
    const submitBtn = document.getElementById('submit-btn');

    function formatRupiah(angka) {
        return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function calculateSubtotal() {
        const harga = parseInt(hargaInput.value) || 0;
        const qty = parseInt(qtyInput.value) || 0;
        const subtotal = harga * qty;
        subtotalSpan.textContent = formatRupiah(subtotal);
    }

    function checkStock() {
        const selectedOption = produkSelect.options[produkSelect.selectedIndex];
        const stok = parseInt(selectedOption.getAttribute('data-stok')) || 0;
        const qty = parseInt(qtyInput.value) || 0;

        stokInfo.textContent = stok;

        if (stok < qty) {
            stokInfo.className = 'text-danger';
            submitBtn.disabled = true;
            submitBtn.title = 'Stok tidak mencukupi';
        } else {
            stokInfo.className = 'text-success';
            submitBtn.disabled = false;
            submitBtn.title = '';
        }
    }

    produkSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const harga = selectedOption.getAttribute('data-harga') || 0;
        hargaInput.value = harga;
        checkStock();
        calculateSubtotal();
    });

    qtyInput.addEventListener('input', function() {
        checkStock();
        calculateSubtotal();
    });

    hargaInput.addEventListener('input', calculateSubtotal);

    // Initialize
    calculateSubtotal();
});
</script>
@endsection
