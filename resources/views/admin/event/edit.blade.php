@extends('layouts.admin')

@section('title')
    Admin - Event Edit
@endsection

@section('content')
    @include('admin.event.form', [
        'route'       => route('admin_event_create'),
        'button_text' => 'Edit Event',
        'title'       => 'Edit Event'
    ])
@endsection

@push('page_scripts')
    <script type="text/javascript" src="{{ mix('/js/pages/event/form.js') }}"></script>
@endpush
