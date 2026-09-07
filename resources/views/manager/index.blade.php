@extends('layout.app')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h5 class="m-0 fw-bold text-danger"><i class="fa-solid fa-users me-2"></i>Data Manager</h5>
        <a href="{{ route('manager.create') }}" class="btn btn-danger btn-sm"><i class="fa-solid fa-plus me-1"></i> Tambah Data Manager</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="text-center" style="width: 50px;">No</th>
                        <th>Foto</th>
                        <th>Nama Manager</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal Lahir</th>
                        <th>Pendidikan Terakhir</th>
                        <th>Alamat</th>
                        <th class="text-center" style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($managers as $index => $manager)
                        <tr>
                            <td class="text-center fw-bold">{{ $index + 1 }}</td>
                            <td>
                                @if($manager->foto_manager)
                                    <img src="{{ asset('storage/' . $manager->foto_manager) }}" alt="Foto" class="rounded" width="45" height="45" style="object-fit: cover;">
                                @else
                                    <span class="badge bg-secondary">No Photo</span>
                                @endif
                            </td>
                            <td class="fw-semibold">{{ $manager->nama_manager }}</td>
                            <td>
                                @if($manager->jenis_kelamin == 'Pria')
                                    <span class="badge bg-info text-dark"><i class="fa-solid fa-mars me-1"></i>Pria</span>
                                @else
                                    <span class="badge bg-danger"><i class="fa-solid fa-venus me-1"></i>Wanita</span>
                                @endif
                            </td>
                            <td>{{ $manager->tanggal_lahir }}</td>
                            <td><span class="badge bg-light text-dark border">{{ $manager->Pendidikan_terakhir }}</span></td>
                            <td>{{ $manager->alamat_manager }}</td>
                            <td class="text-center">
                                <a href="{{ route('manager.edit', $manager->id) }}" class="btn btn-warning btn-sm text-white"><i class="fa-solid fa-pen-to-square"></i></a>
                                <form action="{{ route('manager.destroy', $manager->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">Belum ada data manager.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
