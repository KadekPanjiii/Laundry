@extends('layouts.main')

@section('container')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail {{ $title }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/transaksi">Transaksi</a></li>
                        <li class="breadcrumb-item active">Detail Transaksi</li>
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
                        <div class="card-body">
                            @foreach ($data_transaksi as $dt)         
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="kode_invoice">Kode Invoice</label>
                                    <input type="text" class="form-control" id="kode_invoice" value="{{ $dt->kode_invoice ?? "-"}}" placeholder="Kode Invoice" readonly>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="text" class="form-control" id="tanggal" value="{{ empty ($dt->tgl) ? "-" : date("l, d F Y H:i:s", strtotime($dt->tgl)) }}" placeholder="Tanggal" readonly>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="batas_waktu">Batas Waktu</label>
                                    <input type="text" class="form-control" id="batas_waktu" value="{{ empty ($dt->batas_waktu) ? "-" : date("l, d F Y H:i:s", strtotime($dt->batas_waktu)) }}" placeholder="Batas Waktu" readonly>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="tanggal_bayar">Tanggal Bayar</label>
                                    <input type="text" class="form-control" id="tanggal_bayar" value="{{ empty ($dt->tgl_bayar) ? "-" : date("l, d F Y H:i:s", strtotime($dt->tgl_bayar)) }}" placeholder="Tanggal Bayar" readonly>
                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="total_harga">Total Harga</label>
                                    <input type="text" class="form-control" id="total_harga" value="Rp. {{ number_format ($dt->total_harga) }}" placeholder="Total Harga" readonly>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="biaya_tambahan">Biaya Tambahan</label>
                                    <input type="text" class="form-control" id="biaya_tambahan" value="{{ $dt->biaya_tambahan ?? "-"}}" placeholder="Biaya Tambahan" readonly>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="pajak">Pajak</label>
                                    <input type="text" class="form-control" id="pajak" value="{{ $dt->pajak ?? "-" }}" placeholder="Pajak" readonly>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="diskon">Diskon</label>
                                    <input type="text" class="form-control" id="diskon" value="{{ $dt->diskon ?? "-"}}" placeholder="Diskon" readonly>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="total_tagihan">Total Tagihan</label>
                                    <input type="text" class="form-control" id="total_tagihan" value="Rp. {{ number_format ($dt->total_tagihan) }}" placeholder="Total Tagihan" readonly>
                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="total_tagihan">Total Bayar</label>
                                    <input type="text" class="form-control" id="total_tagihan" value="Rp. {{ number_format ($dt->total_bayar) }}" placeholder="Total Tagihan" readonly>
                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="status">Status</label>
                                    <input type="text" class="form-control" id="status" value="{{ ucfirst ($dt->status) ?? "-" }}" placeholder="Status" readonly>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="dibayar">Dibayar</label>
                                    <input type="text" class="form-control" id="dibayar" value="{{ ucwords (str_replace( "_", " ", $dt->dibayar)) ?? "-" }}" placeholder="Dibayar" readonly>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="id_outlet">Outlet (ID)</label>
                                    <input type="text" class="form-control" id="id_outlet" value="{{ $dt->outlet->nama ?? "-" }} ({{ $dt->outlet->id ?? "-"}})" placeholder="Outlet" readonly>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="id_member">Member (ID)</label>
                                    <input type="text" class="form-control" id="id_member" value="{{ $dt->member->nama ?? "-"}} ({{ $dt->member->id ?? "-"}})" placeholder="Member" readonly>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="id_user">User (ID)</label>
                                    <input type="text" class="form-control" id="id_user" value="{{ $dt->user->nama ?? "-"}} ({{ $dt->user->id ?? "-"}})" placeholder="User" readonly>
                                </div>
                            </div>
                            @endforeach
                            <div class="row">
                                <div class="col">
                                    <table id="tabelDetailTransaksi" class="table text-dark">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama Paket (ID)</th>
                                                <th>Jumlah</th>
                                                <th>Harga</th>
                                                <th>Sub Total</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data_d_transaksi as $ddt)                               
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $ddt->paket->nama_paket ?? "-"}} ({{ $ddt->paket->id ?? "-" }})</td>
                                                <td>{{ $ddt->qty, 2 ?? "-"}}</td>
                                                <td>Rp. {{ number_format($ddt->paket->harga) ?? "-" }}</td>
                                                <td><span class="sub-total">Rp. {{ number_format ($ddt->qty * $ddt->paket->harga) ?? "-" }}</span></td>
                                                <td>{{ empty ($ddt->keterangan) ? "-" : $ddt->keterangan}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        @foreach ($data_transaksi as $dt)                           
                        <div class="card-footer">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex" style="gap: 0.6em">
                                    @can('admin')
                                    <form action="/transaksi/ubah/{{ $dt->id }}" method="GET" class="d-inline-block">
                                        <input type="hidden" name="id" value="{{ $dt->id }}">
                                        <input type="hidden" name="asal" value="{{  empty($dt->id) ? "" : "detail?id=" . $dt->id }}">
                                        <button type="submit" class="btn btn-warning">Ubah</button>
                                    </form>
                                    <form action="/transaksi/delete/{{ $dt->id }}" method="GET" class="form-tdelete d-inline-block">
                                        <input type="hidden" name="id" value="{{ $dt->id }}">
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                    @endcan
                                </div>
                                <div class="d-flex" style="gap: 0.6em;">
                                    <a href="/transaksi/struk?lokasi=detail&invoice={{ $dt->kode_invoice }}" class="btn btn-info">Cetak Struk</a>
                                    <a href="/transaksi" class="btn btn-secondary">Kembali</a>
                                </div>
                            </div>
                        </div>
                        @endforeach 
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col-md-6 -->

                <div class="col-12 mb-4">
                    <div class="card">
                        <form action="/transaksi/status" method="POST" id="form-ubah-status">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Ubah Status Transaksi</h4>
                            </div>
                            <div class="card-body">
                                @foreach ($data_transaksi as $dt)   
                                @csrf
                                <input type="hidden" name="id" value="{{ $dt->id }}">
                                <select name="transaksi_status" id="transaksi_status" class="form-control">
                                    <option <?php if($dt['status']=='baru') echo "selected";?>  value="baru">Baru</option>
                                    <option <?php if($dt['status']=='proses') echo "selected";?> value="proses">Proses</option>
                                    <option <?php if($dt['status']=='selesai') echo "selected";?> value="selesai">Selesai</option>
                                    <option <?php if($dt['status']=='diambil') echo "selected";?> value="diambil">Diambil</option>
                                </select>
                                @endforeach  
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">Terapkan</button>
                            </div>
                        </form>
                    </div>
                </div>

                @foreach ($data_transaksi as $dt)
                @if ($dt->dibayar != 'dibayar')
                <div class="col-12">
                    <div class="card">
                        <form action="/transaksi/bayar" method="POST" id="form-bayar">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Bayar Transaksi</h4>
                            </div>
                            <div class="card-body">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="id" value="{{ $dt->id }}">
                                    <div class="form-group col-12">
                                        <label for="tagihan">Total Tagihan</label>
                                        <input type="number" class="form-control" id="tagihan" value="{{ $dt->total_tagihan }}" placeholder="Total Tagihan" readonly>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="bayar">Total Bayar</label>
                                        <input type="number" class="form-control" name="bayar" id="bayar" value="" placeholder="Total Bayar">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="kembalian">Total Kembalian</label>
                                        <input type="number" class="form-control" id="kembalian" value="0" placeholder="Total Kembalian" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">Terapkan</button>
                            </div>
                        </form>
                    </div>
                </div>          
                @endif
                @endforeach
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- ./wrapper -->

<!-- jQuery -->
<script src="/assets/plugins/jquery/jquery.min.js"></script>

<script>
    $(document).ready(function() {
    let table = new DataTable('#tabelDetailTransaksi', {
        responsive: true,
        info: false,
        paging: false,
    });

    // Ubah status
    $("#form-ubah-status").on("submit", function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Konfirmasi',
            text: "Status Transaksi akan diubah!",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Terapkan',
            cancelButtonText: 'Kembali'
        }).then((result) => {
            if (result.isConfirmed) {
                $(this).unbind("submit").submit();
            }
        });
    });

    // Ubah dibayar
    function ubahKembalian() {
        let tagihan = parseFloat($("#tagihan").val() || 0);
        tagihan = tagihan > 0 ? tagihan : 0;
        let bayar = parseFloat($("#bayar").val() || 0);
        bayar = bayar > 0 ? bayar : 0;

        $("#kembalian").val(bayar - tagihan);
    }

    $("#bayar").on("input", function() {
        ubahKembalian();
    });

    $("#form-bayar").on("submit", function(e) {
        e.preventDefault();

        // Cek harga bayar
        let tagihan = parseFloat($("#tagihan").val() || 0);
        tagihan = tagihan > 0 ? tagihan : 0;
        let bayar = parseFloat($("#bayar").val() || 0);
        bayar = bayar > 0 ? bayar : 0;

        if (tagihan > bayar) {
            toastr.warning('Total Bayar belum mencukupi', {});
            return;
        }

        Swal.fire({
            title: 'Konfirmasi',
            text: "Transaksi akan dibayar!",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Bayar',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $(this).unbind("submit").submit();
            }
        });
    });
});
</script>

@endsection


