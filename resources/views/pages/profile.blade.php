@extends('layouts.app')

@section('content')
<div class="container">
    <div class="profile">
        <h1>Profil Pengguna</h1>
        
        <div class="profile-info">
            <div class="profile-header">
                <div class="profile-avatar">
                    @if(Auth::user()->avatar)
                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar" class="avatar-img">
                    @else
                        <i class="fas fa-user fa-3x"></i>
                    @endif
                </div>
                <div class="profile-details">
                    <h2>{{ Auth::user()->name }}</h2>
                    <p>{{ Auth::user()->email }}</p>
                    <p>Anggota sejak: {{ Auth::user()->created_at->format('d M Y') }}</p>
                </div>
            </div>
            
            <div class="profile-form">
                <h3>Edit Profil</h3>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <input type="text" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="avatar">Foto Profil</label>
                        <input type="file" id="avatar" name="avatar" accept="image/*">
                        @if(Auth::user()->avatar)
                            <p>Foto profil saat ini: {{ basename(Auth::user()->avatar) }}</p>
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection