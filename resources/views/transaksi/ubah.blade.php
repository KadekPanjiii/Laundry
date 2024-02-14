@extends('layouts.main')

@section('container')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Ubah {{ $title }}</h1>
                </div>
                <div class="col-sm-6 text-right">
                    {{ date("l, d F Y") }}
                    <br>
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/transaksi">Transaksi</a></li>
                        <li class="breadcrumb-item active">Ubah Transaksi</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col-md-6 -->
                <div class="col-lg-12">
                    <!-- general form elements -->
                    <div class="card">
                        <!-- /.card-header -->
                        <!-- form start -->
                        @foreach ($data_transaksi as $dt)
                        <form action="/transaksi/update/{{ $dt->id }}" method="POST" id="form-transaksi">
                            @csrf
                            
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label class="col-form-label">Batas Waktu</label>
                                        <input type="datetime-local" step="1" name="batas_waktu" value="{{ $dt->batas_waktu ?? "" }}"
                                            class="form-control" placeholder="Batas Waktu" id="batas_waktu" required>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label class="col-form-label">Member</label>
                                        <select class="form-control" name="member" required>
                                            @foreach ($data_member as $dm)      
                                            <option value="{{ $dm->id }}" {{ $dt->id_member === $dm->id ? "selected" : "" }}>{{ $dm->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label class="col-form-label">Outlet</label>
                                        <select class="form-control" name="outlet" id="outlet" required>
                                            @foreach ($data_outlet as $do)
                                            <option value="{{ $do->id }}" {{ $dt->id_outlet === $do->id ? "selected" : "" }}>{{ ucwords($do->nama) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label class="col-form-label">Paket</label>
                                        <select class="form-control tombol-pilih" style="width: 100%;">
                                            <option value="" hidden>Pilih Paket</option>
                                            @foreach ($data_paket as $dp)
                                            <option value="{{ $dp->id }}" data-kode="{{ $dp->id }}" data-nama="{{ $dp->nama_paket }}" data-jenis="{{ $dp->jenis }}" data-harga="{{ $dp->harga }}">
                                                {{ ucwords(str_replace("_", " ", $dp->nama_paket)) ?? "-" }} -
                                                {{ ucwords(str_replace("_", " ", $dp->jenis)) ?? "-" }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <input type="hidden" name="pakets" id="pakets">
                                    <input type="hidden" name="id" id="id" value="{{ $dt->id }}">

                                    <div class="col-lg-12 mb-3">
                                        <div class="table-responsive">
                                            <table id="tableTransaksi"
                                                class="table table-hover text-dark mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Kode</th>
                                                        <th>Nama</th>
                                                        <th>Jumlah</th>
                                                        <th>Harga</th>
                                                        <th>Total</th>
                                                        <th>Keterangan</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tabelPaket">
                                                    <!-- Data Paket akan ditampilkan di sini -->
                                                </tbody>
                                            </table>
                                            <div class="mt-3 bg-light p-3 rounded">
                                                <div class="row" style="row-gap: 1rem !important;">
                                                    <div class="col-12">
                                                        <label for="total_harga"
                                                            class="form-label">Total Harga</label>
                                                        <input type="number" name="total_harga"
                                                            id="total_harga" class="form-control" value="0"
                                                            placeholder="Total Harga" disabled readonly>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="biaya_tambahan"
                                                            class="form-label">Biaya Tambahan</label>
                                                        <input type="number" name="biaya_tambahan" value="{{ $dt->biaya_tambahan ?? "" }}"
                                                            id="biaya_tambahan" class="form-control"
                                                            placeholder="Biaya Tambahan">
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="pajak" class="form-label">Pajak</label>
                                                        <input type="number" name="pajak" value="{{ $dt->pajak ?? "" }}" id="pajak"
                                                            class="form-control" placeholder="Pajak">
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="diskon"
                                                            class="form-label">Diskon</label>
                                                        <input type="number" name="diskon" value="{{ $dt->diskon ?? "" }}" id="diskon"
                                                            class="form-control" placeholder="Diskon">
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="total_tagihan"
                                                            class="form-label">Total Tagihan</label>
                                                        <input type="number" name="total_tagihan"
                                                            id="total_tagihan" class="form-control" value="0"
                                                            placeholder="Total Tagihan" disabled readonly>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="total_bayar"
                                                            class="form-label">Total Bayar</label>
                                                        <input type="number" name="total_bayar" value="{{ ($dt->total_bayar ?? 0) > 0 ? $dt->total_bayar : "" }}"
                                                            id="total_bayar" class="form-control"
                                                            placeholder="Total Bayar">
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="total_kembalian"
                                                            class="form-label">Total Kembalian</label>
                                                        <input type="number" name="total_kembalian"
                                                            id="total_kembalian" class="form-control" value="0"
                                                            placeholder="Total Kembalian" disabled readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            
                            <div class="card-footer">
                                <div class="d-flex justify-content-between align-items-center">
                                    <button type="submit" class="btn btn-primary">Ubah Transaksi</button>
                                    <a href="/transaksi" class="btn btn-secondary">Kembali</a>
                                </div>
                            </div>
                        </form>
                        @endforeach
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script src="/assets/plugins/jquery/jquery.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        let table = $('#tableTransaksi').DataTable({
            responsive: true,
            info: false,
            paging: false,
            ordering: false,
            columns: [
                { data: "kode" },
                { data: "nama" },
                { data: "jumlah" },
                { data: "harga" },
                { data: "total" },
                { data: "keterangan" },
                { data: "aksi" }
            ]
        });

        // Ubah total harga
        function ubahTotalHarga() {
            let totalHarga = 0;
            $("#tableTransaksi .total").each(function () {
                totalHarga += parseFloat($(this).text());
            });
            $("#total_harga").val(totalHarga);
            
            // Ubah pajak jadi 10% total_harga
            $("#pajak").val(Math.ceil(totalHarga * 0.1));
            ubahTagihan();
        }

        // Ubah total tagihan
        function ubahTagihan() {
            let totalHarga = parseFloat($("#total_harga").val() || 0);
            totalHarga = totalHarga > 0 ? totalHarga : 0;
            let biayaTambahan = parseFloat($("#biaya_tambahan").val() || 0);
            biayaTambahan = biayaTambahan > 0 ? biayaTambahan : 0;
            let pajak = parseFloat($("#pajak").val() || 0);
            pajak = pajak > 0 ? pajak : 0;
            let diskon = parseFloat($("#diskon").val() || 0);
            diskon = diskon > 0 ? diskon : 0;

            let totalTagihan = totalHarga + biayaTambahan + pajak - diskon;
            $("#total_tagihan").val(totalTagihan < 0 ? 0 : totalTagihan);

            ubahKembalian();
        }

        // Ubah total kembalian
        function ubahKembalian() {
            let totalBayar = parseFloat($("#total_bayar").val() || 0);
            totalBayar = totalBayar > 0 ? totalBayar : 0;
            let totalTagihan = parseFloat($("#total_tagihan").val() || 0);
            totalTagihan = totalTagihan > 0 ? totalTagihan : 0;

            let totalKembalian = totalBayar - totalTagihan;
            $("#total_kembalian").val(totalKembalian);
        }

        function kembalikanData(pakets) {
            // Perbarui keterangan dan jumlah barang
            pakets.forEach(paket => {
                tambahPilihanPaket(".tombol-pilih > option[data-kode='" + paket.kode + "']", paket.jumlah, paket.keterangan);
            });
        }

        function toastrWarning(pesan) {
            toastr.warning(pesan);
        }

        function tambahPilihanPaket(selectedOption, jumlah = 1, keterangan = null) {
            let kode = $(selectedOption).data("kode");
            let nama = $(selectedOption).data("nama");
            let harga = $(selectedOption).data("harga");
            let jenis = $(selectedOption).data("jenis");

            let step = jenis === "kiloan" ? "0.01" : "1";

            let baris = table.row.add({
                "kode": kode,
                "nama": nama,
                "jumlah": "<input type='number' step='" + step + "' data-kode='" + kode + "' data-harga='" + harga + "' class='form-control form-control-sm input-jumlah' value='" + jumlah + "' placeholder='Juml' required>",
                "harga": harga,
                "total": "<p data-kode='" + kode + "' class='total mb-0' style='color: black;'>" + harga + "</p>",
                "keterangan": "<input type='text' data-kode='" + kode + "' class='form-control form-control-sm input-keterangan' value='" + (keterangan || "") + "' placeholder='Keterangan'>",
                "aksi": "<button type='button' data-kode='" + kode + "' class='tombol-hapus btn btn-danger btn-sm'><i class='fa-solid fa-trash'></i></button>",
            }).draw().node();
            $(baris).attr("data-kode", kode);

            ubahTotalHarga();
        }
            
        // EVENT
        // Data on add
        $(".tombol-pilih").on("change", function() {
            // Jika sudah di klik, tidak bisa di klik
            let selectedOption = $(this).find(":selected");
            // selectedOption.hide();
            tambahPilihanPaket(selectedOption);
        });

        // Jumlah on input
        $("#tableTransaksi tbody").on("input", ".input-jumlah", function () {
            let jumlah = parseFloat($(this).val() || 0);
            jumlah = jumlah > 0 ? jumlah : 0;
            let harga = parseFloat($(this).data("harga") || 0);
            harga = harga > 0 ? harga : 0;
            let total = jumlah * harga;
            $(".total[data-kode='" + $(this).data("kode") + "']").text(total);

            ubahTotalHarga();
        });

        // Bayar on input
        $("#total_bayar").on("input", function() {
            ubahKembalian();
        });

        // Biaya Tambahan on input
        $("#biaya_tambahan, #pajak, #diskon").on("input", function () {
            ubahTagihan();
        });

        // Data on delete
        $("#tableTransaksi tbody").on("click", ".tombol-hapus", function () {
            $(".tombol-pilih > option[data-kode='" + $(this).data("kode") + "']").show();
            table.row($(this).parents('tr')).remove().draw();
            ubahTotalHarga();
        });
        
        // TAMBAH TRANSAKSI
        $("#form-transaksi").on("submit", function(event){
            event.preventDefault();

            // Cek input diatas tabel
            let batas_waktu = $("#batas_waktu").val();
            // Jika batas waktu diisi = validasi
            if(batas_waktu) {
                // Cek batas waktu, apakah kurang dari hari ini
                let hariIni = new Date();
                let batasWaktu = new Date(batas_waktu);
                if(hariIni > batasWaktu) {
                    toastrWarning("Batas Waktu tidak boleh sudah berlalu");
                    return;
                }
            }

            ubahKembalian();

            // Bisa bayar nanti, Cek input dibawah tabel
            let bayar = $("#total_bayar").val();
            if(bayar) {
                let totalKembalian = parseFloat($("#total_kembalian").val() || 0);
                if(totalKembalian < 0) {
                    toastrWarning("Harga Bayar belum cukup");
                    return;
                }
            }

            // Ambil semua data di tabel, masukkan ke input #pakets
            let pakets = [];
            $("#tableTransaksi tbody tr[data-kode]").each(function() {
                let kode = $(this).find(".input-jumlah").attr("data-kode");
                let jumlah = parseInt($(this).find(".input-jumlah").val() || 0);
                jumlah = jumlah > 0 ? jumlah : 0;
                let keterangan = $(this).find(".input-keterangan").val();

                pakets.push({
                    kode: kode,
                    jumlah: jumlah,
                    keterangan: keterangan,
                });
            });

            // Cek minimal beli 1 barang
            if(!pakets.length) {
                toastrWarning("Pilih setidaknya 1 Paket");
                return;
            }      

            Swal.fire({
                title: 'Konfirmasi',
                text: "Konfirmasi tambah Transaksi",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, tambah',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#pakets").val(JSON.stringify(pakets));
                    $("#form-transaksi").unbind("submit").submit();
                }
            });
        });

        // Set pilihan paket awal
        let pilihanPaketAwal = @json($data_d_transaksi);
        pilihanPaketAwal.forEach(paket => {
            tambahPilihanPaket(".tombol-pilih > option[data-kode='" + paket.id_paket + "']", paket.qty, paket.keterangan);
            $(".tombol-pilih > option[data-kode='" + paket.id_paket + "']").hide();
        });
    });
</script>
@endsection