@extends('dashboard-admin')
    @section('content')
        <div class="card">
            @if($data)
                <div class="card-header">
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#createModal">Tambah Transaksi</a>
                </div>
            @endif
            <div class="card-body table-responsive">
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Tanggal Transaksi</th>
                            <th class="text-center">Nama Acara</th>
                            <th class="text-center">Pemasukan</th>
                            <th class="text-center">Pengeluaran</th>
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
                                <td class="text-center">{{ $d->nama_acara }}</td>
                                @if ($d->pemasukan == null)
                                    {{-- dikosongkan --}} <td></td>
                                @else
                                    <td class="text-right">Rp. {{ number_format($d->pemasukan, 2, ',', '.') }}</td>
                                @endif

                                @if ($d->pengeluaran == null)
                                    {{-- dikosongkan --}} <td></td>
                                @else
                                    <td class="text-right">Rp. {{ number_format($d->pengeluaran, 2, ',', '.') }}</td>
                                @endif
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
        </div>

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
                                    <label class="form-label">Nama Acara</label>
                                    <select name="acara_id" class="form-control select2" style="width: 100%;">
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

        <!-- Edit Modal -->
        @foreach ($data as $d)
            <div class="modal fade" id="editModal{{ $d->id }}" aria-labelledby="createModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Form Edit Transaksi Acara</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('trans-acara.update', $d->id) }}" method="POST">
                                @method('PUT')
                                @csrf

                                <div class="row">
                                    <div class="col-sm mb-2">
                                        <label class="form-label">Nama Acara</label>
                                        <input type="text" class="form-control" value="{{ $d->nama_acara }}" readonly>
                                        <input type="hidden" name="acara_id" value="{{ $d->acara_id }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm mb-2">
                                        <label for="tgl_trans" class="form-label">Tanggal Transaksi</label>
                                        <input type="date" class="form-control" name="tgl_trans" value="{{ $d->tgl_trans }}" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm mb-2">
                                        <label for="jenis_trans" class="form-label">Jenis Transaksi</label>
                                        <select name="jenis_trans" id="jenis_trans" class="form-control" required>
                                            @if ($d->pemasukan == null)
                                                <option value="pengeluaran">Pengeluaran</option>
                                                <option value="pemasukan">Pemasukan</option>
                                            @else
                                                <option value="pemasukan">Pemasukan</option>
                                                <option value="pengeluaran">Pengeluaran</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                
                                <div class="row">
                                    <div class="col-sm mb-2">
                                        <label for="nominal" class="form-label">Nominal</label>
                                        @if ($d->pemasukan == null)
                                            <input type="number" class="form-control" name="nominal" value="{{ $d->pengeluaran }}" required>
                                        @else
                                            <input type="number" class="form-control" name="nominal" value="{{ $d->pemasukan }}" required>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm mb-2">
                                        <label for="keterangan" class="form-label">Keterangan</label>
                                        <textarea name="keterangan" id="keterangan" class="form-control" required>{{ $d->keterangan }}</textarea>
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
                        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('trans-acara.destroy', $d->id) }}" method="POST">
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