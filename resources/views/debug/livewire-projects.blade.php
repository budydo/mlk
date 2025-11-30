{{-- resources/views/debug/livewire-projects.blade.php --}}
@extends('layouts.dashboard')

@section('title','Debug Livewire Projects')

@section('content')
    {{-- Render komponen ProjectManager untuk debugging (tidak memerlukan auth) --}}
    @livewire('project-manager')
@endsection
