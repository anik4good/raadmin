<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
<head>
    <title>@yield('title','') | Radmin - Laravel Admin Starter</title>
    <!-- initiate head with meta tags, css and script -->
    @include('layouts.backend.partials.head')

</head>
<body id="app" >
<div class="wrapper">
    <!-- initiate header-->
    @include('layouts.backend.partials.header')
    <div class="page-wrap">
        <!-- initiate sidebar-->
        @include('layouts.backend.partials.sidebar')

        <div class="main-content">
            <!-- yeild contents here -->
            @yield('content')
        </div>

        <!-- initiate chat section-->
        @include('layouts.backend.partials.chat')


    <!-- initiate footer section-->
        @include('layouts.backend.partials.footer')

    </div>
</div>

<!-- initiate modal menu section-->
@include('layouts.backend.partials.modalmenu')

<!-- initiate scripts-->
@include('layouts.backend.partials.script')
</body>
</html>
