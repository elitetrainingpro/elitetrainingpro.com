<!doctype html>
<html>
<head>
    @include('includes._head')
    @yield('stylesheets')
    @yield('scripts')
</head>
<body>
    @include('includes._header')
    <div id="main">
        @yield('content')
    </div>
    <footer class="row">
        @include('includes._footer')
    </footer>
</body>
</html>