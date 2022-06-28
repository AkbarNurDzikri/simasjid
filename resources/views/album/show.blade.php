@extends('dashboard-admin')
@section('content')
    <div class="container-fluid" style="margin-top: -20px; margin-bottom: 10px;">
        <h3><button class="btn btn-outline-primary" data-toggle="modal" data-target="#createModal"><i class="fas fa-plus"></i> Tambah Photo</button></h3>
    </div>
    <div class="container-fluid">
        <div class="row">
            @foreach ($data as $d)
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-title">
                            <h5 class="text-center" style="margin: 5px 0 -5px 0;">{{ $d->nama_foto }}</h5>
                            <p class="text-muted text-center" style="margin-bottom: -10px;"><i>{{ $d->nama_album }}</i></p>
                            <hr>
                        </div>
                        <div class="card-body text-center">
                            <img src="{{ asset('storage/' . $d->foto_album) }}" alt="cover-album" class="w-50 card-img-top" style="margin-top: -30px;">
                            <p class="card-text text-muted lead" style="margin-bottom: -30px;">{{ $d->deskripsi_foto }}</p>
                        </div>
                        <hr>
                        <div class="card-footer text-center" style="margin-top: -15px;">
                            <a href="#" class="badge bg-primary btn-primary" data-toggle="modal" data-target="#zoomModal{{ $d->id }}"><i class="fas fa-search-plus"></i> Zoom</a>
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
                    <h5 class="modal-title" id="createModalLabel">Form Tambah Photo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('photo-album.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="album_id" value="{{ $album_id }}">

                        <div class="row">
                            <div class="col-sm mb-2">
                                <label for="nama_foto" class="form-lab">Nama Foto</label>
                                <input type="text" class="form-control" id="nama_foto" name="nama_foto" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm mb-2">
                                <label for="foto_album" class="form-label">Foto</label>
                                <input type="file" class="form-control" id="foto_album" name="foto_album" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm mb-2">
                                <label for="deskripsi_foto" class="form-label">Deskripsi Foto</label>
                                <textarea class="form-control" name="deskripsi_foto" id="deskripsi_foto"></textarea>
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
        <div class="modal fade" id="editModal{{ $d->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Form Edit Photo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('photo-album.update', $d->id) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
    
                            <input type="hidden" name="album_id" value="{{ $album_id }}">
    
                            <div class="row">
                                <div class="col-sm mb-2">
                                    <label for="nama_foto" class="form-lab">Nama Foto</label>
                                    <input type="text" class="form-control" id="nama_foto" name="nama_foto" value="{{ $d->nama_foto }}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm mb-2">
                                    <label for="foto_album" class="form-label">Foto</label>
                                    <input type="hidden" name="foto_album_lama" value="{{ $d->foto_album }}">
                                    <input type="file" class="form-control" id="foto_album" name="foto_album">
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm mb-2">
                                    <label for="deskripsi_foto" class="form-label">Deskripsi Foto</label>
                                    <textarea class="form-control" name="deskripsi_foto" id="deskripsi_foto">{{ $d->deskripsi_foto }}</textarea>
                                </div>
                            </div>
                            <img src="{{ asset('storage/' . $d->foto_album) }}" alt="foto_album" class="w-25">
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
    
    <!-- Zoom Modal -->
    @foreach ($data as $d)
        <div class="modal fade" id="zoomModal{{ $d->id }}" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Zoom In</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-title">
                                <h5 class="text-center" style="margin: 5px 0 -5px 0;">{{ $d->nama_foto }}</h5>
                                <p class="text-muted text-center" style="margin-bottom: -10px;"><i>{{ $d->nama_album }}</i></p>
                                <hr>
                            </div>
                            <div class="card-body text-center">
                                <img src="{{ asset('storage/' . $d->foto_album) }}" alt="cover-album" class="w-100 card-img-top">
                                <p class="card-text text-muted lead">{{ $d->deskripsi_foto }}</p>
                            </div>
                            <hr>
                            <div class="card-footer text-center" style="margin-top: -15px;">
                                <a href="#" class="badge bg-primary btn-primary" data-toggle="modal" data-target="#zoomModal"><i class="fas fa-search-plus"></i> Zoom</a>
                                <a href="" class="text-center badge bg-success btn-success" data-toggle="modal" data-target="#editModal{{ $d->id }}"><i class="text-center far fa-edit"></i> Edit</a>
                                <a href="" class="text-center badge bg-danger btn-danger" data-toggle="modal" data-target="#deleteModal{{ $d->id }}"><i class="far fa-trash-alt"></i> Hapus</a>
                            </div>
                        </div>
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
                        <form action="{{ route('photo-album.destroy', $d->id) }}" method="POST">
                            @method('delete')
                            @csrf
                            
                            <div class="card text-center">
                                <div class="card-body">
                                    <h4>Data ini akan dihapus</h4>
                                    <h2>Yakin hapus <b>{{ $d->nama_foto }}</b></h2>
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