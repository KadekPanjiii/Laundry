@extends('layouts.main')

@section('container')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $title }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div><!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="card-title mb-0">Data {{ $title }}</h3>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                                    Tambah {{ $title }}
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <table id="example1" class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 1%;">#</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Role</th>
                                        <th>Outlet</th>
                                        <th style="width: 12%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_user as $du)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $du->nama ?? "-" }}</td>
                                        <td>{{ $du->username ?? "-" }}</td>
                                        <td>{{ $du->role ?? "-" }}</td>
                                        <td>{{ $du->outlet->nama ?? "-" }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="#modal-edit{{ $du->id }}" class="btn btn-sm btn-success mr-2" data-toggle="modal">
                                                    <i class="fa-solid fa-edit"></i> Ubah
                                                </a>
                                                <form action="/user/delete/{{ $du->id }}" method="GET" class="form-delete" data-name="{{ $du->nama }}">
                                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div><!-- /.card-body -->
                    </div>
                </div><!-- /.col-lg-12 -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div><!-- /.content -->
</div><!-- /.content-wrapper -->

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah {{ $title }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/user/create" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Masukkan Username" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Masukkan Password" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Outlet</label>
                        <select class="form-control" name="outlet" required>
                            <option value="" hidden>Pilih Outlet</option>
                            @foreach ($data_outlet as $do)
                                <option value="{{ $do->id }}">{{ $do->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Role</label>
                        <select class="form-control" name="role" required>
                            <option value="" hidden>Pilih Role</option>
                            <option value="admin">Admin</option>
                            <option value="kasir">Kasir</option>
                            <option value="owner">Owner</option>
                        </select>
                    </div>
                </div><!-- /.modal-body -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal fade -->

@foreach ($data_user as $du)
<div class="modal fade" id="modal-edit{{ $du->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubah {{ $title }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/user/update/{{ $du->id }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama" value="{{ $du->nama }}" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Masukkan Username" value="{{ $du->username }}" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Masukkan Password" value="{{ $du->password }}" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Outlet</label>
                        <select class="form-control" name="outlet" required>
                            <option value="" hidden>Pilih Outlet</option>
                            @foreach ($data_outlet as $do)
                                <option value="{{ $do->id }}" {{ $du->id_outlet === $do->id ? "selected" : "" }}>{{ $do->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Role</label>
                        <select class="form-control" name="role" required>
                            <option <?php if($du['role']=='admin') echo "selected";?> value="admin">Admin</option>
                            <option <?php if($du['role']=='kasir') echo "selected";?> value="kasir">Kasir</option>
                            <option <?php if($du['role']=='owner') echo "selected";?> value="owner">Owner</option>
                        </select>
                    </div>
                </div><!-- /.modal-body -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal fade -->
@endforeach

@endsection
