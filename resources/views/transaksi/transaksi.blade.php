@extends('layouts.main')

@section('container')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ $title }}</h1>
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
          <div class="col">
            <div class="card">
              <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Data Transaksi</h4>
                    <a href="/transaksi/tambah" class="btn btn-primary">Tambah {{ $title }}</a>
                </div>
            </div>            
            
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-hover table-striped">
                  <thead>
                  <tr>
                    <th style="width: 1%;">#</th>
                    <th>ID Transaksi</th>
                    <th>Kode Invoice</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Dibayar</th>
                    <th style="width: 6%;">User ID</th>
                    <th style="width: 16%;">Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($data_transaksi as $dt)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $dt->id  ?? "-"}}</td>
                    <td>{{ $dt->kode_invoice ?? "-"}}</td>
                    <td>{{ empty ($dt->tgl) ? "-" : date("l, d F Y H:i:s", strtotime($dt->tgl)) }}</td>
                    <td>
                      <span class="
                      @if($dt->status == 'baru') btn btn-sm btn-light
                      @elseif($dt->status == 'proses') btn btn-sm btn-info
                      @elseif($dt->status == 'selesai') btn btn-sm btn-warning
                      @elseif($dt->status == 'diambil') btn btn-sm badge-success
                      @endif">{{ucfirst ($dt->status) }}
                    </span>
                  </td>
                    <td>{{ ucwords (str_replace( "_", " ", $dt->dibayar)) ?? "-" }}</td>
                    <td>{{ $dt->user->nama ?? "-"}} ({{ $dt->user->id  ?? "-"}})</td>
                    <td>
                      <div class="btn-group">
                        <a href="/transaksi/detail/{{ $dt->id }}" class="btn btn-sm btn-info mr-2"><i class="fa-solid fa-circle-info"></i> Detail</a>
                        @can('admin')          
                        <a href="/transaksi/ubah/{{ $dt->id }}" class="btn btn-sm btn-success mr-2">
                          <i class="fa-solid fa-edit"></i> Ubah
                        </a>
                        <form action="/transaksi/delete/{{ $dt->id }}" method="GET" class="form-tdelete" data-name="{{ $dt->nama }}">
                          <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</button>
                        </form>
                        @endcan
                      </div>
                  </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->
@endsection