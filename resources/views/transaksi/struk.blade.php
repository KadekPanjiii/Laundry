<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk</title>
    <!-- Toastr -->
    <link rel="stylesheet" href="/assets/plugins/toastr/toastr.min.css">
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: monospace;
    }

    .struk {
        padding: 1rem;
    }

    .dashed-line {
        margin: 1rem 0;
        border-bottom: 1px dashed black
    }
    .text-center {
        text-align: center;
    }

    table {
        width: 100%;
        text-align: end;
    }
    table tr > * {
        padding: 0.2rem;
    }
    table .text-start {
        text-align: start;
    }
</style>
</head>
<body>
    <div class="struk">
        <div class="struk-header">
            <div class="text-center">
                <h2>UKK Laundry</h2>
                <p>Eight Elephant - Branch 102001</p>
            </div>
            <div class="dashed-line"></div>
            <p>Kode Invoice: <span style="text-wrap: nowrap;">{{ $transaksi->kode_invoice }}</span></p>
            <p>Tanggal: {{ $transaksi->tgl }}</p>
            <p>Petugas: {{ $transaksi->user->nama ?? "-" }} ({{ $transaksi->id_user ?? "-"}})</p>
            <p style="margin-top: 1rem;">Pelanggan: {{ $transaksi->member->nama ?? "-" }}</p>
            <p>Telepon: {{ $transaksi->member->tlp ?? "-" }}</p>
            <p>Member: {{ $transaksi->member->nama ?? "-" }} ({{ $transaksi->id_member ?? "-"}})</p>
        </div>
        <div class="dashed-line"></div>
        <div class="struk-body">
            <table cellpadding="2px">
                <tr>
                    <th class="text-start">Nama</th>
                    <th>Harga</th>
                    <th>Jml</th>
                    <th>SubTotal</th>
                </tr>
                @foreach ($transaksi->detailTransaksi as $index => $ddt )
                    <tr>
                        <td class="text-start">{{ $ddt->paket->nama_paket ?? "-" }}</td>
                        <td>Rp. {{ number_format ($ddt->paket->harga) ?? 0 }}</td>
                        <td>{{ $ddt->qty ?? 0 }}</td>
                        <td>Rp. {{ number_format($ddt->qty * $ddt->paket->harga) ?? 0 }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4" style="padding: 0;">
                        <div class="dashed-line"></div>
                    </td>
                </tr>
                <tr>
                    <th colspan="3" style="text-align: end;">Total:</th>
                    <td>Rp. {{ number_format($transaksi->total_harga) ?? 0 }}</td>
                </tr>
                <tr>
                    <th colspan="3" style="text-align: end;">Biaya Tambahan:</th>
                    <td>Rp. {{ number_format($transaksi->biaya_tambahan) ?? 0 }}</td>
                </tr>
                <tr>
                    <th colspan="3" style="text-align: end;">Pajak:</th>
                    <td>Rp. {{ number_format($transaksi->pajak) ?? 0 }}</td>
                </tr>
                <tr>
                    <th colspan="3" style="text-align: end;">Diskon:</th>
                    <td>Rp. {{ number_format($transaksi->diskon) ?? 0 }}</td>
                </tr>
                <tr>
                    <th colspan="3" style="text-align: end;">Total Akhir:</th>
                    <td>Rp. {{ number_format($transaksi->harga += $transaksi->total_tagihan) ?? 0 }}</td>
                </tr>
                <tr>
                    <th colspan="3" style="text-align: end;">Total Bayar:</th>
                    <td>Rp. {{ number_format($transaksi->total_bayar) ?? 0 }}</td>
                </tr>
                <tr>
                    <th colspan="3" style="text-align: end;">Total Kembalian:</th>
                    <td>Rp. {{ $transaksi->dibayar == 'dibayar' ? number_format($transaksi->total_tagihan - $transaksi->total_bayar) : 0 }}</td>
                </tr>
            </table>
        </div>
        <div class="dashed-line"></div>
        <div class="struk-footer text-center">
            <p>Terima Kasih</p>
            <p>Telah menggunakan jasa kami</p>
        </div>
    </div>

<!-- Toastr -->
<script src="/assets/plugins/toastr/toastr.min.js"></script>
@if(session('toastr'))
<script>
    toastr.{{ session('toastr.type') }}('{{ session('toastr.message') }}');
</script>
@endif

<script>
    window.addEventListener("afterprint", function() {
        @php
            $lokasi = request()->query('lokasi') ?? '';
            $id = $transaksi->id ?? '';
        @endphp

        @if (!empty($lokasi))
            @if ($lokasi === 'detail')
                window.location.href = "/transaksi/detail/{{ $id }}";
            @else
                window.location.href = "/transaksi";
            @endif
        @else
            window.location.href = "/transaksi/tambah";
        @endif
    });

    window.print();
</script>


</body>
</html>
