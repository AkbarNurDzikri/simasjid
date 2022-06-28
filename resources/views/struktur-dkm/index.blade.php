@extends('dashboard-admin')
@section('content')
    <div class="card">
        <div class="card-header">
        <h3 class="card-title"><button class="btn btn-outline-primary" data-toggle="modal" data-target="#formModal"><i class="fas fa-plus"></i> Tambah Anggota DKM</button></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive">
        <table id="example1" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Pengurus</th>
                    <th>Jabatan</th>
                    <th>Tupoksi</th>
                    <th>Periode Mulai Jabatan</th>
                    <th>Periode Selesai Jabatan</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach ($data as $d)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $d->nama_jamaah }}</td>
                        <td>{{ $d->jabatan }}</td>
                        <td>{{ $d->tupoksi }}</td>
                        <td>{{ date('d M Y', strtotime($d->periode_mulai)) }}</td>
                        <td>{{ date('d M Y', strtotime($d->periode_selesai)) }}</td>
                        <td>
                            <a href="" class="badge bg-success" data-toggle="modal" data-target="#editModal{{ $d->id }}"><i class="fas fa-edit"></i> Edit</a>
                            <a href="" class="badge bg-danger" data-toggle="modal" data-target="#deleteModal{{ $d->id }}"><i class="fas fa-trash-alt"></i> Hapus</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

    <!-- Modal Insert -->
    <div class="modal fade" id="formModal" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Form Tambah Anggota DKM</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('struktur-dkm.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-sm mb-2">
                                <label class="form-label">Nama Anggota</label>
                                <select name="pengurus_id" class="form-control select2" style="width: 100%" required>
                                    <option value="" disabled selected>Pilih Anggota</option>
                                    @foreach ($jamaah as $j)
                                        <option value="{{ $j->id }}">{{ $j->nama_jamaah }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm mb-2">
                                <label for="jabatan" class="form-label">Jabatan</label>
                                <input type="text" class="form-control" name="jabatan" id="jabatan" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm mb-2">
                                <label for="tupoksi" class="form-label">Tupoksi</label>
                                <textarea name="tupoksi" id="tupoksi" class="form-control" required></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <label for="periode_mulai" class="form-label">Periode Mulai</label>
                                <input type="date" class="form-control" name="periode_mulai" id="periode_mulai" required>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <label for="periode_selesai" class="form-label">Periode Selesai</label>
                                <input type="date" class="form-control" name="periode_selesai" id="periode_selesai" required>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    @foreach ($data as $d)
        <div class="modal fade" id="editModal{{ $d->id }}" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Form Edit Data Anggota DKM</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('struktur-dkm.update',  $d->id) }}" method="POST">
                            @method('PUT')
                            @csrf

                            <div class="row">
                                <div class="col-sm mb-2">
                                    <label class="form-label">Nama Anggota</label>
                                    <select name="pengurus_id" class="form-control js-example-basic-single" style="width: 100%" required>
                                        <option value="{{ $d->pengurus_id }}">{{ $d->nama_jamaah }}</option>
                                        <option value="" disabled>Pilih Anggota</option>
                                        @foreach ($jamaah as $j)
                                            <option value="{{ $j->id }}">{{ $j->nama_jamaah }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm mb-2">
                                    <label for="jabatan" class="form-label">Jabatan</label>
                                    <input type="text" class="form-control" name="jabatan" id="jabatan" value="{{ $d->jabatan }}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm mb-2">
                                    <label for="tupoksi" class="form-label">Tupoksi</label>
                                    <textarea name="tupoksi" id="tupoksi" class="form-control">{{ $d->tupoksi }}</textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 mb-2">
                                    <label for="periode_mulai" class="form-label">Periode Mulai</label>
                                    <input type="date" class="form-control" name="periode_mulai" id="periode_mulai" value="{{ $d->periode_mulai }}" required>
                                </div>
                                <div class="col-sm-6 mb-2">
                                    <label for="periode_selesai" class="form-label">Periode Selesai</label>
                                    <input type="date" class="form-control" name="periode_selesai" id="periode_selesai" value="{{ $d->periode_selesai }}" required>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal Delete -->
    @foreach ($data as $d)
        <div class="modal fade" id="deleteModal{{ $d->id }}" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('struktur-dkm.destroy', $d->id) }}" method="POST">
                            @method('delete')
                            @csrf
                            
                            <div class="card text-center">
                                <div class="card-body">
                                    <h4>Data ini akan dihapus</h4>
                                    <h2>Anda yakin menghapus <b>{{ $d->nama_jamaah }}</b></h2>
                                    <i class="fas fa-question text-danger fa-5x"></i>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger">Ya</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection