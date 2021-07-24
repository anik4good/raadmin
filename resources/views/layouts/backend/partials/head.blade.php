<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="icon"  href="{{ setting('site_favicon') != null ? Storage::disk('public')->url(setting('site_favicon')) : '' }}"/>
<!-- font awesome library -->
<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">

@notifyCss
<style>
    .inset-0 {
        top: 39px;
        right: 0;
        bottom: 0;
        left: 0;
    }
</style>


<script src="{{ asset('js/app.js') }}"></script>

<!-- themekit admin template asstes -->
<link rel="stylesheet" href="{{ asset('all.css') }}">
<link rel="stylesheet" href="{{ asset('dist/css/theme.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/icon-kit/dist/css/iconkit.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/ionicons/dist/css/ionicons.min.css') }}">


<!-- Stack array for including inline css or head elements -->
@stack('head')

<link rel="stylesheet" href="{{ asset('css/style.css') }}">


