@extends('layouts.dashboard')

@section('content')
<div class="w-85 m-auto">
  <div class="mb-4"><a href="{{route('dashboard.restaurants.index')}}" class="link-secondary">&laquo; 店舗一覧に戻る</a></div>
  <h2 class="mb-4">店舗情報編集</h2>
  @if($errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">
      @foreach($errors->all() as $error)
      <li>{{$error}}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <form method="POST" action="{{route('dashboard.restaurants.update', $restaurant)}}" class="mb-5" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="container">
      <div class="form-inline my-4 row">
        <label for="restaurant-name" class="col-3 d-flex justify-content-start">店舗名</label>
        <input type="text" id="restaurant-name" name="name" class="form-control col-8" value="{{$restaurant->name}}">
      </div>
      <div class="form-inline my-4 row">
        <label for="restaurant-image" class="col-3 d-flex justify-content-start">画像</label>
        @if ($restaurant->image && Storage::exists('public/img/restaurant_images/' . $restaurant->image))
        <div class="col-8 mb-2" style="width: 30%;">
          <img src="{{ asset('storage/img/restaurant_images/' . $restaurant->image) }}" alt="Restaurant Image" class="img-fluid">
        </div>
        @endif
        <input type="file" id="restaurant-image" name="image" class="form-control col-8">
      </div>
      <div class="form-inline my-4 row">
        <label for="restaurant-description" class="col-3 d-flex justify-content-start">説明</label>
        <textarea name="description" id="restaurant-description" rows="3" class="form-control col-8">{{$restaurant->description}}</textarea>
      </div>
      <div class="form-inline my-4 row">
        <label for="restaurant-postal-code" class="col-3 d-flex justify-content-start">郵便番号</label>
        <input type="text" id="restaurant-postal-code" name="postal_code" class="form-control col-8" value="{{$restaurant->postal_code}}">
      </div>
      <div class="form-inline my-4 row">
        <label for="restaurant-address" class="col-3 d-flex justify-content-start">住所</label>
        <input type="text" id="restaurant-address" name="address" class="form-control col-8" value="{{$restaurant->address}}">
      </div>
      <div class="form-inline my-4 row">
        <label for="restaurant-opening-time" class="col-3 d-flex justify-content-start">開店時間</label>
        <input type="time" id="restaurant-opening-time" name="opening_time" class="form-control" value="{{$restaurant->opening_time}}">
      </div>
      <div class="form-inline my-4 row">
        <label for="restaurant-closing-time" class="col-3 d-flex justify-content-start">閉店時間</label>
        <input type="time" id="restaurant-closing-time" name="closing_time" class="form-control" value="{{$restaurant->closing_time}}">
      </div>
      <div class="form-inline my-4 row">
        <p class="col-3 d-flex justify-content-start">定休日</label>
        <div class="d-flex flex-wrap border rounded p-2">
          @foreach($regular_holidays as $regular_holiday)
          <div class="me-3 mb-2">
            @if($restaurant->regular_holidays->contains($regular_holiday->id))
            <input id="regular_holiday-{{$regular_holiday->day_index}}" type="checkbox" value="{{$regular_holiday->id}}" name="regular_holiday_ids[]" checked>
            @else
            <input id="regular_holiday-{{$regular_holiday->day_index}}" type="checkbox" value="{{$regular_holiday->id}}" name="regular_holiday_ids[]">
            @endif
            <label for="regular_holiday-{{$regular_holiday->day_index}}">{{$regular_holiday->day}}</label>
          </div>
          @endforeach
        </div>
      </div>
      <div class="form-inline my-4 row">
        <p class="col-3 d-flex justify-content-start">カテゴリ</label>
        <div class="d-flex flex-wrap border rounded p-2">
          @foreach($categories as $category)
          <div class="me-3 mb-2">
            @if($restaurant->categories->contains($category->id))
            <input id="category-{{$category->id}}" type="checkbox" value="{{$category->id}}" name="category_ids[]" checked>
            @else
            <input id="category-{{$category->id}}" type="checkbox" value="{{$category->id}}" name="category_ids[]">
            @endif
            <label for="category-{{$category->id}}">{{$category->name}}</label>
          </div>
          @endforeach
        </div>
      </div>
      <div class="d-flex justify-content-start">
        <button type="submit" class="w-25 btn btn-primary">更新</button>
      </div>
  </form>

</div>
@endsection