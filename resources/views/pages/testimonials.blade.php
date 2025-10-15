@extends('layouts.app')

@section('content')
<br>
<br>
<br>

<div class="container">
    <h1 class="text-center mb-8">Testimoni Member RUANGKASEP</h1>
    
    <div class="testimonials-grid">
        @foreach($testimonials as $testimonial)
        <div class="testimonial-card">
            <div class="testimonial-content">
                "{{ $testimonial->content }}"
            </div>
            <div class="testimonial-author">
                <div class="author-avatar">A</div>
                <div class="author-info">
                    <h4>{{ $testimonial->name }}</h4>
                    <p>{{ $testimonial->role }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<br>
<br>
<br>
<br>
<br>
@endsection