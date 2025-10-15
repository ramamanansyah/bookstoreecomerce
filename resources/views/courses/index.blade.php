@extends('layouts.app')

@section('content')
<div class="container">
    <div class="courses-page">
        <div class="courses-header">
            <h1>E-Course</h1>
            <div class="courses-actions">
                @auth
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('courses.create') }}" class="btn btn-primary">Tambah Course Baru</a>
                    @endif
                @endauth
            </div>
        </div>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        <div class="courses-grid">
            @forelse($courses as $course)
            <div class="course-card">
                <div class="course-image">
                    @if($course->image_path)
                        <img src="{{ asset('storage/' . $course->image_path) }}" alt="{{ $course->title }}">
                    @else
                        <div class="course-placeholder">Gambar Course</div>
                    @endif
                </div>
                <div class="course-content">
                    <h3>{{ $course->title }}</h3>
                    <span class="course-level">{{ $course->level }}</span>
                    <div class="course-meta">
                        <span>{{ $course->students_count }} siswa</span>
                        <span>{{ $course->lessons_count }} pelajaran</span>
                    </div>
                    <div class="course-price">
                        @if($course->price)
                            Rp{{ number_format($course->price, 0, ',', '.') }}
                        @else
                            Gratis
                        @endif
                    </div>
                    @auth
                        @if(Auth::user()->isAdmin())
                            <div class="course-admin-actions">
                                <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                                <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus course ini?')">Hapus</button>
                                </form>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
            @empty
            <div class="no-courses">
                <p>Tidak ada course tersedia.</p>
            </div>
            @endforelse
        </div>
        
        <div class="pagination">
            {{ $courses->links() }}
        </div>
    </div>
</div>
@endsection