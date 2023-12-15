@extends('layouts.dashboard')

@section('content')
<div class="w-85 m-auto">
  <div class="col-md-6">
    <div class="mb-4"><a href="{{ route('dashboard.categories.index') }}" class="link-secondary">&laquo; カテゴリ一覧に戻る</a></div>
    <h2 class="mb-4">カテゴリ名修正</h2>
    @if($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach($errors->all() as $error)
          <li>{{$error}}</li>
          @endforeach
        </ul>
      </div>
      @endif
    <form method="POST" action="{{ route('dashboard.categories.update', $category) }}">
      @csrf
      @method('PUT')
      <div class="form-group">
        <label for="category-name">カテゴリ名</label>
        <div class="mt-2">
          <input type="text" name="name" id="category-name" class="form-control mb-4" value="{{ old('name', $category->name) }}">
        </div>
      </div>
      <button type="submit" class="btn btn-primary w-25">更新</button>
    </form>
  </div>
</div>
@endsection