@extends('layouts.admin')

@section('title')
    Admin - Blog Create
@endsection

@section('content')
    @include('admin.blog.form', [
        'route'       => route('admin_blog_create'),
        'button_text' => 'Add Post',
        'title'       => 'Add New Blog Post'
    ])
@endsection

@push('page_scripts')
    <script type="text/javascript" src="{{ mix('/js/pages/blog/form.js') }}"></script>
@endpush
