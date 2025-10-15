@extends('layouts.app')

@section('content')
<div class="container">
    <div class="blog-container">
        <div class="blog-header">
            <h1>Blog CMS</h1>
            <a href="{{ route('blog.create') }}" class="btn btn-primary">Tambah Post Baru</a>
        </div>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        <div class="blog-posts">
            @forelse($posts as $post)
            <div class="blog-post-card">
                <h3>{{ $post->title }}</h3>
                <p class="post-excerpt">{{ $post->excerpt }}</p>
                <div class="post-meta">
                    <span>Status: <strong>{{ ucfirst($post->status) }}</strong></span>
                    <span>Oleh: {{ $post->author->name }}</span>
                    <span>{{ $post->created_at->format('d M Y H:i') }}</span>
                </div>
                <div class="post-actions">
                    <a href="{{ route('blog.edit', $post->id) }}" class="btn btn-secondary">Edit</a>
                    <form action="{{ route('blog.destroy', $post->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus post ini?')">Hapus</button>
                    </form>
                </div>
            </div>
            @empty
            <p>Tidak ada post tersedia.</p>
            @endforelse
        </div>
        
        <div class="pagination">
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection