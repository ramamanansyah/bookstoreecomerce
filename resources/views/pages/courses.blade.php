@extends('layouts.app')

@section('content')
<br>
<br>
<br>
<div class="container">
    <h1 class="text-center mb-8">Semua E-Course</h1>
    
    <div class="courses-grid">
        @foreach($courses as $course)
        <div class="course-card">
            <div class="course-img">Gambar Kursus</div>
            <div class="course-content">
                <h3>{{ $course->title }}</h3>
                <span class="course-level">{{ $course->level }}</span>
                <div class="course-meta">
                    <span>{{ $course->students_count }} siswa</span>
                    <span>{{ $course->lessons_count }} pelajaran</span>
                </div>
                <a href="#" class="btn btn-primary">Lihat Detail</a>
            </div>
        </div>
        @endforeach
    </div>
    
    <!-- Pagination -->
    <div class="pagination mt-8 text-center">
        {{ $courses->links() }}
    </div>
</div>
<br>
<br>
<br>
@endsection