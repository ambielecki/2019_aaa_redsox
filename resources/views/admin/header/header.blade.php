{{-- Main Nav Dropdowns --}}
<ul id="image_dropdown" class="dropdown-content">
    <li><a href="{{ route('admin_image_list') }}">Image List</a></li>
    <li><a href="{{ route('admin_image_create') }}">Upload Image</a></li>
</ul>

<ul id="blog_dropdown" class="dropdown-content">
    <li><a href="{{ route('admin_blog_list') }}">Blog List</a></li>
    <li><a href="{{ route('admin_blog_create') }}">Create Post</a></li>
</ul>

<ul id="event_dropdown" class="dropdown-content">
    <li><a href="{{ route('admin_event_list') }}">Event List</a></li>
    <li><a href="{{ route('admin_event_create') }}">Create Event</a></li>
</ul>

<ul id="login_dropdown" class="dropdown-content">
    <li><a href="{{ route('login') }}">Log In</a></li>
    <li><a href="{{ route('register') }}">Register</a></li>
</ul>

<ul id="logout_dropdown" class="dropdown-content text-blue">
    <li><a href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            Log Out
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>
    <li><a href="#">Settings</a></li>
</ul>

{{-- Main Nav Skeleton --}}
<header>
    <nav>
        <div class="nav-wrapper">
            <div class="row">
                <div class="col s12">
                    <a href="/" class="brand-logo">{{ config('app.name') }}</a>
                    <a href="#" data-target="mobile_nav" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                    <ul id="nav-mobile" class="right hide-on-med-and-down">
                        <li><a href="{{ route('admin_home_edit') }}">Home Page</a></li>
                        <li><a class="dropdown-trigger" href="#!" data-target="image_dropdown">Images<i class="material-icons right">arrow_drop_down</i></a></li>
                        <li><a class="dropdown-trigger" href="#!" data-target="blog_dropdown">Blog<i class="material-icons right">arrow_drop_down</i></a></li>
                        <li><a class="dropdown-trigger" href="#!" data-target="event_dropdown">Events<i class="material-icons right">arrow_drop_down</i></a></li>
                        @if (Auth::check())
                            <li><a class="dropdown-trigger" href="#!" data-target="logout_dropdown">Welcome {{ auth()->user()->first_name }}<i class="material-icons right">arrow_drop_down</i></a></li>
                        @else
                            <li><a class="dropdown-trigger" href="#!" data-target="login_dropdown">Log In / Register<i class="material-icons right">arrow_drop_down</i></a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>

{{-- Mobile Nav --}}
<ul class="sidenav" id="mobile_nav">
    <li><a href="{{ route('admin_home_edit') }}">Home Page</a></li>
    <ul class="collapsible" data-collapsible="accordian">
        <li>
            <div class="collapsible-header black-text">Images</div>
            <div class="collapsible-body side_nav_collapse">
                <ul>
                    <li><a href="{{ route('admin_image_list') }}">Image List</a></li>
                    <li><a href="{{ route('admin_image_create') }}">Upload Image</a></li>
                </ul>
            </div>
        </li>
        <li>
            <div class="collapsible-header black-text">Blog</div>
            <div class="collapsible-body side_nav_collapse">
                <ul>
                    <li><a href="{{ route('admin_blog_list') }}">Blog List</a></li>
                    <li><a href="{{ route('admin_blog_create') }}">Create Post</a></li>
                </ul>
            </div>
        </li>
        <li>
            <div class="collapsible-header black-text">Events</div>
            <div class="collapsible-body side_nav_collapse">
                <ul>
                    <li><a href="{{ route('admin_event_list') }}">Event List</a></li>
                    <li><a href="{{ route('admin_event_create') }}">Create Event</a></li>
                </ul>
            </div>
        </li>
    </ul>
    @if (Auth::check())
        <ul class="collapsible" data-collapsible="accordian">
            <li>
                <div class="collapsible-header black-text">Welcome {{ auth()->user()->first_name }}</div>
                <div class="collapsible-body side_nav_collapse">
                    <ul>
                        <li>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                Log Out
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                        <li><a href="#">Settings</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    @else
        <ul class="collapsible" data-collapsible="accordian">
            <li>
                <div class="collapsible-header black-text">Log In / Register</div>
                <div class="collapsible-body side_nav_collapse">
                    <ul>
                        <li><a href="{{ route('login') }}">Log In</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    @endif
</ul>
