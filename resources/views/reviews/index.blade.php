@extends('layouts.app')
@section('content')
<div class="review-page">
  <div class="w-50 m-auto py-4">
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
          <a href="{{ route('restaurants.show', $restaurant) }}" class="nav-link text-dark border">トップ</a>
        </li>
        <li class="nav-item">
          <a href="{{route('reservations.create', $restaurant)}}" class="nav-link text-dark border">予約</a>
        </li>
        <li class="nav-item">
          <a href="{{route('reviews.index', $restaurant)}}" class="nav-link active bg_main text-white disabled">レビュー</a>
        </li>
      </ul>
    </div>

    @if (Auth::user()->subscribed('default'))
    <div class="mt-3">
      {{$reviews->links()}}
    </div>
    @endif

    @foreach ($reviews as $review)
    @if (Auth::user()->subscribed('default'))
    <div class="card mb-3">
      <div class="card-header d-flex justify-content-between">
        <div>{{$review->user->name}}</div>
        @if ($review->user_id === Auth::id())
        <div class="d-flex">
          <a href="{{route('reviews.edit', [$review, $restaurant])}}" class="me-2 text-secondary">編集</a>
          <form action="{{route('reviews.destroy', $review)}}" method="POST" onsubmit="return confirm('本当に削除してもよろしいですか？');">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-danger">削除</button>
          </form>
        </div>
        @endif
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">
          <span class="star-rating" data-rate="{{$review->score}}"></span>
        </li>
        <li class="list-group-item">
          {{$review->content}}
        </li>
      </ul>
    </div>
    @elseif ($loop->iteration <= 3) <div class="card mb-3">
      <div class="card-header d-flex justify-content-between">
        <div>{{$review->user->name}}</div>
        @if ($review->user_id === Auth::id())
        <div class="d-flex">
          <a href="{{route('reviews.edit', [$review, $restaurant])}}" class="me-2 text-secondary">編集</a>
          <form action="{{route('reviews.destroy', $review)}}" method="POST" onsubmit="return confirm('本当に削除してもよろしいですか？');">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-danger">削除</button>
          </form>
        </div>
        @endif
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">
          <span class="star-rating" data-rate="{{$review->score}}"></span>
        </li>
        <li class="list-group-item">
          {{$review->content}}
        </li>
      </ul>
  </div>
  @endif
  @endforeach
  @if (Auth::user()->subscribed('default'))
  {{$reviews->links()}}
  @endif

  @if (Auth::user()->subscribed('default'))
  <div class="text-center mt-5">
    <a href="{{route('reviews.create', $restaurant)}}" class="btn btn-primary bg_main text-white shadow-sm w-50">レビューを投稿する</a>
  </div>
  @else
  <div class="text-center">
    <p>レビューを全件表示するには<a href="{{route('subscription')}}">有料プランへの登録</a>が必要です。</p>
  </div>
  @endif

</div>
</div>

@endsection