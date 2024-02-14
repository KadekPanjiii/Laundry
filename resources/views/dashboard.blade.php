@extends('layouts.main')

@section('container')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
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
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-gradient-lightblue">
              <div class="inner">
                <h3>{{ $totalTransaksi }}</h3>

                <p>Total Transaksi</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="/transaksi" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-gradient-maroon">
              <div class="inner">
                <h3>{{ $totalTransaksiHariIni }}</h3>

                <p>Transaksi Hari Ini</p>
              </div>
              <div class="icon">
                <i class="ion ion-heart"></i>
              </div>
              <a href="/transaksi" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-gradient-orange" style="color: white !important">
              <div class="inner">
                <h3>{{ $totalMember }}</h3>

                <p>Total Member</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-stalker"></i>
              </div>
              <a href="/member" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          @php
              $totalHarga = 0;
          @endphp

          @foreach($totalPendapatan as $transaksi)
              @php
                  $totalHarga += $transaksi->total_tagihan;
              @endphp
          @endforeach

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-gradient-olive">
              <div class="inner">
                <h3>Rp. {{ number_format($totalHarga) }}</h3>

                <p>Total Pendapatan</p>
              </div>
              <div class="icon">
                <i class="ion ion-cash"></i>
              </div>
              <a href="/transaksi/laporan" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>&copy; 2024 Kapan Laundry.</strong>
    Hak Cipta Dilindungi.
    <div class="float-right d-none d-sm-inline-block">
      <a href="https://github.com/KadekPanjiii/" target="_blank"><i class="fab fa-github"></i> GitHub</a>
      <a href="https://instagram.com/kadekpanjiii_" target="_blank"><i class="fab fa-instagram ml-2"></i> Instagram</a>
    </div>
  </footer>
</div>
<!-- ./wrapper -->
@endsection