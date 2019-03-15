@extends('layouts.main')

@section('title')
    DiveLogRepeat - Blog Posts
@stop

@section('content')
    <div class="row" id="blog_list">
        <div class="col s12 m6 offset-m3">
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
            <div v-else-if="posts.length > 0"><blog-item  v-for="post in posts" :post="post"></blog-item></div>
            <div v-else class="card col s12">
                <div class="card-content">
                    <span class="card-title">No Posts Found</span>
                    <p>Please come back soon for exciting content!</p>
                </div>
            </div>
        </div>
    </div>
@stop

@push('page_scripts')
    <script type="text/javascript" src="{{ mix('/js/pages/blog/list.js') }}"></script>
@endpush
