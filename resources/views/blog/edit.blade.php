@extends('layouts.app')

@section('content')
<div class="container">
    <div class="blog-form-container">
        <h1 class="form-title">Edit Post</h1>
        
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
        
        <form method="POST" action="{{ route('blog.update', $post->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="title">Judul Post</label>
                <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}" required class="form-control">
                @error('title')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="excerpt">Excerpt</label>
                <textarea id="excerpt" name="excerpt" rows="4" required class="form-control">{{ old('excerpt', $post->excerpt) }}</textarea>
                @error('excerpt')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="content">Content</label>
                <textarea id="content" name="content" rows="15" required class="form-control ckeditor">{{ old('content', $post->content) }}</textarea>
                @error('content')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-row">
                <div class="form-group-half">
                    <label for="status">Status</label>
                    <select id="status" name="status" required class="form-control">
                        <option value="draft" {{ $post->status == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ $post->status == 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                    @error('status')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                
             <!-- Di bagian featured image -->
<div class="form-group-half">
    <label for="featured_image">Featured Image (Opsional)</label>
    <input type="file" id="featured_image" name="featured_image" accept="image/*" class="form-control">
    <small class="form-text text-muted">Ukuran maksimal 2MB, resolusi maks 1920x1080 pixel</small>
    @if(isset($post) && $post->featured_image)
        <p>Gambar saat ini: {{ basename($post->featured_image) }}</p>
        <img src="{{ asset('storage/' . $post->featured_image) }}" alt="Current Image" style="max-width: 200px; margin-top: 10px;">
    @endif
    @error('featured_image')
        <span class="error-message">{{ $message }}</span>
    @enderror
</div>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-large">Update Post</button>
                <a href="{{ route('blog') }}" class="btn btn-secondary btn-large">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection