@extends('layout.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h5 class="m-0 fw-bold text-danger"><i class="fa-solid fa-user-pen me-2"></i>Edit Data Manager</h5>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('manager.update', $manager->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Manager</label>
                        <input type="text" name="nama_manager" class="form-control @error('nama_manager') is-invalid @enderror" value="{{ old('nama_manager', $manager->nama_manager) }}" placeholder="Masukkan Nama Lengkap">
                        @error('nama_manager') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror">
                                <option value="" hidden>-- Pilih Jenis Kelamin --</option>
                                <option value="Pria" {{ old('jenis_kelamin', $manager->jenis_kelamin) == 'Pria' ? 'selected' : '' }}>Pria</option>
                                <option value="Wanita" {{ old('jenis_kelamin', $manager->jenis_kelamin) == 'Wanita' ? 'selected' : '' }}>Wanita</option>
                            </select>
                            @error('jenis_kelamin') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" value="{{ old('tanggal_lahir', $manager->tanggal_lahir) }}">
                            @error('tanggal_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold">Pendidikan Terakhir</label>
                            <input type="text" name="Pendidikan_terakhir" class="form-control @error('Pendidikan_terakhir') is-invalid @enderror" value="{{ old('Pendidikan_terakhir', $manager->Pendidikan_terakhir) }}" placeholder="Contoh: S1 Pendidikan">
                            @error('Pendidikan_terakhir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Foto Manager</label>
                        @if($manager->foto_manager)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $manager->foto_manager) }}" alt="Foto Lama" class="rounded border object-fit-cover" width="80" height="80">
                                <small class="text-muted d-block mt-1">*Foto saat ini. Biarkan kosong jika tidak ingin mengganti.</small>
                            </div>
                        @endif
                        <input type="file" name="foto_manager" class="form-control @error('foto_manager') is-invalid @enderror">
                        @error('foto_manager') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Alamat</label>
                        <textarea name="alamat_manager" rows="3" class="form-control @error('alamat_manager') is-invalid @enderror" placeholder="Masukkan Alamat">{{ old('alamat_manager', $manager->alamat_manager) }}</textarea>
                        @error('alamat_manager') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="d-flex justify-content-between pt-2 border-top">
                        <a href="{{ route('manager.index') }}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left me-1"></i> Kembali</a>
                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-save me-1"></i> Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
