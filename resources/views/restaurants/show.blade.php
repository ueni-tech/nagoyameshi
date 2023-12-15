@extends('layouts.app')
@section('content')
<div class="restaurant-page">
  <div class="container pt-4">
    {{ Breadcrumbs::render('restaurants.show', $restaurant) }}
  </div>
    <div class="w-50 m-auto pb-4">
      <div class="text-center mb-2">
        <h1>{{$restaurant->name}}</h1>
        <p class="text-center">
          <span class="star-rating me-1" data-rate="{{round($restaurant->reviews->avg('score') * 2, 0) / 2}}"></span>
          <span>{{round($restaurant->reviews->avg('score'), 1)}} （{{$restaurant->reviews->count()}}件）</span>
        </p>
      </div>
      @if (session('message'))
      <div class="alert alert-success">
        {{ session('message') }}
      </div>
      @endif
      <div class="mb-2">
        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a href="{{ route('restaurants.show', $restaurant) }}" class="nav-link active bg_main text-white disabled">トップ</a>
          </li>
          <li class="nav-item">
            <a href="{{route('reservations.create', $restaurant)}}" class="nav-link text-dark border">予約</a>
          </li>
          <li class="nav-item">
            <a href="{{route('reviews.index', $restaurant)}}" class="nav-link text-dark border">レビュー</a>
          </li>
        </ul>
      </div>
      <div>
        <div class="mb-2">
          <img src="{{ asset('/storage/img/restaurant_images/' . $restaurant->image) }}" alt="" class="restaurant-image">
        </div>
        <div class="container">
          <div class="row mb-2 pb-2 border-bottom">
            <div class="col-3">
              <span class="fw-bold">店舗名</span>
            </div>
            <div class="col">
              <span>{{$restaurant->name}}</span>
            </div>
          </div>
          <div class="row mb-2 pb-2 border-bottom">
            <div class="col-3">
              <span class="fw-bold">説明</span>
            </div>
            <div class="col">
              <span>{{$restaurant->description}}</span>
            </div>
          </div>
          <div class="row mb-2 pb-2 border-bottom">
            <div class="col-3">
              <span class="fw-bold">郵便番号</span>
            </div>
            <div class="col">
              <span>{{$restaurant->postal_code}}</span>
            </div>
          </div>
          <div class="row mb-2 pb-2 border-bottom">
            <div class="col-3">
              <span class="fw-bold">住所</span>
            </div>
            <div class="col">
              <span>{{$restaurant->address}}</span>
            </div>
          </div>
          <div class="row mb-2 pb-2 border-bottom">
            <div class="col-3">
              <span class="fw-bold">営業時間</span>
            </div>
            <div class="col">
              <span>{{$restaurant->opening_time}} ～ {{$restaurant->closing_time}}</span>
            </div>
          </div>
          <div class="row mb-2 pb-2 border-bottom">
            <div class="col-3">
              <span class="fw-bold">定休日</span>
            </div>
            <div class="col">
              <span>{{ $restaurant->regular_holidays->implode('day', '、') }}</span>
            </div>
          </div>
          <div class="row mb-2 pb-2 border-bottom">
            <div class="col-3">
              <span class="fw-bold">カテゴリ</span>
            </div>
            <div class="col">
              <span>{{ $restaurant->categories->implode('name', '、') }}</span>
            </div>
          </div>
          <div class="text-center mt-4">
            @auth
            @if (Auth::user()->subscribed('default'))
            @if(Auth::check()&&$restaurant->isFavoritedBy(Auth::user()))　
            <a href="{{route('restaurants.favorite', $restaurant)}}" class="btn btn-outline-main shadow-sm w-50" onclick="return confirm('本当に解除してもよろしいですか？');"><i class="fa fa-heart"></i> お気に入り解除</a>
            @else
            <a href="{{route('restaurants.favorite', $restaurant)}}" class="btn btn-primary bg_main shadow-sm text-white w-50"><i class="fa fa-heart"></i> お気に入り</a>
            @endif
            @else
            <h3 class="fs-6"><a href="{{route('subscription')}}">有料会員に登録</a>するとお店を<a href="{{route('subscription')}}" class="text-color-main fw-bold">お気に入り登録</a>できます</h3>
            @endif
            @else
            <h3 class="fs-6"><a href="{{route('login')}}">有料会員に登録</a>するとお店を<a href="{{route('login')}}" class="text-color-main fw-bold">お気に入り登録</a>できます</h3>
            @endauth
          </div>

        </div>
      </div>
    </div>
  </div>
  @endsection