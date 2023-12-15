@include('components.common.head')

<body>
    <div id="app">
    @include('components.common.header')

        <main class="pb-4">
            @yield('content')
        </main>

        @include('components.common.footer')
    </div>
    @stack('scripts')
</body>
</html>
