@extends('dashboard-admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#createModal">Tambah Transaksi</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive">
            <table id="example1" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th class="text-center">Nama Acara</th>
                        <th class="text-center">Total Pemasukan</th>
                        <th class="text-center">Total Pengeluaran</th>
                        <th class="text-center">Saldo</th>
                        <th class="text-center">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @foreach ($data as $d)
                        <tr>
                            <td class="text-center">{{ $i++ }}</td>
                            <td class="text-center">{{ $d->nama_acara }}</td>
                            <td class="text-right">Rp. {{ number_format($d->totalPemasukan, 2, ',', '.') }}</td>
                            <td class="text-right">Rp. {{ number_format($d->totalPengeluaran, 2, ',', '.') }}</td>
                            <td class="text-right">Rp. {{ number_format($d->totalPemasukan - $d->totalPengeluaran, 2, ',', '.') }}</td>
                            <td class="text-center">
                                <a href="{{ route('trans-acara.show', $d->id) }}" class="badge bg-primary"><i class="far fa-eye"></i> Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    <!-- /.card-body -->
    </div>
    <!-- /.card -->

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Form Tambah Transaksi Acara</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('trans-acara.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-sm mb-2">
                                <label for="acara_id" class="form-label">Nama Acara</label>
                                <select name="acara_id" class="form-control select2" style="width: 100%;" required>
                                    <option value="" disabled selected>Pilih Acara</option>
                                    @foreach ($acara as $a)
                                        <option value="{{ $a->id }}">{{ $a->nama_acara }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm mb-2">
                                <label for="tgl_trans" class="form-label">Tanggal Transaksi</label>
                                <input type="date" class="form-control" name="tgl_trans" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm mb-2">
                                <label for="jenis_trans" class="form-label">Jenis Transaksi</label>
                                <select name="jenis_trans" id="jenis_trans" class="form-control" required>
                                    <option value="" disabled selected>Pilih Jenis Transaksi</option>
                                    <option value="pemasukan">Pemasukan</option>
                                    <option value="pengeluaran">Pengeluaran</option>
                                </select>
                            </div>
                        </div>

                        
                        <div class="row">
                            <div class="col-sm mb-2">
                                <label for="nominal" class="form-label">Nominal</label>
                                <input type="number" class="form-control" name="nominal" required>
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