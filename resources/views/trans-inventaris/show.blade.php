@extends('dashboard-admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#createModal">Buat Transaksi</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive">
            <table id="example1" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th class="text-center">Tanggal Transaksi</th>
                        <th class="text-center">Nama Barang</th>
                        <th class="text-center">Barang Masuk</th>
                        <th class="text-center">Barang Keluar</th>
                        <th class="text-center">Keterangan</th>
                        <th class="text-center">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @foreach ($data as $d)
                        <tr>
                            <td class="text-center">{{ $i++ }}</td>
                            <td class="text-center">{{ date('d M Y', strtotime($d->tgl_trans)) }}</td>
                            <td class="text-center">{{ $d->nama_barang }}</td>
                            <td class="text-right">{{ $d->barang_masuk }}</td>
                            <td class="text-right">{{ $d->barang_keluar }}</td>
                            <td class="text-center">{{ $d->keterangan }}</td>
                            <td class="text-center">
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

    <!-- Modal Transaksi -->
    <div class="modal fade" id="createModal" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Form Transaksi Inventaris Barang</h5>
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

    @foreach ($data as $d)
        <!-- Modal Transaksi -->
        <div class="modal fade" id="editModal{{ $d->id }}" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Form Edit Transaksi Inventaris Barang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('trans-inv.update', $d->id) }}" method="POST">
                            @method('PUT')
                            @csrf

                            <div class="row">
                                <div class="col-sm mb-3">
                                    <label for="tgl_trans" class="form-label">Tanggal Transaksi</label>
                                    <input type="date" class="form-control" id="tgl_trans" name="tgl_trans" value="{{ $d->tgl_trans }}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm mb-3">
                                    <label for="inventaris_id" class="form-label">Nama Barang</label>
                                    <select name="inventaris_id" class="form-control select2" style="width: 100%">
                                        <option value="{{ $d->inventaris_id }}">{{ $d->nama_barang }}</option>
                                        <option value="" disabled>Pilih Barang</option>
                                        @foreach ($barang as $b)
                                            <option value="{{ $b->id }}">{{ $d->nama_barang }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm mb-3">
                                    <label for="jenis_trans" class="form-label">Jenis Transaksi</label>
                                    <select name="jenis_trans" id="jenis_trans" class="form-control" required>
                                        @if ($d->barang_masuk == null)
                                            <option value="barang_keluar">Barang Keluar</option>
                                            <option value="barang_masuk">Barang Masuk</option>
                                        @else
                                            <option value="barang_masuk">Barang Masuk</option>
                                            <option value="barang_keluar">Barang Keluar</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm mb-2">
                                    <label for="qty" class="form-label">Qty</label>
                                    @if ($d->barang_masuk == null)
                                        <input type="number" class="form-control" id="qty" name="qty" value="{{$d->barang_keluar}}" required>
                                    @else
                                        <input type="number" class="form-control" id="qty" name="qty" value="{{$d->barang_masuk}}" required>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm mb-2">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <textarea name="keterangan" id="keterangan" class="form-control" required>{{$d->keterangan}}</textarea>
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
                        <form action="{{ route('trans-inv.destroy', $d->id) }}" method="POST">
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
@endsection