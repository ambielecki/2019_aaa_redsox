@extends('layouts.main')

@section('title')
    {{ config('app.name') }} - Blog Posts
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

            <div v-else-if="posts.length > 0">
                <div v-for="post in posts" class="card blog_card col s12">
                    <div class="card-content">
                        <blog-item :post="post"></blog-item>
                    </div>
                </div>
            </div>

            <div v-else class="card col s12">
                <div class="card-content">
                    <span class="card-title">No Posts Found</span>
                    <p>Please come back soon for exciting content!</p>
                </div>
            </div>

            <div v-if="pages > 1">
                <div class="card col s12">
                    <div class="card-content">
                        <page-list :page="page" :pages="pages" :links="false" @page_clicked="paginationClick"></page-list>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('page_scripts')
    <script type="text/javascript" src="{{ mix('/js/pages/blog/list.js') }}"></script>
@endpush
