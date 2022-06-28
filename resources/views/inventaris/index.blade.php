@extends('dashboard-admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title d-inline mr-2"><a href="#" class="btn btn-outline-primary" data-toggle="modal" data-target="#formModal"><i class="fas fa-plus"></i> Tambah Barang</a> </h3>
            <h3 class="card-title d-inline mr-2"><a href="#" class="btn btn-outline-success" data-toggle="modal" data-target="#transModal"><i class="fas fa-plus"></i> Buat Transaksi</a> </h3>
            <h3 class="card-title d-inline"><a href="{{ route('trans-inv.index') }}" class="btn btn-outline-warning"><i class="fas fa-plus"></i> Lihat Stock</a> </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive">
            <table id="example1" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Barang</th>
                        <th>Satuan</th>
                        <th>Lokasi Simpan</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @foreach ($data as $d)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $d->nama_barang }}</td>
                            <td>{{ $d->satuan }}</td>
                            <td>{{ $d->lokasi_penyimpanan }}</td>
                            
                            <td>
                                <a href="{{ route('trans-inv.show', $d->id) }}" class="badge bg-primary"><i class="far fa-eye"></i> Detail</a>
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
                    <h5 class="modal-title" id="formModalLabel">Form Tambah Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('inventaris.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-sm mb-2">
                                <label for="nama_barang" class="form-label">Nama Barang</label>
                                <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm mb-2">
                                <label for="satuan" class="form-label">Satuan</label>
                                <input type="text" class="form-control" id="satuan" name="satuan" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm mb-2">
                                <label for="lokasi_penyimpanan" class="form-label">Lokasi</label>
                                <input type="text" class="form-control" id="lokasi_penyimpanan" name="lokasi_penyimpanan" required>
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
                        <h5 class="modal-title" id="editModalLabel">Form Edit Barang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('inventaris.update',  $d->id) }}" method="POST">
                            @method('PUT')
                            @csrf

                            <div class="row">
                                <div class="col-sm mb-2">
                                    <label for="nama_barang" class="form-label">Nama Barang</label>
                                    <input type="text" class="form-control" id="nam_role" name="nama_barang" value="{{ $d->nama_barang }}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm mb-2">
                                    <label for="satuan" class="form-label">Satuan</label>
                                    <input type="text" class="form-control" id="satuan" name="satuan" value="{{ $d->satuan }}" required>
                                </div>
                            </div>
    
                            <div class="row">
                                <div class="col-sm mb-2">
                                    <label for="lokasi_penyimpanan" class="form-label">Lokasi</label>
                                    <input type="text" class="form-control" id="lokasi_penyimpanan" name="lokasi_penyimpanan" value="{{ $d->lokasi_penyimpanan }}" required>
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
                        <form action="{{ route('inventaris.destroy', $d->id) }}" method="POST">
                            @method('delete')
                            @csrf
                            
                            <div class="card text-center">
                                <div class="card-body">
                                    <h4>Data ini akan dihapus</h4>
                                    <h2>Yakin hapus <b>{{ $d->nama_barang }}</b></h2>
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

    <!-- Modal Transaksi -->
    <div class="modal fade" id="transModal" aria-labelledby="transModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="transModalLabel">Form Transaksi Inventaris Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('trans-inv.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-sm mb-3">
                                <label for="tgl_trans" class="form-label">Tanggal Transaksi</label>
                                <input type="date" class="form-control" id="tgl_trans" name="tgl_trans" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm mb-3">
                                <label for="inventaris_id" class="form-label">Nama Barang</label>
                                <select name="inventaris_id" class="form-control select2" style="width: 100%">
                                    <option value="" disabled selected>Pilih Barang</option>
                                    @foreach ($data as $d)
                                        <option value="{{ $d->id }}">{{ $d->nama_barang }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm mb-3">
                                <label for="jenis_trans" class="form-label">Jenis Transaksi</label>
                                <select name="jenis_trans" id="jenis_trans" class="form-control" required>
                                    <option value="" disabled selected>Pilih Jenis Transaksi</option>
                                    <option value="barang_masuk">Barang Masuk</option>
                                    <option value="barang_keluar">Barang Keluar</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm mb-2">
                                <label for="qty" class="form-label">Qty</label>
                                <input type="number" class="form-control" id="qty" name="qty" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm mb-2">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea name="keterangan" id="keterangan" class="form-control" required></textarea>
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
@endsection