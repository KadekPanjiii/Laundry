@extends('layouts.main')

@section('container')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $title }}</h1>
                </div>
            </div>
        </div>
    </div>

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
                                        <th>Nama Member</th>
                                        <th>Alamat Member</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Nomor Telepon</th>
                                        <th style="width: 16%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_member as $dm)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $dm->nama ?? "-" }}</td>
                                        <td>{{ $dm->alamat ?? "-" }}</td>
                                        <td>{{ $dm->jenis_kelamin === "L" ? "Laki-laki" : ($dm->jenis_kelamin === "P" ? "Perempuan" : "-") }}</td>
                                        <td>{{ $dm->tlp ?? "-" }}</td>
                                        <td>
                                            <div class="btn-group">
                                                @can('admin')
                                                <a href="#modal-edit{{ $dm->id }}" class="btn btn-sm btn-success mr-2" data-toggle="modal">
                                                    <i class="fa-solid fa-edit"></i> Ubah
                                                </a>
                                                <form action="/member/delete/{{ $dm->id }}" method="GET" class="form-delete" data-name="{{ $dm->nama }}">
                                                    <button type="submit" class="btn btn-sm btn-danger mr-2"><i class="fa fa-trash"></i> Hapus</button>
                                                </form>
                                                @endcan
                                                <a href="https://wa.me/{{ $dm->tlp }}?text=Selamat!%20Anda%20telah%20resmi%20bergabung%20sebagai%20anggota%20di%20Laundry%20kami.%20Nikmati%20beragam%20keuntungan%20eksklusif,%20penawaran%20istimewa,%20dan%20pengalaman%20berbelanja%20yang%20lebih%20menyenangkan%20bersama%20kami.%20Terima%20kasih%20atas%20kepercayaan%20Anda!" class="btn btn-sm btn-info" target="_blank">
                                                    <i class="fa-brands fa-whatsapp"></i> Chat
                                                </a>                                                
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah {{ $title }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/member/create" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label">Nama Member</label>
                        <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Member" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Alamat</label>
                        <textarea class="form-control" name="alamat" placeholder="Masukkan Alamat Member" rows="3" required></textarea>
                    </div>
                    <div class="form-group ml-1">
                        <label>Pilih Jenis Kelamin</label><br>
                        <input type="radio" class="form-check form-check-inline" name="jk" value="L">Laki - laki
                        <input type="radio" class="ml-3 form-check form-check-inline" name="jk" value="P">Perempuan
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

@foreach ($data_member as $dm)
<div class="modal fade" id="modal-edit{{ $dm->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubah {{ $title }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/member/update/{{ $dm->id }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label">Nama Member</label>
                        <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Member" value="{{ $dm->nama }}" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Alamat</label>
                        <textarea class="form-control" name="alamat" placeholder="Masukkan Alamat Member" rows="3" required>{{ $dm->alamat }}</textarea>
                    </div>
                    <div class="form-group ml-1">
                        <label>Pilih Jenis Kelamin</label><br>
                        <input type="radio" class="form-check form-check-inline" name="jk" value="L" {{ $dm->jenis_kelamin == 'L' ? 'checked' : '' }}>Laki - laki
                        <input type="radio" class="ml-3 form-check form-check-inline" name="jk" value="P" {{ $dm->jenis_kelamin == 'P' ? 'checked' : '' }}>Perempuan
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">No Telepon</label>
                        <input type="text" class="form-control" name="tlp" placeholder="Masukkan No. Telepon" value="{{ $dm->tlp }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Ubah</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endforeach

@endsection
