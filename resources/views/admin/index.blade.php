@extends('layouts.admin')

@section('title')
    Admin
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Home Page</span>
                        <ul>
                            <li><a href="{{ route('admin_home_edit') }}">Edit Home Page</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Blog</span>
                        <ul>
                            <li><a href="{{ route('admin_blog_list') }}">Blog List</a></li>
                            <li><a href="{{ route('admin_blog_create') }}">Blog Create</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Images</span>
                        <ul>
                            <li><a href="{{ route('admin_image_list') }}">Image List</a></li>
                            <li><a href="{{ route('admin_image_create') }}">Image Create</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Events</span>
                        <ul>
                            <li><a href="{{ route('admin_event_list') }}">Event List</a></li>
                            <li><a href="{{ route('admin_event_create') }}">Event Create</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('body_scripts')

@endpush
