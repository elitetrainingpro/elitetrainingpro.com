<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
<body>
    @include('includes.header')
    <div id="main">
        @yield('content')
    </div>
    <footer class="row">
        @include('includes.footer')
    </footer>
</div>
</body>
</html>