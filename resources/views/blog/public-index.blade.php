@extends('layouts.app')

@section('content')
<div class="container">
    <div class="blog-public-container">
        <div class="blog-header">
            <h1>Blog & Artikel</h1>
            <p></p>
        </div>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        <div class="blog-posts-grid">
            @forelse($posts as $post)
            <article class="blog-post-card">
                <div class="blog-post-image-wrapper">
                    @if($post->featured_image)
                        <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="blog-post-image">
                    @else
                        <img src="{{ asset('images/default-blog-image.jpg') }}" alt="{{ $post->title }}" class="blog-post-image">
                    @endif
                </div>
                <div class="blog-post-content">
                    <div class="blog-post-meta">
                        <span class="post-date">{{ $post->created_at->format('d M Y') }}</span>
                        <span class="post-author">Oleh {{ $post->author->name }}</span>
                    </div>
                    <h2 class="blog-post-title">
                        <a href="{{ route('blog.public.show', $post->id) }}">{{ $post->title }}</a>
                    </h2>
                    <p class="blog-post-excerpt">{{ $post->excerpt }}</p>
                    <div class="blog-post-footer">
                        <a href="{{ route('blog.public.show', $post->id) }}" class="read-more-btn">Baca Selengkapnya</a>
                    </div>
                </div>
            </article>
            @empty
            <div class="no-posts">
                <p>Tidak ada artikel yang tersedia.</p>
            </div>
            @endforelse
        </div>
        
        <div class="pagination-wrapper">
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection