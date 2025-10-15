@extends('layouts.app')

@section('content')
<div class="container">
    <div class="blog-post-detail">
        <h1>{{ $post->title }}</h1>
        <div class="post-meta">
            <span>Oleh: {{ $post->author->name }}</span>
            <span>{{ $post->created_at->format('d M Y H:i') }}</span>
        </div>
        
        @if($post->featured_image)
            <div class="blog-post-image-detail">
                <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="detail-image">
            </div>
        @endif
        
        <div class="post-content">
            {!! $post->content !!}
        </div>
        <a href="{{ route('blog.public') }}" class="btn btn-secondary">Kembali ke Daftar Blog</a>
    </div>
</div>
@endsection