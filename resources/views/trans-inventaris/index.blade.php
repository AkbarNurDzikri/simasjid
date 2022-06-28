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
                        <th class="text-center">Nama Barang</th>
                        <th class="text-center">Total Barang Masuk</th>
                        <th class="text-center">Total Barang Keluar</th>
                        <th class="text-center">Stock</th>
                        <th class="text-center">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @foreach ($data as $d)
                        <tr>
                            <td class="text-center">{{ $i++ }}</td>
                            <td class="text-center">{{ $d->nama_barang }}</td>
                            <td class="text-right">{{ $d->totalBarangMasuk }}</td>
                            <td class="text-right">{{ $d->totalBarangKeluar }}</td>
                            <td class="text-right">{{ $d->totalBarangMasuk - $d->totalBarangKeluar }}</td>
                            <td class="text-center">
                                <a href="{{ route('trans-inv.show', $d->id) }}" class="badge bg-primary"><i class="far fa-eye"></i> Detail</a>
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
@endsection