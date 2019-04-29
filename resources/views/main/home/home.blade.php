@extends('layouts.main')

@section('title')
    {{ config('app.name') . ' - Home' }}
@endsection

@section('content')
    @if (isset($content['hero_image']))
        <div class="row hero_image_block">
            <img class="hero_image" alt="{{ $content['hero_image']['caption'] ?? 'Welcome To ' . config('app.name') }}" src="/{{ $content['hero_image']['folder'] . $content['hero_image']['file_name'] }}">
            <div class="hero_text">
                {{ $content['hero_image']['title'] ?: 'Welcome To DiveLogRepeat' }}
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <div class="col s12 m8 push-m4">
                            <span class="card-title">{!! $content['title'] ?? '' !!}</span>
                            {!! $content['content'] ?? 'What No Content?' !!}
                        </div>

                        <div class="col m4 s12 pull-m8">
                            @if (!empty($content['carousel_images']['images']))
                                <div class="carousel carousel-slider center">
                                    @foreach ($content['carousel_images']['images'] as $image)
                                        <a class="carousel-item" href="/{{ $image['folder'] }}{{ $image['file_name'] }}">
                                            {{--<h5 class="carousel_text white-text">{{ $image['title'] }}</h5>--}}
                                            <img src="/{{ $image['folder'] }}{{ $image['has_sizes'] ? 'medium/' : '' }}{{ $image['file_name'] }}" alt="{{ $image['description'] ?? 'DiveLogRepeat' }}" title="{{ $image['title'] }}">
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
