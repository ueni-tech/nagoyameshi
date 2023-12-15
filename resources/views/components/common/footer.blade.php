<footer class="bg-light p-2">
  <div class="container">
    <div class="d-flex justify-content-center mb-1">
      <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
        <img src="{{asset('img/page-icon.png')}}" alt="" width="20" height="20" class="logo me-1"><span class="fs-4">{{ config('app.name', 'Laravel') }}</span>
      </a>
    </div>
    <div class="d-flex justify-content-center mb-1">
      <a href="{{route('company.index')}}" class="link-secondary me-3">会社概要</a>
      <a href="{{url('/terms')}}" class="link-secondary">利用規約</a>
    </div>
    <p class="text-muted text-center small mb-0">&copy; NAGOYAMESHI All rights reserved.</p>
  </div>
</footer>