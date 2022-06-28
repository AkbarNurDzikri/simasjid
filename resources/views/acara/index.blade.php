@extends('dashboard-admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><a href="#" class="btn btn-outline-primary" data-toggle="modal" data-target="#formModal"><i class="fas fa-plus"></i> Tambah Acara</a> </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive">
            <table id="example1" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th class="text-center">Nama Acara</th>
                        <th class="text-center">Anggaran Dana</th>
                        <th class="text-center">Tanggal Mulai</th>
                        <th class="text-center">Tanggal Selesai</th>
                        <th class="text-center">Keterangan</th>
                        <th class="text-center">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @foreach ($data as $d)
                        <tr>
                            <td class="text-center">{{ $i++ }}</td>
                            <td class="text-center">{{ $d->nama_acara }}</td>
                            <td class="text-right">Rp. {{ number_format($d->anggaran_dana, 2, ',', '.') }}</td>
                            <td class="text-center">{{ date('d M Y', strtotime($d->tgl_mulai_acara)) }}</td>
                            <td class="text-center">{{ date('d M Y', strtotime($d->tgl_selesai_acara)) }}</td>
                            <td class="text-center">{!! $d->keterangan !!}</td>
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
                    <h5 class="modal-title" id="formModalLabel">Form Tambah Acara</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('acara.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-sm mb-2">
                                <label for="nama_acara" class="form-label">Nama Acara</label>
                                <input type="text" class="form-control" id="nama_acara" name="nama_acara" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <label class="form-label" id="tgl_mulai_acara">Tanggal Mulai</label>
                                <input type="date" class="form-control" id="tgl_mulai_acara" name="tgl_mulai_acara" required>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <label class="form-label" id="tgl_selesai_acara">Tanggal Selesai</label>
                                <input type="date" class="form-control" id="tgl_selesai_acara" name="tgl_selesai_acara" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm mb-2 input-group">
                                <label for="anggaran_dana" class="form-label">Anggaran Dana</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="anggaran_dana">Rp.</span>
                                    </div>
                                    <input type="number" class="form-control" id="anggaran_dana" name="anggaran_dana" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <label for="ketua_panitia" class="form-label">Ketua Panitia</label>
                                <select name="ketua_panitia" class="form-control select2" style="width: 100%;">
                                    <option value="" disabled selected>Pilih Ketua</option>
                                    @foreach ($jamaah as $j)
                                        <option value="{{ $j->id }}">{{ $j->nama_jamaah }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <label for="wakil_ketua_panitia" class="form-label">Wakil Ketua</label>
                                <select name="wakil_ketua_panitia" class="form-control select2" style="width: 100%;">
                                    <option value="" disabled selected>Pilih Wakil Ketua</option>
                                    @foreach ($jamaah as $j)
                                        <option value="{{ $j->id }}">{{ $j->nama_jamaah }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <label for="sekretaris_acara" class="form-label">Sekretaris</label>
                                <select name="sekretaris_acara" class="form-control select2" style="width: 100%;">
                                    <option value="" disabled selected>Pilih Sekretaris</option>
                                    @foreach ($jamaah as $j)
                                        <option value="{{ $j->id }}">{{ $j->nama_jamaah }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <label for="bendahara_acara" class="form-label">Bendahara</label>
                                <select name="bendahara_acara" class="form-control select2" style="width: 100%;">
                                    <option value="" disabled selected>Pilih Bendahara</option>
                                    @foreach ($jamaah as $j)
                                        <option value="{{ $j->id }}">{{ $j->nama_jamaah }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <label for="koordinator_acara" class="form-label">Koordinator Acara</label>
                                <select name="koordinator_acara" class="form-control select2" style="width: 100%;">
                                    <option value="" disabled selected>Pilih Koordinator Acara</option>
                                    @foreach ($jamaah as $j)
                                        <option value="{{ $j->id }}">{{ $j->nama_jamaah }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <label for="koordinator_konsumsi" class="form-label">Koordinator Konsumsi</label>
                                <select name="koordinator_konsumsi" class="form-control select2" style="width: 100%;">
                                    <option value="" disabled selected>Pilih Koordinator Konsumsi</option>
                                    @foreach ($jamaah as $j)
                                        <option value="{{ $j->id }}">{{ $j->nama_jamaah }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <label for="koordinator_dokumentasi" class="form-label">Koordinator Dokumentasi</label>
                                <select name="koordinator_dokumentasi" class="form-control select2" style="width: 100%;">
                                    <option value="" disabled selected>Pilih Koordinator Dokumentasi</option>
                                    @foreach ($jamaah as $j)
                                        <option value="{{ $j->id }}">{{ $j->nama_jamaah }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <label for="koordinator_keamanan" class="form-label">Koordinator Keamanan</label>
                                <select name="koordinator_keamanan" class="form-control select2" style="width: 100%;">
                                    <option value="" disabled selected>Pilih Koordinator Keamanan</option>
                                    @foreach ($jamaah as $j)
                                        <option value="{{ $j->id }}">{{ $j->nama_jamaah }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <label for="koordinator_peralatan" class="form-label">Koordinator Peralatan</label>
                                <select name="koordinator_peralatan" class="form-control select2" style="width: 100%;">
                                    <option value="" disabled selected>Pilih Koordinator Peralatan</option>
                                    @foreach ($jamaah as $j)
                                        <option value="{{ $j->id }}">{{ $j->nama_jamaah }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <label for="penanggungjawab_acara" class="form-label">Penanggungjawab Acara</label>
                                <select name="penanggungjawab_acara" class="form-control select2" style="width: 100%;">
                                    <option value="" disabled selected>Pilih Penanggungjawab Acara</option>
                                    @foreach ($jamaah as $j)
                                        <option value="{{ $j->id }}">{{ $j->nama_jamaah }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm mb-2">
                                <label for="penasehat_acara" class="form-label">Penasehat Acara</label>
                                <select name="penasehat_acara" class="form-control select2" style="width: 100%;">
                                    <option value="" disabled selected>Pilih Penasehat Acara</option>
                                    @foreach ($jamaah as $j)
                                        <option value="{{ $j->id }}">{{ $j->nama_jamaah }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm mb-2">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
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
                        <h5 class="modal-title" id="editModalLabel">Form Edit Acara</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('acara.update', $d->id) }}" method="POST">
                            @method('PUT')
                            @csrf

                            <div class="row">
                                <div class="col-sm mb-2">
                                    <label for="nama_acara" class="form-label">Nama Acara</label>
                                    <input type="text" class="form-control" id="nama_acara" name="nama_acara" value="{{ $d->nama_acara }}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 mb-2">
                                    <label class="form-label" id="tgl_mulai_acara">Tanggal Mulai</label>
                                    <input type="date" class="form-control" id="tgl_mulai_acara" name="tgl_mulai_acara" value="{{ $d->tgl_mulai_acara }}" required>
                                </div>
                                <div class="col-sm-6 mb-2">
                                    <label class="form-label" id="tgl_selesai_acara">Tanggal Selesai</label>
                                    <input type="date" class="form-control" id="tgl_selesai_acara" name="tgl_selesai_acara" value="{{ $d->tgl_selesai_acara }}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm mb-2 input-group">
                                    <label for="anggaran_dana" class="form-label">Anggaran Dana</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="anggaran_dana">Rp.</span>
                                        </div>
                                        <input type="number" class="form-control" id="anggaran_dana" name="anggaran_dana" value="{{ $d->anggaran_dana }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 mb-2">
                                    <label for="ketua_panitia" class="form-label">Ketua Panitia</label>
                                    <select name="ketua_panitia" class="form-control select2" style="width: 100%;">
                                        <option value="{{ $d->ketua_panitia }}" selected>{{ $d->ketua }}</option>
                                        <option value="" disabled>Pilih Ketua</option>
                                        @foreach ($jamaah as $j)
                                            <option value="{{ $j->id }}">{{ $j->nama_jamaah }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6 mb-2">
                                    <label for="wakil_ketua_panitia" class="form-label">Wakil Ketua</label>
                                    <select name="wakil_ketua_panitia" class="form-control select2" style="width: 100%;">
                                        <option value="{{ $d->ketua_panitia }}" selected>{{ $d->wakil }}</option>
                                        <option value="" disabled>Pilih Wakil Ketua</option>
                                        @foreach ($jamaah as $j)
                                            <option value="{{ $j->id }}">{{ $j->nama_jamaah }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 mb-2">
                                    <label for="sekretaris_acara" class="form-label">Sekretaris</label>
                                    <select name="sekretaris_acara" class="form-control select2" style="width: 100%;">
                                        <option value="{{ $d->sekretaris_acara }}" selected>{{ $d->sekretaris }}</option>
                                        <option value="" disabled>Pilih Sekretaris</option>
                                        @foreach ($jamaah as $j)
                                            <option value="{{ $j->id }}">{{ $j->nama_jamaah }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6 mb-2">
                                    <label for="bendahara_acara" class="form-label">Bendahara</label>
                                    <select name="bendahara_acara" class="form-control select2" style="width: 100%;">
                                        <option value="{{ $d->bendahara_acara }}" selected>{{ $d->bendahara }}</option>
                                        <option value="" disabled>Pilih Bendahara</option>
                                        @foreach ($jamaah as $j)
                                            <option value="{{ $j->id }}">{{ $j->nama_jamaah }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 mb-2">
                                    <label for="koordinator_acara" class="form-label">Koordinator Acara</label>
                                    <select name="koordinator_acara" class="form-control select2" style="width: 100%;">
                                        <option value="{{ $d->koordinator_acara }}" selected>{{ $d->koor_acara }}</option>
                                        <option value="" disabled>Pilih Koordinator Acara</option>
                                        @foreach ($jamaah as $j)
                                            <option value="{{ $j->id }}">{{ $j->nama_jamaah }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6 mb-2">
                                    <label for="koordinator_konsumsi" class="form-label">Koordinator Konsumsi</label>
                                    <select name="koordinator_konsumsi" class="form-control select2" style="width: 100%;">
                                        <option value="{{ $d->koordinator_konsumsi }}" selected>{{ $d->koor_konsumsi }}</option>
                                        <option value="" disabled>Pilih Koordinator Konsumsi</option>
                                        @foreach ($jamaah as $j)
                                            <option value="{{ $j->id }}">{{ $j->nama_jamaah }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 mb-2">
                                    <label for="koordinator_dokumentasi" class="form-label">Koordinator Dokumentasi</label>
                                    <select name="koordinator_dokumentasi" class="form-control select2" style="width: 100%;">
                                        <option value="{{ $d->koordinator_dokumentasi }}" selected>{{ $d->koor_dokumentasi }}</option>
                                        <option value="" disabled>Pilih Koordinator Dokumentasi</option>
                                        @foreach ($jamaah as $j)
                                            <option value="{{ $j->id }}">{{ $j->nama_jamaah }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6 mb-2">
                                    <label for="koordinator_keamanan" class="form-label">Koordinator Keamanan</label>
                                    <select name="koordinator_keamanan" class="form-control select2" style="width: 100%;">
                                        <option value="{{ $d->koordinator_keamanan }}" selected>{{ $d->koor_keamanan }}</option>
                                        <option value="" disabled>Pilih Koordinator Keamanan</option>
                                        @foreach ($jamaah as $j)
                                            <option value="{{ $j->id }}">{{ $j->nama_jamaah }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 mb-2">
                                    <label for="koordinator_peralatan" class="form-label">Koordinator Peralatan</label>
                                    <select name="koordinator_peralatan" class="form-control select2" style="width: 100%;">
                                        <option value="{{ $d->koordinator_peralatan }}" selected>{{ $d->koor_peralatan }}</option>
                                        <option value="" disabled>Pilih Koordinator Peralatan</option>
                                        @foreach ($jamaah as $j)
                                            <option value="{{ $j->id }}">{{ $j->nama_jamaah }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6 mb-2">
                                    <label for="penanggungjawab_acara" class="form-label">Penanggungjawab Acara</label>
                                    <select name="penanggungjawab_acara" class="form-control select2" style="width: 100%;">
                                        <option value="{{ $d->penanggungjawab_acara }}" selected>{{ $d->penanggungjawab }}</option>
                                        <option value="" disabled>Pilih Penanggungjawab Acara</option>
                                        @foreach ($jamaah as $j)
                                            <option value="{{ $j->id }}">{{ $j->nama_jamaah }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm mb-2">
                                    <label for="penasehat_acara" class="form-label">Penasehat Acara</label>
                                    <select name="penasehat_acara" class="form-control select2" style="width: 100%;">
                                        <option value="{{ $d->penasehat_acara }}" selected>{{ $d->penasehat }}</option>
                                        <option value="" disabled>Pilih Penasehat Acara</option>
                                        @foreach ($jamaah as $j)
                                            <option value="{{ $j->id }}">{{ $j->nama_jamaah }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm mb-2">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <input type="hidden" name="keterangan_lama" value="{!! $d->keterangan !!}">
                                    <textarea name="keterangan" class="form-control">{!! $d->keterangan !!}</textarea>
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

    <!-- Modal Show -->
    @foreach ($data as $d)
        <div class="modal fade" id="showModal{{ $d->id }}" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Show Detail Acara</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card card-body table-striped">
                            <table border="0">
                                <tr>
                                    <td colspan="2"><h3 class="text-center card-text">{{ $d->nama_acara }}</h3></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Mulai</td>
                                    <td class="align-middle">{{ date('d M Y', strtotime($d->tgl_mulai_acara) ) }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Selesai</td>
                                    <td class="align-middle">{{ date('d M Y', strtotime($d->tgl_selesai_acara) )}}</td>
                                </tr>
                                <tr>
                                    <td>Anggaran Dana</td>
                                    <td class="align-middle">Rp. {{ number_format($d->anggaran_dana, 2, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td>Ketua Panitia</td>
                                    <td class="align-middle">{{ $d->ketua }}</td>
                                </tr>
                                <tr>
                                    <td>Wakil Ketua Panitia</td>
                                    <td class="align-middle">{{ $d->wakil }}</td>
                                </tr>
                                <tr>
                                    <td>Sekretaris</td>
                                    <td class="align-middle">{{ $d->sekretaris }}</td>
                                </tr>
                                <tr>
                                    <td>Bendahara</td>
                                    <td class="align-middle">{{ $d->bendahara }}</td>
                                </tr>
                                <tr>
                                    <td>Koordinator Acara</td>
                                    <td class="align-middle">{{ $d->koor_acara }}</td>
                                </tr>
                                <tr>
                                    <td>Koordinator Konsumsi</td>
                                    <td class="align-middle">{{ $d->koor_konsumsi }}</td>
                                </tr>
                                <tr>
                                    <td>Koordinator Dokumentasi</td>
                                    <td class="align-middle">{{ $d->koor_dokumentasi }}</td>
                                </tr>
                                <tr>
                                    <td>Koordinator Keamanan</td>
                                    <td class="align-middle">{{ $d->koor_keamanan }}</td>
                                </tr>
                                <tr>
                                    <td>Koordinator Peralatan</td>
                                    <td class="align-middle">{{ $d->koor_peralatan }}</td>
                                </tr>
                                <tr>
                                    <td>Penanggungjawab Acara</td>
                                    <td class="align-middle">{{ $d->penanggungjawab }}</td>
                                </tr>
                                <tr>
                                    <td>Penasehat Acara</td>
                                    <td class="align-middle">{{ $d->penasehat }}</td>
                                </tr>
                                <tr>
                                    <td>Keterangan</td>
                                    <td class="align-middle">{!! $d->keterangan !!}</td>
                                </tr>
                            </table>
                        </div>
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
                        <form action="{{ route('acara.destroy', $d->id) }}" method="POST">
                            @method('delete')
                            @csrf
                            
                            <div class="card text-center">
                                <div class="card-body">
                                    <h4>Data ini akan dihapus</h4>
                                    <h2>Yakin hapus <b>{{ $d->nama_acara }}</b></h2>
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