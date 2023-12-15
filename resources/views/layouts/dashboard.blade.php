@include('components.common.head')

<body>
  <div id="app">
    @include('components.dashboard.header')
    <div class="container mt-4">
      <div class="row">
        @if(Auth::guard('admins')->check())
        <div class="col-2 mt-3">
          @include('components.dashboard.sidebar')
        </div>
        @endauth
        <div class="col-10">
          <main class="py-4 mb-5">
            @yield('content')
          </main>
        </div>
      </div>
    </div>
  </div>
</body>

</html>