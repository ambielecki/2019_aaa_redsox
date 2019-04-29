@extends('layouts.main')

@section('title')
    {{ config('app.name') }} - 404
@stop

@section('content')
    <div class="row">
        <div class="col s12 m6 offset-m3">
            <div class="center-align white">
                <h3 class="blue-text text-darken-4">{{ $exception->getStatusCode() }} : {{ $exception->getMessage() ?: 'Sorry, We Cannot Find the Page You Are Looking For' }}</h3>
                <img src="/images/errors/404.jpg" alt="{{ $exception->getMessage() ?: 'Sorry, We Cannot Find the Page You Are Looking For' }}">
            </div>
        </div>
    </div>
@stop

@push('page_scripts')

@endpush
