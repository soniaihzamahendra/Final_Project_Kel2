@extends('layouts.app')
@section('title', 'Transaksi Baru')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <i class="fas fa-plus-circle me-2"></i> Form Transaksi Baru
    </div>
    <div class="card-body">
        <form action="{{ route('kasir.transaksi.store') }}" method="POST" id="formTransaksi">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-bold">Jenis Transaksi</label>
                <select name="jenis" class="form-select" required>
                    <option value="penjualan">Penjualan</option>
                    <option value="pembelian">Pembelian</option>
                </select>
            </div>

            <hr>
            <h6 class="fw-bold mb-3"><i class="fas fa-box"></i> Pilih Barang</h6>

            <div id="item-container">
                <div class="row g-2 mb-2 item-row">
                    <div class="col-md-5">
                        <select name="items[0][barang_id]" class="form-select barang-select" required>
                            <option value="">-- Pilih Barang --</option>
                            @foreach($barang as $b)
                                <option value="{{ $b->id }}"
                                    data-harga-jual="{{ $b->harga_jual }}"
                                    data-harga-beli="{{ $b->harga_beli }}"
                                    data-stok="{{ $b->stokBarang->first()->jumlah_stok ?? 0 }}">
                                    {{ $b->nama_barang }} (Stok: {{ $b->stokBarang->first()->jumlah_stok ?? 0 }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="items[0][jumlah]" class="form-control jumlah-input" placeholder="Jumlah" min="1" required>
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control harga-display" placeholder="Harga satuan" readonly>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger btn-remove w-100">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-outline-primary btn-sm mb-4" id="btn-add-item">
                <i class="fas fa-plus"></i> Tambah Barang
            </button>

            <div class="card bg-light mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Total Harga:</h5>
                        <h4 class="mb-0 text-success fw-bold" id="total-display">Rp 0</h4>
                    </div>
                </div>
            </div>

            <div class="mb-3" id="bayar-section">
                <label class="form-label fw-bold">Uang Bayar (untuk penjualan)</label>
                <input type="number" name="bayar" class="form-control" placeholder="Masukkan jumlah uang bayar" id="bayar-input">
                <div class="mt-2" id="kembalian-display"></div>
            </div>

            <button type="submit" class="btn btn-success px-5">
                <i class="fas fa-save me-2"></i> Simpan Transaksi
            </button>
        </form>
    </div>
</div>
@endsection
@push('scripts')
<script>
    let itemIndex = 1;
    const barangOptions = `@foreach($barang as $b)
        <option value="{{ $b->id }}"
            data-harga-jual="{{ $b->harga_jual }}"
            data-harga-beli="{{ $b->harga_beli }}">
            {{ $b->nama_barang }} (Stok: {{ $b->stokBarang->first()->jumlah_stok ?? 0 }})
        </option>@endforeach`;

    // Tambah baris barang
    document.getElementById('btn-add-item').addEventListener('click', function () {
        const row = `
        <div class="row g-2 mb-2 item-row">
            <div class="col-md-5">
                <select name="items[${itemIndex}][barang_id]" class="form-select barang-select" required>
                    <option value="">-- Pilih Barang --</option>
                    ${barangOptions}
                </select>
            </div>
            <div class="col-md-2">
                <input type="number" name="items[${itemIndex}][jumlah]" class="form-control jumlah-input" placeholder="Jumlah" min="1" required>
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control harga-display" placeholder="Harga satuan" readonly>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger btn-remove w-100"><i class="fas fa-trash"></i></button>
            </div>
        </div>`;
        document.getElementById('item-container').insertAdjacentHTML('beforeend', row);
        itemIndex++;
        attachEvents();
    });

    function hitungTotal() {
        let total = 0;
        const jenis = document.querySelector('[name="jenis"]').value;
        document.querySelectorAll('.item-row').forEach(row => {
            const select = row.querySelector('.barang-select');
            const jumlah = parseInt(row.querySelector('.jumlah-input').value) || 0;
            const hargaDisplay = row.querySelector('.harga-display');
            if (select.value) {
                const opt = select.options[select.selectedIndex];
                const harga = jenis === 'penjualan'
                    ? parseInt(opt.dataset.hargaJual)
                    : parseInt(opt.dataset.hargaBeli);
                hargaDisplay.value = 'Rp ' + harga.toLocaleString('id-ID');
                total += harga * jumlah;
            }
        });
        document.getElementById('total-display').textContent = 'Rp ' + total.toLocaleString('id-ID');

        // Hitung kembalian
        const bayar = parseInt(document.getElementById('bayar-input').value) || 0;
        if (bayar > 0) {
            const kembalian = bayar - total;
            document.getElementById('kembalian-display').innerHTML =
                `<span class="text-${kembalian >= 0 ? 'success' : 'danger'} fw-bold">
                    Kembalian: Rp ${kembalian.toLocaleString('id-ID')}
                </span>`;
        }
    }

    function attachEvents() {
        document.querySelectorAll('.btn-remove').forEach(btn => {
            btn.onclick = function () {
                if (document.querySelectorAll('.item-row').length > 1) {
                    this.closest('.item-row').remove();
                    hitungTotal();
                }
            };
        });
        document.querySelectorAll('.barang-select, .jumlah-input').forEach(el => {
            el.oninput = hitungTotal;
        });
    }

    document.querySelector('[name="jenis"]').addEventListener('change', hitungTotal);
    document.getElementById('bayar-input').addEventListener('input', hitungTotal);
    attachEvents();
</script>
@endpush
