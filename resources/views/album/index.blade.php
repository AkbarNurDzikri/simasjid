@extends('dashboard-admin')
@section('content')
    <div class="container-fluid" style="margin-top: -20px; margin-bottom: 10px;">
        <h3><button class="btn btn-outline-primary" data-toggle="modal" data-target="#createModal"><i class="fas fa-plus"></i> Tambah Album</button></h3>
    </div>
    <div class="container-fluid">
        <div class="row">
            @foreach ($data as $d)
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-title">
                            <h5 class="text-center my-3"><a href="{{ route('photo-album.show', $d->id) }}">{{ $d->nama_album }}</a></h5>
                            <hr>
                        </div>
                        <div class="card-body text-center">
                            <img src="{{ asset('storage/' . $d->cover_album) }}" alt="cover-album" class="w-50 card-img-top">
                        </div>
                        <hr>
                        <div class="card-footer text-center" style="margin-top: -15px;">
                            <a href="{{ route('photo-album.show', $d->id) }}" class="badge bg-primary btn-primary"><i class="far fa-eye"></i> Lihat</a>
                            <a href="" class="text-center badge bg-success btn-success" data-toggle="modal" data-target="#editModal{{ $d->id }}"><i class="text-center far fa-edit"></i> Edit</a>
                            <a href="" class="text-center badge bg-danger btn-danger" data-toggle="modal" data-target="#deleteModal{{ $d->id }}"><i class="far fa-trash-alt"></i> Hapus</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Form Tambah Album</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('album.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-sm mb-2">
                                <label for="nama_album" class="form-label">Nama Album</label>
                                <input type="text" class="form-control" id="nama_album" name="nama_album" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm mb-2">
                                <label for="cover_album" class="form-label">Cover Album</label>
                                <input type="file" class="form-control" id="cover_album" name="cover_album" required>
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

    <!-- Edit Modal -->
    @foreach ($data as $d)
        <div class="modal fade" id="editModal{{ $d->id }}" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Form Edit Album</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('album.update', $d->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-sm mb-2">
                                    <label for="nama_album" class="form-label">Nama Album</label>
                                    <input type="text" class="form-control" id="nama_album" name="nama_album" value="{{ $d->nama_album }}" required>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm mb-2">
                                    <label for="cover_album" class="form-label">Cover Album</label>
                                    <input type="hidden" name="cover_album_lama" value="{{ $d->cover_album }}">
                                    <input type="file" class="form-control" id="cover_album" name="cover_album">
                                    <img src="{{ asset('storage/' . $d->cover_album) }}" alt="cover-album" class="w-50 mt-2">
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

    <!-- Delete Modal -->
    @foreach ($data as $d)
        <div class="modal fade" id="deleteModal{{ $d->id }}" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Konfirmasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('album.destroy', $d->id) }}" method="POST">
                            @method('delete')
                            @csrf
                            
                            <div class="card text-center">
                                <div class="card-body">
                                    <h4>Data ini akan dihapus</h4>
                                    <h2>Yakin hapus <b>{{ $d->nama_album }}</b></h2>
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