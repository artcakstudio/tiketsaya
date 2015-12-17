<html>
    <head>
        <title>App Name - @yield('title')</title>
    </head>
    <body>
        @section('sidebar')
            This is the master sidebar.
        @show
        @section('lala')
        <h1>lalal</h1>
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>