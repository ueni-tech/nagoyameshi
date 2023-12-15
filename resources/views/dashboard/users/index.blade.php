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
          <input type="text" name="name" value="{{old('name', $name)}}" class="form-control" placeholder="名前">
        </div>
        <div class="col">
          <button type="submit" class="btn btn-sm btn-primary text-white">検索</button>
        </div>
      </div>
    </form>
    <form action="{{route('dashboard.users.index')}}">
      <div class="row mb-2 align-items-center">
        <div class="col-3">
          <span>メールアドレス検索</span>
        </div>
        <div class="col">
          <input type="text" name="email" value="{{old('email', $email)}}" class="form-control" placeholder="メールアドレス">
        </div>
        <div class="col">
          <button type="submit" class="btn btn-sm btn-primary text-white">検索</button>
        </div>
      </div>
    </form>
  </div>
  <hr>
  {{$users->links()}}
  <table class="table table-striped mt-4 align-middle">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">名前</th>
        <th scope="col">フリガナ</th>
        <th scope="col">メールアドレス</th>
        <th scope="col">登録日時</th>
        <th scope="col" style="width: 15%;">ステータス</th>
        <th scope="col"></th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
      <tr>
        <th scope="row">{{ $user->id }}</th>
        <td>{{ $user->name }}</td>
        <td>{{ $user->furigana }}</td>
        <td style="word-break: break-all;">{{ $user->email }}</td>
        <td>{{ $user->created_at }}</td>
        <td>
          @if($user->subscribed('default'))
          <span class="badge bg-info">有料会員</span>
          @else
          <span class="badge bg-secondary">無料会員</span>
          @endif
        </td>
        <td>
          <a href="{{route('dashboard.users.show', $user)}}" class="btn btn-sm btn-primary">詳細</a>
        </td>
        <td>
          <form action="{{ route('dashboard.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('本当に削除してもよろしいですか？');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">削除</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  {{$users->links()}}
</div>
@endsection