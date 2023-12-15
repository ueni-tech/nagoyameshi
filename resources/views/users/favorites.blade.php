@extends('layouts.app')'
@section('content')
<div class="container pt-4">
  {{ Breadcrumbs::render('mypage.favorite') }}
</div>
<div class="mypage pb-4">
  <div class="w-75 m-auto mt-3">
    <div>
      <h1 class="text-center mb-4">お気に入り店舗</h1>
      <div class="w-50 m-auto">
        @if (session('message'))
        <div class="alert alert-success">
          {{ session('message') }}
        </div>
        @endif
        @if($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
          </ul>
        </div>
        @endif
      </div>

      <form method="GET" action="{{ route('mypage.favorite')}}" class="d-flex align-items-center mb-3">
        <span class="me-2">並び替え</span>
        <select name="sort" onChange="this.form.submit();" class="form-select ml-2 w-25">
          @if ($sorted == 'desc')
          <option value="desc" selected>追加日の新しい順</option>
          <option value="asc">追加日の古い順</option>
          @else
          <option value="desc">追加日の新しい順</option>
          <option value="asc" selected>追加日の古い順</option>
          @endif
        </select>
      </form>

      {{$favorites->links()}}
      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead>
            <tr>
              <th scope="col" class="small">No.</th>
              <th scope="col">追加日</th>
              <th scope="col" class="col-1">画像</th>
              <th scope="col">店舗名</th>
              <th scope="col" class="col-2">説明</th>
              <th scope="col" class="col-2">カテゴリ</th>
              <th scope="col"></th>
              <th scope="col" class="col-2"></th>
            </tr>
          </thead>
          <tbody>
            @foreach($favorites as $fav)
            @php
            $restaurant = App\Models\restaurant::find($fav->favoriteable_id);
            @endphp
            <tr>
              <th scope="row" class="small">{{$loop->iteration}}</th>
              <td class="small">{{$fav->created_at->format('Y/m/d')}}</td>
              <td><img src="{{asset('storage/img/restaurant_images/' . $restaurant->image)}}" class="img-fluid" alt=""></td>
              <td>{{$restaurant->name}}</td>
              <td class="table-ellipsis">{{$restaurant->description}}</td>
              <td>
                @foreach($restaurant->categories as $category)
                @if($loop->iteration > 1)
                <br>
                @endif
                <span>{{$category->name}}</span>
                @endforeach
              </td>
              <td>
                <a href="{{route('restaurants.show', $restaurant->id)}}" class="btn btn-primary bg_main">詳細</a>
              </td>
              <td>
                @if($restaurant->isFavoritedBy(Auth::user()))
                <a href="{{route('restaurants.favorite', $restaurant)}}" class="btn btn-outline-main shadow-sm" onclick="return confirm('本当に解除してもよろしいですか？');"><i class="fa fa-heart"></i> 解除</a>
                @else
                <a href="{{route('restaurants.favorite', $restaurant)}}" class="btn btn-primary bg_main shadow-sm text-white"><i class="fa fa-heart"></i> お気に入り</a>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    {{$favorites->links()}}
  </div>
</div>

@endsection