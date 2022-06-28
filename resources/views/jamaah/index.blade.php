@extends('dashboard-admin')
@section('content')
    <div class="card">
        <div class="card-header">
        <h3 class="card-title"><a href="#" class="btn btn-outline-primary" data-toggle="modal" data-target="#formModal"><i class="fas fa-plus"></i> Tambah Jama'ah</a> </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive">
            <table id="example1" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Lengkap</th>
                        <th>Tempat, tgl lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>No. HP</th>
                        <th>Alamat</th>
                        <th>Status Pernikahan</th>
                        <th>Status Jamaah</th>
                        <th>Status Ekonomi</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @foreach ($data as $d)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $d->nama_jamaah }}</td>
                            <td>{{ $d->tempat_lahir }}, {{ date('d M Y', strtotime($d->tgl_lahir)) }}</td>
                            <td>@if ($d->jenkel == 'L')
                                Laki-laki
                                @else
                                Perempuan
                            @endif</td>
                            <td>{{ $d->no_hp }}</td>
                            <td>{{ $d->alamat_jamaah }}</td>
                            <td>@if ($d->status_nikah == 3)
                                Menikah
                            @elseif($d->status_nikah == 2)
                                Belum Menikah
                            @elseif($d->status_nikah == 1)
                                Duda
                            @else
                                Janda
                            @endif</td>
                            <td>{{ $d->status_jamaah }}</td>
                            <td>@if ($d->status_ekonomi == 2)
                                Mampu
                            @elseif ($d->status_ekonomi == 1)
                                <b class="text-warning">Kurang Mampu</b>
                            @else
                                <b class="text-danger">Tidak Mampu</b>
                            @endif</td>
                            <td>
                                <a href="" class="badge bg-primary" data-toggle="modal" data-target="#showModal{{ $d->id }}"><i class="fas fa-eye"></i> Lihat</a>
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
    <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Form Tambah Jama'ah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('jamaah.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-sm mb-2">
                                <label for="nama_jamaah" class="form-label">Nama Jama'ah</label>
                                <input type="text" class="form-control" id="nama_jamaah" name="nama_jamaah" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <label for="no_ktp" class="form-label">No. KTP</label>
                                <input type="number" class="form-control" id="no_ktp" name="no_ktp" required>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <label for="no_kk" class="form-label">No. KK</label>
                                <input type="number" class="form-control" id="no_kk" name="no_kk" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm mb-2">
                                <label for="alamat_jamaah" class="form-label">Alamat</label>
                                <textarea class="form-control" name="alamat_jamaah" id="alamat_jamaah" required></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm mb-2">
                                <label for="no_hp" class="form-label">No.HP</label>
                                <input type="text" class="form-control" id="no_hp" name="no_hp" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <label for="jenkel" class="form-label">Jenis Kelamin</label>
                                <select name="jenkel" id="jenkel" class="form-control" required>
                                    <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <label for="status_nikah" class="form-label">Status Pernikahan</label>
                                <select name="status_nikah" id="status_nikah" class="form-control" required>
                                    <option value="" disabled selected>Pilih Status</option>
                                    <option value="3">Menikah</option>
                                    <option value="2">Belum Menikah</option>
                                    <option value="1">Duda</option>
                                    <option value="0">Janda</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <label for="agama" class="form-label">Agama</label>
                                <select name="agama" id="agama" class="form-control" required>
                                    <option value="" disabled selected>Pilih Agama</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Protestan">Protestan</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Buddha">Buddha</option>
                                    <option value="Konghucu">Konghucu</option>
                                </select>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <label for="gol_darah" class="form-label">Golongan Darah</label>
                                <select name="gol_darah" id="gol_darah" class="form-control" required>
                                    <option value="" disabled selected>Pilih Golongan Darah</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="AB">AB</option>
                                    <option value="O">O</option>
                                    <option value="-">-</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm mb-2">
                                <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <label for="status_ekonomi" class="form-label">Status Ekonomi</label>
                                <select name="status_ekonomi" id="status_ekonomi" class="form-control" required>
                                    <option value="" disabled selected>Pilih Status Ekonomi</option>
                                    <option value="2">Mampu</option>
                                    <option value="1">Kurang Mampu</option>
                                    <option value="0">Tidak Mampu</option>
                                </select>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <label for="status_jamaah" class="form-label">Status Jama'ah</label>
                                <select name="status_jamaah" id="status_jamaah" class="form-control" required>
                                    <option value="" disabled selected>Pilih Status Jama'ah</option>
                                    <option value="Anggota DKM">Anggota DKM</option>
                                    <option value="Jamaah">Jama'ah</option>
                                    <option value="Non Jamaah">Non Jamaah</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm mb-2">
                                <label for="foto_jamaah" class="form-label">Foto Jama'ah</label>
                                <input type="file" class="form-control" id="foto_jamaah" name="foto_jamaah" required>
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

    <!-- Modal Edit-->
    @foreach ($data as $d)
        <div class="modal fade" id="editModal{{ $d->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Form Edit Data Jama'ah</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('jamaah.update', $d->id) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
    
                            <div class="row">
                                <div class="col-sm mb-2">
                                    <label for="nama_jamaah" class="form-label">Nama Jama'ah</label>
                                    <input type="text" class="form-control" id="nama_jamaah" name="nama_jamaah" value="{{ $d->nama_jamaah }}" required>
                                </div>
                            </div>
    
                            <div class="row">
                                <div class="col-sm-6 mb-2">
                                    <label for="no_ktp" class="form-label">No. KTP</label>
                                    <input type="number" class="form-control" id="no_ktp" name="no_ktp" value="{{ $d->no_ktp }}" required>
                                </div>
                                <div class="col-sm-6 mb-2">
                                    <label for="no_kk" class="form-label">No. KK</label>
                                    <input type="number" class="form-control" id="no_kk" name="no_kk" value="{{ $d->no_kk }}" required>
                                </div>
                            </div>
    
                            <div class="row">
                                <div class="col-sm mb-2">
                                    <label for="alamat_jamaah" class="form-label">Alamat</label>
                                    <textarea class="form-control" name="alamat_jamaah" id="alamat_jamaah" required>{{ $d->alamat_jamaah }}</textarea>
                                </div>
                            </div>
    
                            <div class="row">
                                <div class="col-sm mb-2">
                                    <label for="no_hp" class="form-label">No.HP</label>
                                    <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ $d->no_hp }}" required>
                                </div>
                            </div>
    
                            <div class="row">
                                <div class="col-sm-6 mb-2">
                                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{ $d->tempat_lahir }}" required>
                                </div>
                                <div class="col-sm-6 mb-2">
                                    <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="{{ $d->tgl_lahir }}" required>
                                </div>
                            </div>
    
                            <div class="row">
                                <div class="col-sm-6 mb-2">
                                    <label for="jenkel" class="form-label">Jenis Kelamin</label>
                                    <select name="jenkel" id="jenkel" class="form-control" required>
                                        <option value="" disabled>Pilih Jenis Kelamin</option>
                                        @if ($d->jenkel == 'L')
                                            <option value="L">Laki-laki</option>
                                            <option value="P">Perempuan</option>
                                        @else
                                            <option value="P">Perempuan</option>
                                            <option value="L">Laki-laki</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-sm-6 mb-2">
                                    <label for="status_nikah" class="form-label">Status Pernikahan</label>
                                    <select name="status_nikah" id="status_nikah" class="form-control" required>
                                        <option value="" disabled>Pilih Status</option>
                                        @if ($d->status_nikah == 3)
                                            <option value="3">Menikah</option>
                                            <option value="2">Belum Menikah</option>
                                            <option value="1">Duda</option>
                                            <option value="0">Janda</option>
                                        @elseif ($d->status_nikah == 2)
                                            <option value="2">Belum Menikah</option>
                                            <option value="3">Menikah</option>
                                            <option value="1">Duda</option>
                                            <option value="0">Janda</option>
                                        @elseif ($d->status_nikah == 1)
                                            <option value="1">Duda</option>
                                            <option value="3">Menikah</option>
                                            <option value="2">Belum Menikah</option>
                                            <option value="0">Janda</option>
                                        @else
                                            <option value="0">Janda</option>
                                            <option value="3">Menikah</option>
                                            <option value="2">Belum Menikah</option>
                                            <option value="1">Duda</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
    
                            <div class="row">
                                <div class="col-sm-6 mb-2">
                                    <label for="agama" class="form-label">Agama</label>
                                    <select name="agama" id="agama" class="form-control" required>
                                        <option value="" disabled>Pilih Agama</option>
                                        @if ($d->agama == 'Islam')
                                            <option value="Islam">Islam</option>
                                            <option value="Katolik">Katolik</option>
                                            <option value="Protestan">Protestan</option>
                                            <option value="Hindu">Hindu</option>
                                            <option value="Buddha">Buddha</option>
                                            <option value="Konghucu">Konghucu</option>
                                        @elseif($d->agama == 'Katolik')
                                            <option value="Katolik">Katolik</option>
                                            <option value="Islam">Islam</option>
                                            <option value="Protestan">Protestan</option>
                                            <option value="Hindu">Hindu</option>
                                            <option value="Buddha">Buddha</option>
                                            <option value="Konghucu">Konghucu</option>
                                        @elseif($d->agama == 'Protestan')
                                            <option value="Protestan">Protestan</option>
                                            <option value="Islam">Islam</option>
                                            <option value="Katolik">Katolik</option>
                                            <option value="Hindu">Hindu</option>
                                            <option value="Buddha">Buddha</option>
                                            <option value="Konghucu">Konghucu</option>
                                        @elseif($d->agama == 'Hindu')
                                            <option value="Hindu">Hindu</option>
                                            <option value="Islam">Islam</option>
                                            <option value="Katolik">Katolik</option>
                                            <option value="Protestan">Protestan</option>
                                            <option value="Buddha">Buddha</option>
                                            <option value="Konghucu">Konghucu</option>
                                        @elseif($d->agama == 'Buddha')
                                            <option value="Buddha">Buddha</option>
                                            <option value="Islam">Islam</option>
                                            <option value="Katolik">Katolik</option>
                                            <option value="Protestan">Protestan</option>
                                            <option value="Hindu">Hindu</option>
                                            <option value="Konghucu">Konghucu</option>
                                        @elseif($d->agama == 'Konghucu')
                                            <option value="Konghucu">Konghucu</option>
                                            <option value="Islam">Islam</option>
                                            <option value="Katolik">Katolik</option>
                                            <option value="Protestan">Protestan</option>
                                            <option value="Hindu">Hindu</option>
                                            <option value="Buddha">Buddha</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-sm-6 mb-2">
                                    <label for="gol_darah" class="form-label">Golongan Darah</label>
                                    <select name="gol_darah" id="gol_darah" class="form-control" required>
                                        <option value="" disabled>Pilih Golongan Darah</option>
                                        @if ($d->gol_darah == 'A')
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="AB">AB</option>
                                            <option value="O">O</option>
                                            <option value="-">-</option>
                                        @elseif($d->gol_darah == 'B')
                                            <option value="B">B</option>
                                            <option value="A">A</option>
                                            <option value="AB">AB</option>
                                            <option value="O">O</option>
                                            <option value="-">-</option>
                                        @elseif($d->gol_darah == 'AB')
                                            <option value="AB">AB</option>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="O">O</option>
                                            <option value="-">-</option>
                                        @elseif($d->gol_darah == 'O')
                                            <option value="O">O</option>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="AB">AB</option>
                                            <option value="-">-</option>
                                        @elseif($d->gol_darah == '-')
                                            <option value="-">-</option>
                                            <option value="O">O</option>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="AB">AB</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
    
                            <div class="row">
                                <div class="col-sm mb-2">
                                    <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                    <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="{{ $d->pekerjaan }}" required>
                                </div>
                            </div>
    
                            <div class="row">
                                <div class="col-sm-6 mb-2">
                                    <label for="status_ekonomi" class="form-label">Status Ekonomi</label>
                                    <select name="status_ekonomi" id="status_ekonomi" class="form-control" required>
                                        <option value="" disabled>Pilih Status Ekonomi</option>
                                        @if ($d->status_ekonomi == 2)
                                            <option value="2">Mampu</option>
                                            <option value="1">Kurang Mampu</option>
                                            <option value="0">Tidak Mampu</option>
                                        @elseif ($d->status_ekonomi == 1)
                                            <option value="1">Kurang Mampu</option>
                                            <option value="2">Mampu</option>
                                            <option value="0">Tidak Mampu</option>
                                        @elseif ($d->status_ekonomi == 0)
                                            <option value="0">Tidak Mampu</option>
                                            <option value="2">Mampu</option>
                                                <option value="1">Kurang Mampu</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-sm-6 mb-2">
                                    <label for="status_jamaah" class="form-label">Status Jama'ah</label>
                                    <select name="status_jamaah" id="status_jamaah" class="form-control" required>
                                        <option value="" disabled>Pilih Status Jama'ah</option>
                                        @if ($d->status_jamaah == 'Anggota DKM')
                                            <option value="Anggota DKM">Anggota DKM</option>
                                            <option value="Jamaah">Jama'ah</option>
                                            <option value="Non Jamaah">Non Jamaah</option>
                                        @elseif ($d->status_jamaah == 'Jamaah')
                                            <option value="Jamaah">Jama'ah</option>
                                            <option value="Anggota DKM">Anggota DKM</option>
                                            <option value="Non Jamaah">Non Jamaah</option>
                                        @elseif ($d->status_jamaah == 'Non Jamaah')
                                            <option value="Non Jamaah">Non Jamaah</option>
                                            <option value="Anggota DKM">Anggota DKM</option>
                                            <option value="Jamaah">Jama'ah</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
    
                            <div class="row">
                                <div class="col-sm mb-2">
                                    <label for="foto_jamaah" class="form-label">Foto Jama'ah</label>
                                    <input type="hidden" class="form-control" id="foto_jamaah_lama" name="foto_jamaah_lama" value="{{ $d->foto_jamaah }}">
                                    <input type="file" class="form-control" id="foto_jamaah" name="foto_jamaah">
                                    <img src="{{ asset('storage/' . $d->foto_jamaah) }}" class="img-fluid w-25 mt-3" alt="foto-jama'ah">
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
                        <form action="{{ route('jamaah.destroy', $d->id) }}" method="POST">
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

    <!-- Modal Show -->
    @foreach ($data as $d)
        <div class="modal fade" id="showModal{{ $d->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Detail Data Jama'ah</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card card-body">
                            <table border="0" class="table-striped">
                                <tr>
                                    <td colspan="2" class="text-center py-3"><img src="{{ asset('storage/' . $d->foto_jamaah) }}" class="img-fluid w-75" alt="foto-jamaah"></td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td>: <b>{{ $d->nama_jamaah }}</b></td>
                                </tr>
                                <tr>
                                    <td>Tempat, tgl lahir</td>
                                    <td>: {{ $d->tempat_lahir }}, {{ date('d M Y', strtotime($d->tgl_lahir)) }}</td>
                                </tr>
                                <tr>
                                    <td>Jenis Kelamin</td>
                                    <td>: @if ($d->jenkel == 'L')
                                        Laki-laki
                                    @else
                                        Perempuan
                                    @endif</td>
                                </tr>
                                <tr>
                                    <td>Agama</td>
                                    <td>: {{ $d->agama}}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>: {{ $d->alamat_jamaah}}</td>
                                </tr>
                                <tr>
                                    <td>No. KTP</td>
                                    <td>: {{ $d->no_ktp}}</td>
                                </tr>
                                <tr>
                                    <td>No. KK</td>
                                    <td>: {{ $d->no_kk}}</td>
                                </tr>
                                <tr>
                                    <td>No. HP</td>
                                    <td>: {{ $d->no_hp}}</td>
                                </tr>
                                <tr>
                                    <td>Golongan Darah</td>
                                    <td>: {{ $d->gol_darah}}</td>
                                </tr>
                                <tr>
                                    <td>Pekerjaan</td>
                                    <td>: {{ $d->pekerjaan}}</td>
                                </tr>
                                <tr>
                                    <td>Status Pernikahan</td>
                                    <td>: @if ($d->status_nikah == 3)
                                        Menikah
                                    @elseif($d->status_nikah == 2)
                                        Belum Menikah
                                    @elseif($d->status_nikah == 1)
                                        Duda
                                    @else
                                        Janda
                                    @endif</td>
                                </tr>
                                <tr>
                                    <td>Status Jamaah</td>
                                    <td>: {{ $d->status_jamaah }}</td>
                                </tr>
                                <tr>
                                    <td>Status Ekonomi</td>
                                    <td>: @if ($d->status_ekonomi == 2)
                                        Mampu
                                    @elseif($d->status_ekonomi == 1)
                                        <b class="text-warning">Kurang Mampu</b>
                                    @else
                                        <b class="text-danger">Tidak Mampu</b>
                                    @endif</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection