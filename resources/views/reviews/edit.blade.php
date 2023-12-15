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
          <a href="{{route('reviews.index', $restaurant)}}" class="nav-link active bg_main text-white">レビュー</a>
        </li>
      </ul>
    </div>

    <form method="POST" action="{{route('reviews.update', $review)}}">
      @method('PUT')
      @csrf
      @error('content')
      <div class="alert alert-danger">{{$message}}</div>
      @enderror
      <input type="hidden" name="restaurant_id" value="{{$restaurant->id}}">
      <div class="mb-3">
        <label class="form-label text-md-left fw-bold">評価</label>
        <div>
          @for ($i = 1; $i <= 5; $i++)
            <div class="form-check form-check-inline">
              <input class="form-check-input" id="score{{ $i }}" type="radio" name="score" value="{{ $i }}" {{ $review->score == $i ? 'checked' : '' }}>
              <label class="form-check-label" for="score{{ $i }}">{{ $i }}</label>
            </div>
          @endfor
        </div>
      </div>

      <div class="mb-4">
        <label for="content" class="form-label text-md-left fw-bold">感想</label>

        <div>
          <textarea class="form-control" id="content" name="content" cols="30" rows="5">{{old('content', $review->content)}}</textarea>
        </div>
      </div>

      <div class="form-group d-flex justify-content-center mb-4">
        <button type="submit" class="btn btn-primary bg_main text-white shadow-sm w-50">更新</button>
      </div>
    </form>

  </div>
</div>

@endsection