@extends('dashboard-admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><a href="#" class="btn btn-outline-primary" data-toggle="modal" data-target="#formModal"><i class="fas fa-plus"></i> Tambah Role</a> </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive">
            <table id="example1" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Role</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @foreach ($data as $d)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $d->nama_role }}</td>
                            
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
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Form Tambah Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('role.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-sm mb-2">
                                <label for="nama_role" class="form-label">Nama Role</label>
                                <input type="text" class="form-control" id="nama_role" name="nama_role" required>
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
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Form Edit Role</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('role.update',  $d->id) }}" method="POST">
                            @method('PUT')
                            @csrf

                            <div class="row">
                                <div class="col-sm mb-2">
                                    <label for="nama_role" class="form-label">Nama Role</label>
                                    <input type="text" class="form-control" id="nam_role" name="nama_role" value="{{ $d->nama_role }}" required>
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
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('role.destroy', $d->id) }}" method="POST">
                            @method('delete')
                            @csrf
                            
                            <div class="card text-center">
                                <div class="card-body">
                                    <h4>Data ini akan dihapus</h4>
                                    <h2>Yakin hapus <b>{{ $d->nama_role }}</b></h2>
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