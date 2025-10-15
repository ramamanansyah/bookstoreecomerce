@extends('layouts.app')

@section('content')
<div class="container">
    <div class="course-form-container">
        <h1 class="form-title">Tambah Course Baru</h1>
        
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form method="POST" action="{{ route('courses.store') }}" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label for="title">Judul Course</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required class="form-control">
                @error('title')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea id="description" name="description" rows="4" required class="form-control">{{ old('description') }}</textarea>
                @error('description')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-row">
                <div class="form-group-half">
                    <label for="level">Tingkat</label>
                    <select id="level" name="level" required class="form-control">
                        <option value="Pemula" {{ old('level') == 'Pemula' ? 'selected' : '' }}>Pemula</option>
                        <option value="Menengah" {{ old('level') == 'Menengah' ? 'selected' : '' }}>Menengah</option>
                        <option value="Lanjutan" {{ old('level') == 'Lanjutan' ? 'selected' : '' }}>Lanjutan</option>
                    </select>
                    @error('level')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group-half">
                    <label for="price">Harga (Rp)</label>
                    <input type="number" id="price" name="price" value="{{ old('price') }}" step="1000" class="form-control">
                    @error('price')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group-half">
                    <label for="students_count">Jumlah Siswa</label>
                    <input type="number" id="students_count" name="students_count" value="{{ old('students_count') }}" min="0" class="form-control">
                    @error('students_count')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group-half">
                    <label for="lessons_count">Jumlah Pelajaran</label>
                    <input type="number" id="lessons_count" name="lessons_count" value="{{ old('lessons_count') }}" min="0" class="form-control">
                    @error('lessons_count')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group-half">
                    <label for="is_featured">Featured</label>
                    <div class="checkbox-wrapper">
                        <input type="checkbox" id="is_featured" name="is_featured" {{ old('is_featured') ? 'checked' : '' }}>
                        <label for="is_featured">Centang jika ingin ditampilkan sebagai featured</label>
                    </div>
                    @error('is_featured')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            
            <div class="form-group">
                <label for="image_path">Gambar Course (Opsional)</label>
                <input type="file" id="image_path" name="image_path" accept="image/*" class="form-control">
                @error('image_path')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-large">Simpan Course</button>
                <a href="{{ route('courses') }}" class="btn btn-secondary btn-large">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection