@extends('layouts.dashboard')

@section('content')
<div class="w-85 m-auto">
  <div class="col-8">
    <h2 class="mb-4">カテゴリ一覧</h2>
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
    <form action="{{ route('dashboard.categories.store') }}" method="POST">
      @csrf
      <label for="category-name">カテゴリ新規作成</label>
      <div class="input-group mt-2">
        <input type="text" name="name" id="category-name" class="form-control" placeholder="カテゴリ名">
        <button type="submit" class="btn btn-sm btn-success">新規作成</button>
      </div>
    </form>

    <table class="table table-striped mt-5 align-middle w-85">
      <thead>
        <tr>
          <th scope="col" class="w-25">ID</th>
          <th scope="col">カテゴリ</th>
          <th scope="col"></th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        @foreach($categories as $category)
        <tr>
          <th scope="row">{{ $category->id }}</th>
          <td>{{ $category->name }}</td>
          <td>
            <a href="{{ route('dashboard.categories.edit', $category) }}" class="btn btn-sm btn-secondary">編集</a>
          </td>
          <td>
            <form action="{{ route('dashboard.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('本当に削除してもよろしいですか？');">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger">削除</button>
            </form>
          </td>
          @endforeach
      </tbody>
    </table>

    {{ $categories->links() }}
  </div>
</div>
@endsection