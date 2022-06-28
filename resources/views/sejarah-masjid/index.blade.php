@extends('dashboard-admin')
@section('content')
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="view-tab" data-toggle="tab" href="#view" role="tab" aria-controls="view" aria-selected="true">View</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="update-tab" data-toggle="tab" href="#update" role="tab" aria-controls="update" aria-selected="false">Update Data</a>
        </li>
        @if ($data == null)
            <li class="nav-item" role="presentation">
                <a href="#" class="nav-link" data-toggle="modal" data-target="#createModal">Create</a>
            </li>
        @endif
    </ul>
  <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="view" role="tabpanel" aria-labelledby="view-tab">
            <div class="container-fluid">
                @if ($data)
                    <div class="card card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <img src="{{ asset('storage/' . $data->foto_masjid) }}" alt="foto-masjid" class="w-100">
                            </div>
                            <div class="col-lg-6 mt-5">
                                <table border="0">
                                    <tr>
                                        <td colspan="2" class="text-center"><h3>Masjid {{ $data->nama_masjid }}</h3></td>
                                    </tr>
                                    <tr class="mt-3">
                                        <td><i class="fas fa-map-marker-alt text-danger"></i> Alamat</td>
                                        <td>: {{ $data->alamat_masjid }}</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-phone text-primary"></i> Kontak Center</td>
                                        <td>: {{ $data->call_center }}</td>
                                    </tr>
                                    <tr>
                                        <td><i class="far fa-square text-primary"></i> Luas Tanah</td>
                                        <td>: {{ $data->luas_tanah }} M</td>
                                    </tr>
                                    <tr>
                                        <td><i class="far fa-building"></i> Luas Bangunan</td>
                                        <td>: {{ $data->luas_bangunan }} M</td>
                                    </tr>
                                    <tr>
                                        <td><i class="far fa-calendar-check"></i> Tanggal Berdiri</td>
                                        <td>: {{ date('d M Y', strtotime($data->tahun_berdiri)) }}</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-file-signature"></i> Legalitas</td>
                                        <td>: {{ $data->legalitas }}
                                    </tr>
                                    <tr>
                                        <td colspan="2"><hr></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><p>{!! $data->keterangan_sejarah !!}</p></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        
        <div class="tab-pane fade" id="update" role="tabpanel" aria-labelledby="update-tab">
            <div class="container-fluid table-responsive">
                @if ($data)
                    <table class="table">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('sejarah-masjid.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <div class="col-sm mb-2">
                                            <label class="form-label">Foto Masjid</label> <br>
                                            <input type="file" class="form-control" name="foto_masjid">
                                            <img src="{{ asset('storage/' . $data->foto_masjid) }}" alt="foto-masjid" class="w-25">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm mb-2">
                                            <label for="nama_masjid" class="form-label">Nama Masjid</label>
                                            <input type="text" class="form-control" id="nama_masjid" name="nama_masjid" value="{{ $data->nama_masjid }}" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm mb-2">
                                            <label for="alamat_masjid" class="form-label">Alamat Masjid</label>
                                            <textarea class="form-control" name="alamat_masjid" id="alamat_masjid" required>{{ $data->alamat_masjid }}</textarea>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm mb-2">
                                            <label for="call_center" class="form-label">Call Center</label>
                                            <input type="text" class="form-control" id="call_center" name="call_center" value="{{ $data->call_center }}" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm mb-2">
                                            <label for="luas_tanah" class="form-label">Luas Tanah</label>
                                            <input type="text" class="form-control" id="luas_tanah" name="luas_tanah" value="{{ $data->luas_tanah }}" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm mb-2">
                                            <label for="luas_bangunan" class="form-label">Luas Bangunan</label>
                                            <input type="text" class="form-control" id="luas_bangunan" name="luas_bangunan" value="{{ $data->luas_bangunan }}" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm mb-2">
                                            <label for="tahun_berdiri" class="form-label">Tanggal Berdiri</label>
                                            <input type="date" class="form-control" id="tahun_berdiri" name="tahun_berdiri" value="{{ $data->tahun_berdiri }}" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm mb-2">
                                            <label for="legalitas" class="form-label">Legalitas</label>
                                            <input type="text" class="form-control" id="legalitas" name="legalitas" value="{{ $data->legalitas }}" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm mb-2">
                                            <label for="keterangan_sejarah" class="form-label">Sejarah Masjid</label>
                                            <input type="hidden" id="keterangan_sejarah" name="keterangan_sejarah">
                                            <trix-editor input="keterangan_sejarah">{!! $data->keterangan_sejarah !!}</trix-editor>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col sm mb-2">
                                            <button class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </table>
                @endif
            </div>
        </div>
    </div>

  <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Form Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('sejarah-masjid.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-sm mb-2">
                                <label for="foto_masjid" class="form-la">Foto Masjid</label>
                                <input type="file" class="form-control" id="foto_masjid" name="foto_masjid" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm mb-2">
                                <label for="nama_masjid" class="form-label">Nama Masjid</label>
                                <input type="text" class="form-control" id="nama_masjid" name="nama_masjid" value="" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm mb-2">
                                <label for="alamat_masjid" class="form-label">Alamat Masjid</label>
                                <textarea class="form-control" name="alamat_masjid" id="alamat_masjid" required></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm mb-2">
                                <label for="call_center" class="form-label">Call Center</label>
                                <input type="text" class="form-control" id="call_center" name="call_center" value="" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm mb-2">
                                <label for="luas_tanah" class="form-label">Luas Tanah</label>
                                <input type="text" class="form-control" id="luas_tanah" name="luas_tanah" value="" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm mb-2">
                                <label for="luas_bangunan" class="form-label">Luas Bangunan</label>
                                <input type="text" class="form-control" id="luas_bangunan" name="luas_bangunan" value="" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm mb-2">
                                <label for="tahun_berdiri" class="form-label">Tahun Berdiri</label>
                                <input type="date" class="form-control" id="tahun_berdiri" name="tahun_berdiri" value="" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm mb-2">
                                <label for="legalitas" class="form-label">Legalitas</label>
                                <input type="text" class="form-control" id="legalitas" name="legalitas" value="" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm mb-2">
                                <label for="keterangan_sejarah" class="form-label">Sejarah Masjid</label>
                                <input type="hidden" id="x" name="keterangan_sejarah">
                                <trix-editor input="x"></trix-editor>
                            </div>
                        </div>

                        <div class="modal-footer row">
                            <div class="col sm mb-2">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection