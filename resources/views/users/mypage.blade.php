@extends('layouts.app')
@section('content')
<div class="container pt-4">
  {{ Breadcrumbs::render('mypage') }}
</div>
<div class="mypage pb-4">
  <div class="container mt-3">
    <div class="w-75 m-auto">
      <h1>マイページ</h1>
      <hr>
      @if (auth()->user()->subscribed('default'))
      <a href="{{route('mypage.reviews')}}" class="text-black">
        <div class="container">
          <div class="row justify-content-between align-items-center">
            <div class="col-9 d-flex align-items-center">
              <div class="me-1 col-3 text-center">
                <i class="fa-solid fa-pencil fa-3x"></i>
              </div>
              <div class="ms-2 mt-3">
                <div class="d-flex flex-column">
                  <span class="fw-bold">あなたのレビュー</span>
                  <p>投稿したレビューの一覧</p>
                </div>
              </div>
            </div>
            <div class="col-1">
              <i class="fas fa-chevron-right fa-2x"></i>
            </div>
          </div>
        </div>
      </a>

      <hr>

      <a href="{{route('mypage.favorite')}}" class="text-black">
        <div class="container">
          <div class="row justify-content-between align-items-center">
            <div class="col-9 d-flex align-items-center">
              <div class="me-1 col-3 text-center">
                <i class="fa-solid fa-heart fa-3x"></i>
              </div>
              <div class="ms-2 mt-3">
                <div class="d-flex flex-column">
                  <span class="fw-bold">お気に入り店舗</span>
                  <p>お気に入り店舗の一覧</p>
                </div>
              </div>
            </div>
            <div class="col-1">
              <i class="fas fa-chevron-right fa-2x"></i>
            </div>
          </div>
        </div>
      </a>

      <hr>

      <a href="{{route('mypage.reservations')}}" class="text-black">
        <div class="container">
          <div class="row justify-content-between align-items-center">
            <div class="col-9 d-flex align-items-center">
              <div class="me-1 col-3 text-center">
                <i class="fa-regular fa-calendar-days fa-3x"></i>
              </div>
              <div class="ms-2 mt-3">
                <div class="d-flex flex-column">
                  <span class="fw-bold">予約一覧</span>
                  <p>予約の確認</p>
                </div>
              </div>
            </div>
            <div class="col-1">
              <i class="fas fa-chevron-right fa-2x"></i>
            </div>
          </div>
        </div>
      </a>

      <hr>
      @endif

      <a href="{{route('mypage.edit')}}" class="text-black">
        <div class="container">
          <div class="row justify-content-between align-items-center">
            <div class="col-9 d-flex align-items-center">
              <div class="me-1 col-3 text-center">
                <i class="fas fa-user fa-3x"></i>
              </div>
              <div class="ms-2 mt-3">
                <div class="d-flex flex-column">
                  <span class="fw-bold">会員情報の編集</span>
                  <p>アカウント情報の編集</p>
                </div>
              </div>
            </div>
            <div class="col-1">
              <i class="fas fa-chevron-right fa-2x"></i>
            </div>
          </div>
        </div>
      </a>

      <hr>

      @if (!auth()->user()->subscribed('default'))
      <a href="{{route('subscription')}}" class="text-black">
        <div class="container">
          <div class="row justify-content-between align-items-center">
            <div class="col-9 d-flex align-items-center">
              <div class="me-1 col-3 text-center">
                <i class="fa-solid fa-circle-dollar-to-slot fa-3x"></i>
              </div>
              <div class="ms-2 mt-3">
                <div class="d-flex flex-column">
                  <span class="fw-bold">有料会員登録</span>
                  <p>有料会員登録を開始する</p>
                </div>
              </div>
            </div>
            <div class="col-1">
              <i class="fas fa-chevron-right fa-2x"></i>
            </div>
          </div>
        </div>
      </a>

      <hr>
      @endif

      @if (auth()->user()->subscribed('default'))
      <a href="{{route('subscription.edit')}}" class="text-black">
        <div class="container">
          <div class="row justify-content-between align-items-center">
            <div class="col-9 d-flex align-items-center">
              <div class="me-1 col-3 text-center">
                <i class="fa-solid fa-credit-card fa-3x"></i>
              </div>
              <div class="ms-2 mt-3">
                <div class="d-flex flex-column">
                  <span class="fw-bold">クレジットカード情報</span>
                  <p>クレジットカード情報の確認・更新</p>
                </div>
              </div>
            </div>
            <div class="col-1">
              <i class="fas fa-chevron-right fa-2x"></i>
            </div>
          </div>
        </div>
      </a>

      <hr>

      <a href="{{route('subscription.cancel')}}" class="text-black">
        <div class="container">
          <div class="row justify-content-between align-items-center">
            <div class="col-9 d-flex align-items-center">
              <div class="me-1 col-3 text-center">
                <i class="fa-solid fa-ban fa-3x"></i>
              </div>
              <div class="ms-2 mt-3">
                <div class="d-flex flex-column">
                  <span class="fw-bold">有料会員解約申請</span>
                  <p>有料会員解約の申請をする</p>
                </div>
              </div>
            </div>
            <div class="col-1">
              <i class="fas fa-chevron-right fa-2x"></i>
            </div>
          </div>
        </div>
      </a>

      <hr>
      @endif

      <a href="{{ route('logout') }}" onclick="event.preventDefault(); if(confirm('ログアウトしてもよろしいですか？')) document.getElementById('logout-form').submit();" class="text-black">
        <div class="container">
          <div class="row justify-content-between align-items-center">
            <div class="col-9 d-flex align-items-center">
              <div class="me-1 col-3 text-center">
                <i class="fas fa-sign-out-alt fa-3x"></i>
              </div>
              <div class="ms-2 mt-3">
                <div class="d-flex flex-column">
                  <span class="fw-bold">ログアウト</span>
                  <p>ログアウトします</p>
                </div>
              </div>
            </div>
            <div class="col-1">
              <i class="fas fa-chevron-right fa-2x"></i>
            </div>
          </div>
        </div>
      </a>
      <hr>
    </div>
  </div>
</div>
@endsection