@extends('layouts.admin')

@section('content')
    <div class="space-y-8">
        {{-- Page Header --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-slate-800">Profil Pengguna</h1>
        </div>

        {{-- Update Profile Information Form --}}
        <div class="bg-white rounded-2xl shadow-xl p-8 border-t-4 border-yellow-500">
            @include('profile.partials.update-profile-information-form')
        </div>

        {{-- Update Password Form --}}
        <div class="bg-white rounded-2xl shadow-xl p-8 border-t-4 border-slate-500">
            @include('profile.partials.update-password-form')
        </div>

        {{-- Delete User Form --}}
        <div class="bg-white rounded-2xl shadow-xl p-8 border-t-4 border-red-500">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
@endsection
