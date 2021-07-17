<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
<head>
	<title>@yield('title','') | Radmin - Laravel Admin Starter</title>
	<!-- initiate head with meta tags, css and script -->

	@include('layouts.backend.partials.head')

<!-- Stack array for including inline css -->
    @stack('css')

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
{{--			@include('layouts.backend.partials.chat')--}}


	    	<!-- initiate footer section-->
			@include('layouts.backend.partials.footer')
            @notifyCss
            <style>
                .inset-0 {
                    top: 39px;
                    right: 0;
                    bottom: 0;
                    left: 0;
                }
            </style>
    	</div>
    </div>

	<!-- initiate modal menu section-->
{{--	@include('layouts.backend.partials.modalmenu')--}}

	<!-- initiate scripts-->
	@include('layouts.backend.partials.script')

    <!-- Stack array for including inline script -->
    @stack('js')
</body>
</html>
