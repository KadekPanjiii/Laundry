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
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Transaksi</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="col-12">
                  <form method="get" id="form-filter">
                      <div class="row">
                          <div class="col-6 mb-3">
                              <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                              <input type="datetime-local" step="1" name="tanggal_mulai" id="tanggal_mulai" class="form-control" value="{{ !empty(request()->input('tanggal_mulai')) ? request()->input('tanggal_mulai') : '' }}" placeholder="Tanggal Mulai">
                          </div>
                          <div class="col-6 mb-3">
                              <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                              <input type="datetime-local" step="1" name="tanggal_selesai" id="tanggal_selesai" class="form-control" value="{{ !empty(request()->input('tanggal_selesai')) ? request()->input('tanggal_selesai') : '' }}" placeholder="Tanggal Selesai">
                          </div>
                          <div class="col-6 mb-3">
                              <label for="member" class="form-label">Member</label>
                              <select name="member" id="member" class="form-control">
                                  <option value="{{ null }}" hidden>Pilah berdasarkan Member</option>
                                  @foreach ($data_member as $dm)
                                    <option value="{{ $dm->id }}" {{ !empty(request()->input('member')) && request()->input('member') == $dm->id ? 'selected' : '' }}>{{ $dm->nama }}</option>
                                  @endforeach
                              </select>
                          </div>
                          <div class="col-6 mb-3">
                              <label for="user" class="form-label">User</label>
                              <select name="user" id="user" class="form-control" require>
                                  <option value="{{ null }}" hidden>Pilah berdasarkan User</option>
                                  @foreach ($data_user as $du)
                                    <option value="{{ $du->id }}" {{ !empty(request()->input('user')) && request()->input('user') == $du->id ? 'selected' : '' }}>{{ $du->nama }}</option>
                                  @endforeach
                              </select>
                          </div>
                          <div class="col-12">
                              <div class="mb-3 d-flex justify-content-between">
                                  <button type="submit" class="btn btn-success">Filter</button>
                                  <button type="button" onclick="window.location.href='/transaksi/laporan'" class="btn btn-info">Bersihkan Filter</button>
                              </div>
                          </div>
                      </div>
                  </form>
              </div>
                <div class="col-12">
                  <table id="tableTransaksi" class="table table-hover table-striped">
                    <thead>
                    <tr>
                      <th style="width: 1%;">#</th>
                      <th>ID Transaksi</th>
                      <th>Kode Invoice</th>
                      <th>Tanggal</th>
                      <th>Status</th>
                      <th>Dibayar</th>
                      <th>Total</th>
                      <th style="width: 6%;">User ID</th>
                      <th style="width: 16%;">Member ID</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $totalHarga = 0; @endphp
                    @foreach ($data_transaksi as $dt)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $dt->id  ?? "-"}}</td>
                      <td>{{ $dt->kode_invoice ?? "-"}}</td>
                      <td>{{ empty ($dt->tgl) ? "-" : date("l, d F Y H:i:s", strtotime($dt->tgl)) }}</td>
                      <td>{{ucfirst ($dt->status) }}</td>
                      <td>{{ ucwords (str_replace( "_", " ", $dt->dibayar)) ?? "-" }}</td>
                      <td><span data-harga="{{ $dt->harga }}">Rp. {{ number_format($dt->total_tagihan) }}</span></td>
                      <td>{{ $dt->user->nama ?? "-"}} ({{ $dt->user->id  ?? "-"}})</td>
                      <td>{{ $dt->member->nama ?? "-"}} ({{ $dt->member->id  ?? "-"}})</td>
                    </tr>
                    @php $totalHarga += $dt->total_tagihan  @endphp
                    @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th>Total:</th>
                          <th>Rp. {{ number_format($totalHarga) }}</th>
                          <th></th>
                          <th></th>
                      </tr>
                    </tfoot>
                    </table>  
                </div>
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
<script src="/assets/plugins/jquery/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    let table = $('#tableTransaksi').DataTable({
      responsive: true,
      paging: false,
      dom: '<"row"<"col-md-6"B><"col-md-6 text-right"f>>rtip',
      buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
      ]
    });
    
     // Untuk merapikan URL
// Untuk merapikan URL
$("#form-filter").on("submit", function(event) {
    event.preventDefault();

    let tanggal_mulai = $("#tanggal_mulai").val();
    let tanggal_selesai = $("#tanggal_selesai").val();
    let user = $("#user").val(); // Ubah ID menjadi tb_user
    let member = $("#member").val(); // Ubah ID menjadi tb_member
    let url = "/transaksi/laporan";
    let parameters = [];

    if (tanggal_mulai) {
        parameters.push("tanggal_mulai=" + encodeURIComponent(tanggal_mulai));
    }
    if (tanggal_selesai) {
        parameters.push("tanggal_selesai=" + encodeURIComponent(tanggal_selesai));
    }
    if (user) {
        parameters.push("user=" + encodeURIComponent(user)); // Ubah menjadi tb_user
    }
    if (member) {
        parameters.push("member=" + encodeURIComponent(member)); // Ubah menjadi tb_member
    }
    if (parameters.length > 0) {
        url += "?" + parameters.join("&");
    }

    window.location.href = url;
});


  })
</script>
@endsection
