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

    <div class="row" id="home_app">
        <div class="col m8 s12">
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

        <div class="col m4 s12">
            <div class="row">
                <div class="col s12">
                    <div v-if="events_loading" class="card center-align">
                        <div class="preloader-wrapper big active">
                            <div class="spinner-layer spinner-blue-only">
                                <div class="circle-clipper left">
                                    <div class="circle"></div>
                                </div><div class="gap-patch">
                                    <div class="circle"></div>
                                </div><div class="circle-clipper right">
                                    <div class="circle"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-else-if="events.length > 0">
                        <div class="card blog_card col s12">
                            <div class="card-content">
                                <event-item
                                    v-for="(event, index) in events"
                                    :event="event"
                                    :hr="true"
                                    :length="events.length"
                                    :index="index"
                                ></event-item>
                            </div>
                        </div>
                    </div>

                    <div v-else>
                        <div class="card blog_card col s12">
                            <div class="card-content">
                                <div>
                                    <div class="row">
                                        <div class="col s12">
                                            <span class="card-title">No Events in the Next 7 Days</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col sm12">
                                            <a class="btn" href="/event/list">View All Events</a>
                                        </div>
                                    </div>
                                    <hr v-if="hr && index < length - 1">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col m8 s12">
            <div class="row">
                <div class="col s12">
                    <div v-if="posts_loading" class="card center-align">
                        <div class="preloader-wrapper big active">
                            <div class="spinner-layer spinner-blue-only">
                                <div class="circle-clipper left">
                                    <div class="circle"></div>
                                </div><div class="gap-patch">
                                    <div class="circle"></div>
                                </div><div class="circle-clipper right">
                                    <div class="circle"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-else-if="posts.length > 0">
                        <div class="card blog_card col s12">
                            <div class="card-content">
                                <blog-item
                                    v-for="(post, index) in posts"
                                    :post="post"
                                    :hr="true"
                                    :length="posts.length"
                                    :index="index"
                                ></blog-item>
                                <div v-if="pages > 1" class="row">
                                    <hr>
                                    <div class="col sm12">
                                        <a class="btn" href="/blog/list">View Older Posts</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page_scripts')
    <script type="text/javascript" src="{{ mix('/js/pages/home/home.js') }}"></script>
@endpush
