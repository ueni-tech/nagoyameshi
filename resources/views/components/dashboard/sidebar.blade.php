<div class="container ms-3">
  <h2 class="fs-5">管理画面</h2>
  <div class="d-flex flex-column mb-2">
    <label>
      <a href="{{route('dashboard.index')}}">トップページ</a>
    </label>
  </div>

  <h2 class="fs-5">会員管理</h2>
  <div class="d-flex flex-column mb-2">
    <label>
      <a href="{{route('dashboard.users.index')}}">会員一覧</a>
    </label>
  </div>

  <h2 class="fs-5">店舗管理</h2>
  <div class="d-flex flex-column mb-2">
    <label>
      <a href="{{route('dashboard.restaurants.index')}}">店舗一覧</a>
    </label>
  </div>

  <h2 class="fs-5">カテゴリ管理</h2>
  <div class="d-flex flex-column mb-2">
    <label>
      <a href="{{route('dashboard.categories.index')}}">カテゴリ一覧</a>
    </label>
  </div>

  <h2 class="fs-5">その他</h2>
  <div class="d-flex flex-column mb-2">
    <label>
      <a href="{{route('dashboard.company.index')}}">会社概要 確認・編集</a>
    </label>
  </div>

  <hr>

  <div class="d-flex flex-column mb-2">
    <label>
      <form action="{{route('dashboard.logout')}}" method="POST" onsubmit="return confirm('ログインしてよろしいですか？')">
        @csrf
        <button type="submit" class="btn btn-outline-secondary btn-sm">ログアウト</button>
      </form>
    </label>
  </div>
</div>