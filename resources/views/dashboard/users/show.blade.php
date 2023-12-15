@extends('layouts.dashboard')

@section('content')
<div class="w-85 m-auto">
  <h2 class="mb-4">会員一覧</h2>
  @if (session('flash_message'))
  <div class="alert alert-success">
    {{ session('flash_message') }}
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

  <div class="container mb-3">
    <div class="row mb-2 align-items-center">
      <span class="col-3">会員数合計</span>
      <span class="col"><span>{{ $total_count }}名</span></span>
    </div>
    <form action="{{route('dashboard.users.index')}}">
      <div class="row mb-2 align-items-center">
        <div class="col-3">
          <span>名前検索</span>
        </div>
        <div class="col">
          <input type="text" name="name" value="{{$name}}" class="form-control" placeholder="名前">
        </div>
        <div class="col">
          <button type="submit" class="btn btn-primary btn-sm text-white">検索</button>
        </div>
      </div>
    </form>
    <form action="{{route('dashboard.users.index')}}">
      <div class="row mb-2 align-items-center">
        <div class="col-3">
          <span>メールアドレス検索</span>
        </div>
        <div class="col">
          <input type="text" name="email" value="{{$email}}" class="form-control" placeholder="メールアドレス">
        </div>
        <div class="col">
          <button type="submit" class="btn btn-primary btn-sm text-white">検索</button>
        </div>
      </div>
    </form>
  </div>

  <hr>

  <div class="d-flex justify-content-between align-items-center">
    <div><a href="{{route('dashboard.users.index')}}" class="link-secondary">&laquo; 会員一覧に戻る</a></div>
    <div>
      <form action="{{ route('dashboard.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('本当に削除してもよろしいですか？');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-outline-danger">このユーザーを削除する</button>
      </form>
    </div>
  </div>

  <div class="mt-4">
    <div class="container">
      @if (session('message'))
      <div class="alert alert-success">
        {{ session('message') }}
      </div>
      @endif
      <div class="border">
        <div class="row">
          <span class="fw-bold bg-body-secondary py-1">ユーザー情報</span>
        </div>
        <div class="row my-1">
          <div class="col-4 bg-light">
            <p class="mb-0 text-end">ID</p>
          </div>
          <div class="col">
            <p class="mb-0">{{$user->id}}</p>
          </div>
        </div>
        <div class="row my-1">
          <div class="col-4 bg-light">
            <p class="mb-0 text-end">名前</p>
          </div>
          <div class="col">
            <p class="mb-0">{{$user->name}}</p>
          </div>
        </div>
        <div class="row my-1">
          <div class="col-4 bg-light">
            <p class="mb-0 text-end">フリガナ</p>
          </div>
          <div class="col">
            <p class="mb-0">{{$user->furigana}}</p>
          </div>
        </div>
        <div class="row my-1">
          <div class="col-4 bg-light">
            <p class="mb-0 text-end">メールアドレス</p>
          </div>
          <div class="col">
            <p class="mb-0">{{$user->email}}</p>
          </div>
        </div>
        <div class="row my-1">
          <div class="col-4 bg-light">
            <p class="mb-0 text-end">登録日時</p>
          </div>
          <div class="col">
            <p class="mb-0">{{$user->created_at}}</p>
          </div>
        </div>
        <div class="row my-1">
          <div class="col-4 bg-light">
            <p class="mb-0 text-end">ステータス</p>
          </div>
          <div class="col">
            @if($user->subscribed('default'))
            <span class="badge bg-info">有料会員</span>
            @else
            <span class="badge bg-secondary">無料会員</span>
            @endif
          </div>
        </div>
      </div>

      <div class="row mt-4">
        <p class="fw-bold">投稿レビュー</p>
        <div class="w-100">
          @if($reviews->count() > 0)
          @foreach($reviews as $review)
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <div>
                <div>
                  <span>店舗名：</span><span>{{$review->restaurant->name}}</span>
                </div>
                <div>
                  <span>投稿日：</span><span>{{$review->updated_at}}</span>
                </div>
              </div>
              <div>
                <form action="{{route('reviews.destroy', $review)}}" method="post" class="d-inline" onsubmit="return confirm('本当に削除してもよろしいですか？');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm">削除</button>
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
    </div>
  </div>
  @endsection