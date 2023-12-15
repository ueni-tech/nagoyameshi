@extends('layouts.dashboard')

@section('content')
<div class="w-85 m-auto">
  <div class="mb-4"><a href="{{route('dashboard.restaurants.index')}}" class="link-secondary">&laquo; 店舗一覧に戻る</a></div>
  <h2 class="mb-4">新規店舗登録</h2>

  @if($errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">
      @foreach($errors->all() as $error)
      <li>{{$error}}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <form method="POST" action="{{route('dashboard.restaurants.store')}}" class="mb-5" enctype="multipart/form-data">
    @csrf
    <div class="container">
      <div class="form-inline my-4 row">
        <label for="restaurant-name" class="col-3 d-flex justify-content-start">店舗名</label>
        <input type="text" id="restaurant-name" name="name" class="form-control col-8">
      </div>
      <div class="form-inline my-4 row">
        <label for="restaurant-image" class="col-3 d-flex justify-content-start">画像</label>
        <input type="file" id="restaurant-image" name="image" class="form-control col-8">
      </div>
      <div class="form-inline my-4 row">
        <label for="restaurant-description" class="col-3 d-flex justify-content-start">説明</label>
        <textarea name="description" id="restaurant-description" rows="3" class="form-control col-8"></textarea>
      </div>
      <div class="form-inline my-4 row">
        <label for="restaurant-postal-code" class="col-3 d-flex justify-content-start">郵便番号</label>
        <input type="text" id="restaurant-postal-code" name="postal_code" class="form-control col-8">
      </div>
      <div class="form-inline my-4 row">
        <label for="restaurant-address" class="col-3 d-flex justify-content-start">住所</label>
        <input type="text" id="restaurant-address" name="address" class="form-control col-8">
      </div>
      <div class="form-inline my-4 row">
        <label for="restaurant-opening-time" class="col-3 d-flex justify-content-start">開店時間</label>
        <input type="time" id="restaurant-opening-time" name="opening_time" class="form-control">
      </div>
      <div class="form-inline my-4 row">
        <label for="restaurant-closing-time" class="col-3 d-flex justify-content-start">閉店時間</label>
        <input type="time" id="restaurant-closing-time" name="closing_time" class="form-control">
      </div>
      <div class="form-inline my-4 row">
        <p class="col-3 d-flex justify-content-start">定休日</label>
        <div class="d-flex flex-wrap border rounded p-2">
          @foreach($regular_holidays as $regular_holiday)
          <div class="me-3 mb-2">
            <input id="regular_holiday-{{$regular_holiday->day_index}}" type="checkbox" value="{{$regular_holiday->id}}" name="regular_holiday_ids[]">
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
            <input id="category-{{$category->id}}" type="checkbox" value="{{$category->id}}" name="category_ids[]">
            <label for="category-{{$category->id}}">{{$category->name}}</label>
          </div>
          @endforeach
        </div>
      </div>
      <div class="d-flex justify-content-start">
        <button type="submit" class="w-25 btn btn-primary">店舗を登録</button>
      </div>
    </div>
  </form>
</div>
@endsection