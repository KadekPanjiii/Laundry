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
                      <th>Nama Paket</th>
                      <th>Jenis Paket</th>
                      <th>Harga Paket</th>
                      <th style="width: 12%;">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data_paket as $dp)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $dp->nama_paket ?? "-" }}</td>
                      <td>{{ ucwords(str_replace("_", " ", $dp->jenis)) ?? "-" }}</td>
                      <td>Rp. {{ number_format($dp->harga) ?? "-" }}</td>
                      <td>
                        <div class="btn-group">
                          <a href="#modal-edit{{ $dp->id }}" class="btn btn-sm btn-success mr-2" data-toggle="modal">
                            <i class="fa-solid fa-edit"></i> Ubah
                          </a>
                          <form action="/paket/delete/{{ $dp->id }}" method="GET" class="form-delete" data-name="{{ $dp->nama_paket }}">
                            <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</button>
                          </form>
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
        <form action="/paket/create" method="POST">
          @csrf
          <div class="modal-body">
            <div class="form-group">
              <label class="col-form-label">Nama Paket</label>
              <input type="text" class="form-control" name="nama_paket" placeholder="Masukkan Nama Paket" required>
            </div>
            <div class="form-group">
              <label class="col-form-label">Jenis Paket</label>
              <select name="jenis" class="form-control" required>
                <option value="" hidden>Pilih Jenis Paket</option>
                <option value="kiloan">Kiloan</option>
                <option value="selimut">Selimut</option>
                <option value="bed_cover">Bed Cover</option>
                <option value="kaos">Kaos</option>
                <option value="lain">Lain - lain</option>
              </select>
            </div>
            <div class="form-group">
              <label class="col-form-label">Harga Paket</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend"><span class="input-group-text">Rp</span></div>
                <input type="number" class="form-control" name="harga" placeholder="Masukkan Harga" required>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  @foreach ($data_paket as $dp)
  <div class="modal fade" id="modal-edit{{ $dp->id }}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Ubah {{ $title }}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/paket/update/{{ $dp->id }}" method="POST">
          @csrf
          <div class="modal-body">
            <div class="form-group">
              <label class="col-form-label">Nama Paket</label>
              <input type="text" class="form-control" name="nama_paket" placeholder="Masukkan Nama Paket" value="{{ $dp->nama_paket }}" required>
            </div>
            <div class="form-group">
              <label class="col-form-label">Jenis Paket</label>
              <select name="jenis" class="form-control" required>
                <option value="kiloan" {{ $dp->jenis == 'kiloan' ? 'selected' : '' }}>Kiloan</option>
                <option value="selimut" {{ $dp->jenis == 'selimut' ? 'selected' : '' }}>Selimut</option>
                <option value="bed_cover" {{ $dp->jenis == 'bed_cover' ? 'selected' : '' }}>Bed Cover</option>
                <option value="kaos" {{ $dp->jenis == 'kaos' ? 'selected' : '' }}>Kaos</option>
                <option value="lain" {{ $dp->jenis == 'lain' ? 'selected' : '' }}>Lain - lain</option>
              </select>
            </div>
            <div class="form-group">
              <label class="col-form-label">Harga Paket</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend"><span class="input-group-text">Rp</span></div>
                <input type="number" class="form-control" name="harga" placeholder="Masukkan Harga" value="{{ $dp->harga }}" required>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Ubah</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  @endforeach

@endsection
