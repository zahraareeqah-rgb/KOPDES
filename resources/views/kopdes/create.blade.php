@extends('layout.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h5 class="m-0 fw-bold text-danger"><i class="fa-solid fa-building-user me-2"></i>Tambah Data Kopdes</h5>
            </div>
            <div class="card-body p-4">

                @if ($errors->any())
                    <div class="alert alert-danger mb-4">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('kopdes.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Kopdes</label>
                        <input type="text" name="nama_kopdes" class="form-control @error('nama_kopdes') is-invalid @enderror" value="{{ old('nama_kopdes') }}" placeholder="Masukkan Nama Kopdes">
                        @error('nama_kopdes') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                        <div class="mb-3">
                    <label class="form-label fw-bold">Pilih Manager</label>
                    <select name="manager_id" class="form-select @error('manager_id') is-invalid @enderror">
                    <option value="" hidden>-- Pilih Manager --</option>
                    @foreach($managers as $manager)
                    <option value="{{ $manager->id }}" {{ old('manager_id') == $manager->id ? 'selected' : '' }}>
                        {{ $manager->nama_manager }} - {{ $manager->Pendidikan_terakhir }}
                    </option>
                    @endforeach
                </select>
                @error('manager_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Tanggal Berdiri</label>
                        <input type="date" name="tanggal_berdiri" class="form-control @error('tanggal_berdiri') is-invalid @enderror" value="{{ old('tanggal_berdiri') }}">
                        @error('tanggal_berdiri') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Foto Kopdes</label>
                        <input type="file" name="foto_kopdes" class="form-control @error('foto_kopdes') is-invalid @enderror">
                        @error('foto_kopdes') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Alamat</label>
                        <textarea name="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukkan Alamat Kopdes">{{ old('alamat') }}</textarea>
                        @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex justify-content-between pt-2">
                        <a href="{{ route('kopdes.index') }}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left me-1"></i> Kembali</a>
                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-save me-1"></i> Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
