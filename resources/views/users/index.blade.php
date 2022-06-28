@extends('dashboard-admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><a href="#" class="btn btn-outline-primary" data-toggle="modal" data-target="#formModal"><i class="fas fa-plus"></i> Tambah User</a> </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive">
            <table id="example1" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Anggota</th>
                        <th>Username</th>
                        <th>Hak Akses</th>
                        <th>Status Keanggotaan</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @foreach ($data as $d)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $d->nama_jamaah }}</td>
                            <td>{{ $d->username }}</td>
                            <td>{{ $d->nama_role }}</td>
                            <td>@if ($d->active == 1)
                                Aktif
                            @else
                                Non Aktif
                            @endif</td>
                            
                            <td>
                                @if ($d->active == 1)
                                    <a href="" class="badge bg-primary" data-toggle="modal" data-target="#editModal{{ $d->id }}"><i class="fas fa-toggle-on"></i> Off</a>
                                @else
                                    <a href="" class="badge bg-dark" data-toggle="modal" data-target="#editModal{{ $d->id }}"><i class="fas fa-toggle-off"></i> On</a>
                                @endif
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
                    <h5 class="modal-title" id="formModalLabel">Form Tambah User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-sm mb-2">
                                <label class="form-label">Nama Anggota DKM</label>
                                <select name="user_id" class="form-control select2" style="width: 100%" required>
                                    <option value="" disabled selected>Pilih Anggota</option>
                                    @foreach ($anggota as $a)
                                        <option value="{{ $a->id }}">{{$a->nama_jamaah}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm mb-2">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm mb-2">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm mb-2">
                                <label class="form-label">Hak Akses</label>
                                <select name="role_id" id="role_id" class="form-control">
                                    <option value="" disabled selected>Pilih Hak Akses</option>
                                    @foreach ($role as $r)
                                        <option value="{{ $r->id }}">{{ $r->nama_role }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm mb-2">
                                <label id="active" class="form-label">Status Keanggotaan</label>
                                <select name="active" id="active" class="form-control">
                                    <option value="" disabled>Pilih Status</option>
                                    <option value="1">Aktif</option>
                                    <option value="0">Non Aktif</option>
                                </select>
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
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Konfirmasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('users.update',  $d->id) }}" method="POST">
                            @method('PUT')
                            @csrf

                            
                            <input type="hidden" name="user_id" value="{{ $d->user_id }}">
                            <input type="hidden" name="username" value="{{ $d->username }}">
                            <input type="hidden" name="password" value="{{ $d->password }}">
                            <input type="hidden" name="role_id" value="{{ $d->role_id }}">
                            @if ($d->active == 0)
                                <input type="hidden" name="active" value="1">
                            @else
                                <input type="hidden" name="active" value="0">
                            @endif

                            <div class="card text-center">
                                <div class="card-body">
                                    @if ($d->active == 0)
                                        <h2>Aktifkan user <b>{{ $d->nama_jamaah }}</b></h2>
                                    @else
                                        <h2>Nonaktifkan user <b>{{ $d->nama_jamaah }}</b></h2>
                                    @endif
                                    <i class="fas fa-question text-danger fa-5x"></i>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Ya</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal Delete -->
    @foreach ($data as $d)
        <div class="modal fade" id="deleteModal{{ $d->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Konfirmasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('users.destroy', $d->id) }}" method="POST">
                            @method('delete')
                            @csrf
                            
                            <div class="card text-center">
                                <div class="card-body">
                                    <h4>Data ini akan dihapus</h4>
                                    <h2>Yakin hapus <b>{{ $d->nama_jamaah }}</b></h2>
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