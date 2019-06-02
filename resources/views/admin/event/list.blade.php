@extends('layouts.admin')

@section('title')
    Admin - Event List
@endsection

@section('content')
    @include('admin.event.form', [
        'route'       => route('admin_event_create'),
        'button_text' => 'Add Event',
        'title'       => 'Add New Event'
    ])
@endsection

@push('page_scripts')
    <script type="text/javascript" src="{{ mix('/js/pages/event/admin_list.js') }}"></script>
@endpush
