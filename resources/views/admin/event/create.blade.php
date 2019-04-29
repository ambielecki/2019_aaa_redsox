@extends('layouts.admin')

@section('title')
    Admin - Event Create
@endsection

@section('content')
    @include('admin.event.form', [
        'route'       => route('admin_event_create'),
        'button_text' => 'Add Event',
        'title'       => 'Add New Event'
    ])
@endsection

@push('page_scripts')
    <script type="text/javascript" src="{{ mix('/js/pages/event/form.js') }}"></script>
@endpush
