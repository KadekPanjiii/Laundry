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
          <div class="col-lg-12 ">
            <div class="card">
              <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Data {{ $title }}</h3>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                        Tambah {{ $title }}
                    </button>
                </div>
            </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-hover table-striped">
                  <thead>
                  <tr>
                    <th style="width: 1%;">#</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No Telepon</th>
                    <th style="width: 12%;">Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($data_outlet as $do)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $do->nama ?? "-" }}</td>
                    <td>{{ $do->alamat ?? "-" }}</td>
                    <td>{{ $do->tlp ?? "-" }}</td>
                    <td>
                      <div class="btn-group">
                        <a href="#modal-edit{{ $do->id }}" class="btn btn-sm btn-success mr-2" data-toggle="modal">
                          <i class="fa-solid fa-edit"></i> Ubah
                        </a>
                        <form action="/outlet/delete/{{ $do->id  }}" method="GET" class="form-delete" data-name="{{ $do->nama }}">
                          <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</button>
                        </form>
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

<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah {{ $title }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/outlet/create" method="POST">
      @csrf
      <div class="modal-body">
          <div class="form-group">
            <label class="col-form-label">Nama Outlet</label>
            <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Outlet" required>
          </div>
          <div class="form-group">
            <label class="col-form-label">Alamat</label>
            <textarea class="form-control" name="alamat" placeholder="Masukkan Alamat Outlet" rows="3" required></textarea>
          </div>
          <div class="form-group">
            <label class="col-form-label">No Telepon</label>
            <input type="text" class="form-control" name="tlp" placeholder="Masukkan No. Telepon" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Tambah</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

@foreach ($data_outlet as $do)
<div class="modal fade" id="modal-edit{{ $do->id }}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Ubah {{ $title }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/outlet/update/{{ $do->id }}" method="POST">
      @csrf
      <div class="modal-body">
          <div class="form-group">
            <label class="col-form-label">Nama Outlet</label>
            <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Outlet" value="{{ $do->nama ?? "-" }}" required>
          </div>
          <div class="form-group">
            <label class="col-form-label">Alamat</label>
            <textarea class="form-control" name="alamat" placeholder="Masukkan Alamat Outlet" rows="3" required>{{ $do->alamat ?? "-" }}</textarea>
          </div>
          <div class="form-group">
            <label class="col-form-label">No Telepon</label>
            <input type="text" class="form-control" name="tlp" placeholder="Masukkan No. Telepon" value="{{ $do->tlp ?? "-" }}" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
@endforeach
<!-- /.modal -->
@endsection
