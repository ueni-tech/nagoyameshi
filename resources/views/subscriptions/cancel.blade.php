@extends('layouts.app')
@section('content')
<div class="container pt-4">
  {{ Breadcrumbs::render('subscription.cancel') }}
</div>
<div class="subscription pb-4">
  <div class="container d-flex justify-content-center mt-3">
    <div class="w-50">
      <div class="my-2">
        @if (session('message'))
        <div class="alert alert-success">
          {{ session('message') }}
        </div>
        @endif
      </div>
      <h1 class="text-center mb-3">有料会員解約申請</h1>
      @if(! $onGracePeriod)
      <p class="text-center">有料会員を解約すると以下の特典を受けられなくなります。</p>
      <div class="card my-4">
        <div class="card-header text-center">
          有料会員特典
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">・お店のネット予約が可能</li>
          <li class="list-group-item">・お店をお好きなだけお気に入りに追加可能</li>
          <li class="list-group-item">・レビューを投稿可能</li>
          <li class="list-group-item">・月額たったの300円</li>
          <li class="list-group-item">・お支払いはクレジットカードを登録するだけ</li>
        </ul>
      </div>
      <div class="text-center">
        <form action="{{route('subscription.delete')}}" method="post" onsubmit="return confirm('本当に解約してもよろしいですか？');">
          @csrf
          <button type="submit" class="btn btn-danger w-50">解約</button>
        </form>
      </div>
      @else
      <p class="text-center fs-4 fw-bold">解約申請済みです</p>
      <p class="text-center small">{{$user->subscription('default')->ends_at->format('Y/m/d')}}まで利用可能</p>
      <p class="text-center">利用停止までに解約申請を取り消すことが可能です</p>
      <p class="text-center">解約申請を取り消すと再度以下の特典が利用可能になります</p>
      <div class="card my-4">
        <div class="card-header text-center">
          有料会員特典
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">・お店のネット予約が可能</li>
          <li class="list-group-item">・お店をお好きなだけお気に入りに追加可能</li>
          <li class="list-group-item">・レビューを投稿可能</li>
          <li class="list-group-item">・月額たったの300円</li>
          <li class="list-group-item">・お支払いはクレジットカードを登録するだけ</li>
        </ul>
      </div>
      <div class="text-center">
        <form action="{{route('subscription.resume')}}" method="post">
          @csrf
          <button type="submit" class="btn btn-primary bg_main w-50">解約申請を取り消す</button>
        </form>
      </div>
      @endif
    </div>
  </div>
</div>

@endsection