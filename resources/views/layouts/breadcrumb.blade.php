<div class="breadcrumb">
    <h1>@yield('title') | </h1>
    <ul>
        </li>
        @if(\Request::segment(2) != "")
            <li>{{\Request::segment(1)}}</li>
            <li>@yield('title')</li>
        @else
            <li>@yield('title')</li>
        @endif
    </ul>
</div>
<div class="separator-breadcrumb border-top"></div>