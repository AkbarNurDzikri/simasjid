@extends('dashboard-admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><a href="#" class="btn btn-outline-primary" data-toggle="modal" data-target="#formModal"><i class="fas fa-plus"></i> Tambah Notulen</a> </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive">
            <table id="example1" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Judul Notulen</th>
                        <th class="text-center">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @foreach ($data as $d)
                        <tr>
                            <td class="text-center">{{ $i++ }}</td>
                            <td class="text-center">{{ date('d M Y', strtotime($d->tgl_rapat)) }}</td>
                            <td class="text-center">{{ $d->judul_notulen }}</td>                            
                            <td class="text-center">
                                <a href="" class="badge bg-primary" data-toggle="modal" data-target="#showModal{{ $d->id }}"><i class="far fa-eye"></i> Detail</a>
                                <a href="" class="badge bg-success" data-toggle="modal" data-target="#editModal{{ $d->id }}"><i class="far fa-edit"></i> Edit</a>
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
                    <form action="{{ route('notulen.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-sm mb-2">
                                <label for="tgl_rapat" class="form-label">Tanggal Rapat</label>
                                <input type="date" class="form-control" id="tgl_rapat" name="tgl_rapat" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm mb-2">
                                <label class="form-label" id="judul_notulen">Judul Notulen</label>
                                <input type="text" class="form-control" id="judul_notulen" name="judul_notulen" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm mb-2">
                                <label for="isi_notulen" class="form-label">Isi Notulen</label>
                                <input type="hidden" id="x" name="isi_notulen">
                                <trix-editor input="x"></trix-editor>
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
            <div class="modal-dialog  modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Form Edit Notulen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('notulen.update', $d->id) }}" method="POST">
                            @method('PUT')
                            @csrf
    
                            <div class="row">
                                <div class="col-sm mb-2">
                                    <label class="form-label" id="tgl_rapat">Judul Notulen</label>
                                    <input type="date" class="form-control" id="tgl_rapat" name="tgl_rapat" value="{{ $d->tgl_rapat }}" required>
                                </div>
                            </div>
    
                            <div class="row">
                                <div class="col-sm mb-2">
                                    <label class="form-label" id="judul_notulen">Judul Notulen</label>
                                    <input type="text" class="form-control" id="judul_notulen" name="judul_notulen" value="{{ $d->judul_notulen }}" required>
                                </div>
                            </div>
    
                            <div class="row">
                                <div class="col-sm mb-2">
                                    <label for="isi_notulen" class="form-label">Isi Notulen</label>
                                    <input type="hidden" name="isi_notulen_lama" value="{{ $d->isi_notulen }}">
                                    <input type="hidden" id="isi_notulen" name="isi_notulen">
                                    <trix-editor input="isi_notulen">{!! $d->isi_notulen !!}</trix-editor>
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
                        <form action="{{ route('notulen.destroy', $d->id) }}" method="POST">
                            @method('delete')
                            @csrf
                            
                            <div class="card text-center">
                                <div class="card-body">
                                    <h4>Data ini akan dihapus</h4>
                                    <h2>Yakin hapus <b>{{ $d->judul_notulen }}</b></h2>
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

    <!-- Modal Show -->
    @foreach ($data as $d)
        <div class="modal fade" id="showModal{{ $d->id }}" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog  modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Show Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card card-body table-striped">
                            <table border="0">
                                <tr>
                                    <td><b>Judul Rapat</b></td>
                                    <td><span class="align-middle"><b>{{ $d->judul_notulen }}</b></span></td>
                                </tr>
                                <tr>
                                    <td><b>Tanggal Rapat</b></td>
                                    <td><span class="align-middle">{{ $d->tgl_rapat }}</span></td>
                                </tr>
                                <tr>
                                    <td><b>Isi Rapat</b></td>
                                    <td><span class="align-middle">{!! $d->isi_notulen !!}</span></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection