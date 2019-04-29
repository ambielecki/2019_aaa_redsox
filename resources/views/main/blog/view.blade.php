@extends('layouts.main')

@section('title')
    {{ config('app.name') }} - {{ $post->title }}
@stop

@section('content')
    <div class="row">
        <div class="col s12 m6 offset-m3">
            <div class="card blog_card" style="clear: both">
                <div class="card-content">
                    <div class="row">
                        <div class="col s12">
                            <span class="card-title blue-text text-darken-4">{{ $post->title }}</span>
                            <h6 class="grey-text">Updated At: {{ date('Y-m-d', strtotime($post->updated_at)) }}</h6>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col s12">
                            {!! $content['content'] !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col s12">
                            <a class="btn" href="{{ route('blog_list') }}">Go To Blog List</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('page_scripts')

@endpush
