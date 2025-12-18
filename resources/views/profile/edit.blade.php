@extends('layouts.navigation')

@section('content')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
<div class="profile-container">
    <h1 class="page-title">
        <i class="fas fa-user-circle"></i>
        Profil Saya
    </h1>

    <div class="profile-content">
        <div class="profile-card">
            <div class="profile-header">
                <div class="profile-photo-section">
                    <div class="current-photo">
                        @if(Auth::user()->profile_photo)
                            <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Profile Photo">
                        @else
                            <div class="default-avatar">
                                <i class="fas fa-user"></i>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="profile-info">
                    <h2>{{ Auth::user()->name }}</h2>
                    <p>{{ Auth::user()->email }}</p>
                </div>
            </div>

            @include('profile.partials.update-profile-information-form')
        </div>

        <div class="profile-card">
            @include('profile.partials.update-password-form')
        </div>

        <div class="profile-card">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</div>
@endsection
