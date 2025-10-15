@extends('layouts.app')

@section('content')
<div class="container">
    <div class="book-form-container">
        <h1 class="form-title">Edit Buku</h1>
        
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
        
        <form method="POST" action="{{ route('books.update', $book->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="title">Judul Buku</label>
                <input type="text" id="title" name="title" value="{{ old('title', $book->title) }}" required class="form-control">
                @error('title')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea id="description" name="description" rows="4" required class="form-control">{{ old('description', $book->description) }}</textarea>
                @error('description')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="author">Penulis</label>
                <input type="text" id="author" name="author" value="{{ old('author', $book->author) }}" required class="form-control">
                @error('author')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-row">
                <div class="form-group-half">
                    <label for="price">Harga (Rp)</label>
                    <input type="number" id="price" name="price" value="{{ old('price', $book->price) }}" step="1000" class="form-control">
                    @error('price')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group-half">
                    <label for="rating">Rating</label>
                    <input type="number" id="rating" name="rating" value="{{ old('rating', $book->rating) }}" min="0" max="5" class="form-control">
                    @error('rating')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group-half">
                    <label for="review_count">Jumlah Review</label>
                    <input type="number" id="review_count" name="review_count" value="{{ old('review_count', $book->review_count) }}" min="0" class="form-control">
                    @error('review_count')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group-half">
                    <label for="is_featured">Featured</label>
                    <div class="checkbox-wrapper">
                        <input type="checkbox" id="is_featured" name="is_featured" {{ old('is_featured', $book->is_featured) ? 'checked' : '' }}>
                        <label for="is_featured">Centang jika ingin ditampilkan sebagai featured</label>
                    </div>
                    @error('is_featured')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            
            <div class="form-group">
                <label for="cover_image">Cover Buku (Opsional)</label>
                <input type="file" id="cover_image" name="cover_image" accept="image/*" class="form-control">
                @if($book->cover_image)
                    <p>Gambar saat ini: {{ basename($book->cover_image) }}</p>
                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Current Cover" style="max-width: 200px; margin-top: 10px;">
                @endif
                @error('cover_image')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="pdf_file">File PDF (Opsional)</label>
                <input type="file" id="pdf_file" name="pdf_file" accept=".pdf" class="form-control">
                @if($book->pdf_file)
                    <p>File PDF saat ini: {{ basename($book->pdf_file) }}</p>
                @endif
                @error('pdf_file')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-large">Update Buku</button>
                <a href="{{ route('books') }}" class="btn btn-secondary btn-large">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection