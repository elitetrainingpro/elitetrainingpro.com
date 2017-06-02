<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    @include('includes._loginHead')

	@yield('stylesheets')
    @yield('scripts')

</head>
<body>
    <div id="app">
        @yield('navbar')

        @yield('content')
    </div>
	<footer class="row">
        @include('includes._footer')
    </footer>

</body>
</html>
