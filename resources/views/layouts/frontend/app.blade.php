<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ setting('site_title', 'LaraStarter') }} | @yield('title')</title>
    <link rel="icon"  href="{{ setting('site_favicon') != null ? Storage::disk('public')->url(setting('site_favicon')) : '' }}"/>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- google_font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@600;700&family=Poppins:wght@400;500&display=swap"
        rel="stylesheet">
    <!-- font_awesome -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- Styles -->
{{--        <link href="{{ asset('public/css/frontend.css') }}" rel="stylesheet">--}}
    {{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('assets/frontend/CSS/style.css') }}" rel="stylesheet">
    @stack('css')
</head>
<body>


@yield('content')




@stack('js')

</body>
</html>
