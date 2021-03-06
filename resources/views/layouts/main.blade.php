@extends('layouts.shell')

@section('layout')
    @include('main.header.header')
    <main>
        @include('shared.flash_message')
        @yield('content')
    </main>
    @include('shared.footer')
@endsection

@push('body_scripts')
    @stack('page_scripts')
@endpush
