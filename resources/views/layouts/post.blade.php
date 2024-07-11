<head>
    <title>@yield('title')</title>
</head>

<body>
    <!-- Header -->
    <h1>@yield('header')</h1>

    <!-- Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @yield('footer')

    <!-- JS -->
    @yield('page-js')
</body>

