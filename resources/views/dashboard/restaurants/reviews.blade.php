@extends('layouts.dashboard')

@section('content')
<div class="w-85 m-auto">
  <div class="mb-3"><a href="{{route('dashboard.restaurants.index')}}" class="link-secondary">&laquo; 店舗一覧に戻る</a></div>
  <h2 class="mb-4">レビュー一覧</h2>
  <div class="bg-light p-3 mb-3">
    <div class="container">
      <div class="row mb-2">
        <div class="col-2">
          <span>店舗名</span>
        </div>
        <div class="col">
          <span>{{$restaurant->name}}</span>
        </div>
      </div>
      <div class="row">
        <div class="col-2">
          <span>カテゴリ</span>
        </div>
        <div class="col">
          <span>{{ $restaurant->categories->implode('name', '、') }}</span>
        </div>
      </div>
    </div>
  </div>
  @if (session('message'))
  <div class="alert alert-success">
    {{ session('message') }}
  </div>
  @endif
  <div class="py-4">
    @if($reviews->count() > 0)
    @foreach($reviews as $review)
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between">
        <div>
          <div>
            <span>投稿者：</span><span>{{$review->user->name}}</span>
          </div>
          <div>
            <span>投稿日：</span><span>{{$review->updated_at}}</span>
          </div>
        </div>
        <div>
          <form action="{{route('reviews.destroy', $review)}}" method="post" class="d-inline" onsubmit="return confirm('本当に削除してもよろしいですか？');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">削除</button>
          </form>
        </div>
      </div>
      <div class="card-body">
        <span>評価：{{$review->score}}</span>
        <hr>
        <span>{{$review->content}}</span>
      </div>
    </div>
    @endforeach
    {{$reviews->links()}}
    @else
    <div class="alert alert-info">
      レビューはまだありません。
    </div>
    @endif
  </div>
</div>
@endsection