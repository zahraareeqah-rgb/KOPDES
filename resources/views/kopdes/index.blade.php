@extends('layout.app')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h5 class="m-0 fw-bold text-danger"><i class="fa-solid fa-building-user me-2"></i>Data Kopdes</h5>
        <a href="{{ route('kopdes.create') }}" class="btn btn-danger btn-sm"><i class="fa-solid fa-plus me-1"></i> Tambah Data Kopdes</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="text-center" style="width: 50px;">No</th>
                        <th>Foto Kopdes</th>
                        <th>Nama Kopdes</th>
                        <th>Manager Kopdes</th>
                        <th>Foto Manager</th>
                        <th>Alamat Kopdes</th>
                        <th>Tanggal Berdiri</th>
                        <th class="text-center" style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kopdes as $index => $item)
                        <tr>
                            <td class="text-center fw-bold">{{ $index + 1 }}</td>
                            <td>
                                @if($item->foto_kopdes)
                                    <img src="{{ asset('storage/' . $item->foto_kopdes) }}" alt="Foto Kopdes" width="50" height="50" class="rounded object-fit-cover border">
                                @else
                                    <span class="badge bg-secondary">Tidak ada foto</span>
                                @endif
                            </td>

                            <td class="fw-semibold">{{ $item->nama_kopdes }}</td>

                            <td>
                                    {{ $item->manager ? $item->manager->nama_manager : 'Tanpa Manager' }}
                            </td>
                            <td class="text-center">
                                @if($item->manager && $item->manager->foto_manager)
                                <img src="{{ asset('storage/' . $item->manager->foto_manager) }}" alt="Foto Manager" width="50"height="50"class="rounded-3 object-fit-cover border">
                                @else
                                <span class="text-muted small">-</span>
                                @endif
                            </td>
                            <td>{{ $item->alamat }}</td>

                            <td>{{ $item->tanggal_berdiri }}</td>

                            <td class="text-center">
                                <a href="{{ route('kopdes.edit', $item->id) }}" class="btn btn-warning btn-sm text-white me-1"><i class="fa-solid fa-pen-to-square"></i></a>
                                <form action="{{ route('kopdes.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">Belum ada data kopdes.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
