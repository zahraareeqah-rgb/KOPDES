@extends('layout.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h5 class="m-0 fw-bold text-danger"><i class="fa-solid fa-user-pen me-2"></i>Edit Data Kopdes</h5>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('kopdes.update', $kopdes->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Kopdes</label>
                        <input type="text" name="nama_kopdes" class="form-control @error('nama_kopdes') is-invalid @enderror" value="{{ old('nama_kopdes', $kopdes->nama_kopdes) }}" placeholder="Masukkan Nama Lengkap">
                        @error('nama_kopdes') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Pilih Manager</label>
                            <select name="manager_id" class="form-select @error('manager_id') is-invalid @enderror">
                                <option value="" hidden>-- Pilih Manager --</option>
                                @foreach($managers as $manager)
                                    <option value="{{ $manager->id }}" {{ old('manager_id', $kopdes->manager_id) == $manager->id ? 'selected' : '' }}>
                                        {{ $manager->nama_manager }} - {{ $manager->Pendidikan_terakhir }}
                                    </option>
                                @endforeach
                            </select>
                            @error('manager_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Tanggal Berdiri</label>
                            <input type="date" name="tanggal_berdiri" class="form-control @error('tanggal_berdiri') is-invalid @enderror" value="{{ old('tanggal_berdiri', $kopdes->tanggal_berdiri) }}">
                            @error('tanggal_berdiri') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Foto Kopdes</label>
                        @if($kopdes->foto_kopdes)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $kopdes->foto_kopdes) }}" alt="Foto Lama" class="rounded border object-fit-cover" width="80" height="80">
                                <small class="text-muted d-block mt-1">*Foto saat ini. Biarkan kosong jika tidak ingin mengganti.</small>
                            </div>
                        @endif
                        <input type="file" name="foto_kopdes" class="form-control @error('foto_kopdes') is-invalid @enderror">
                        @error('foto_kopdes') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-4">
                         <label class="form-label fw-bold">Alamat</label>
                            <textarea name="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukkan Alamat">{{ old('alamat', $kopdes->alamat) }}</textarea>
                            @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="d-flex justify-content-between pt-2 border-top">
                        <a href="{{ route('kopdes.index') }}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left me-1"></i> Kembali</a>
                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-save me-1"></i> Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
