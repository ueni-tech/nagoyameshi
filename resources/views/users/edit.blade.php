@extends('layouts.app')
@section('content')
<div class="container pt-4">
  {{ Breadcrumbs::render('mypage.edit') }}
</div>
<div class="mypage pb-4">
  <div class="container mt-3">
    <div class="w-50 m-auto">
      <h1 class="text-center mb-4">会員情報</h1>
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
      <form action="{{route('mypage.update')}}" method="post">
        @csrf
        @method('PUT')

        <div class="row form-group mb-3">
          <label for="name" class="col-md-5 col-form-label text-md-right">
            <div class="d-flex align-items-center">
              <span class="me-1 fw-bold">氏名</span>
              <span class="badge bg-danger">必須</span>
            </div>
          </label>
          <div class="col-md-7">
            <input type="text" id="name" class="form-control" name="name" value="{{old('name', $user->name)}}">
            @error('name')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
          </div>
        </div>

        <div class="row form-group mb-3">
          <label for="furigana" class="col-md-5 col-form-label text-md-right">
            <div class="d-flex align-items-center">
              <span class="me-1 fw-bold">フリガナ</span>
              <span class="badge bg-danger">必須</span>
            </div>
          </label>
          <div class="col-md-7">
            <input type="text" id="furigane" class="form-control" name="furigana" value="{{old('furigana', $user->furigana)}}">
            @error('furigana')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
          </div>
        </div>

        <div class="row form-group mb-3">
          <label for="email" class="col-md-5 col-form-label text-md-right">
            <div class="d-flex align-items-center">
              <span class="me-1 fw-bold">メールアドレス</span>
              <span class="badge bg-danger">必須</span>
            </div>
          </label>
          <div class="col-md-7">
            <input type="email" id="email" class="form-control" name="email" value="{{old('email', $user->email)}}">
            @error('email')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
          </div>
        </div>

        <div class="form-group d-flex justify-content-between mt-5">
          <button type="submit" class="btn btn-primary bg_main text-white shadow-sm col-5">更新</button>
          <a href="{{route('mypage')}}" class="btn bg-white border-secondary shadow-sm col-5">戻る</a>
        </div>
      </form>

      <div class="d-flex justify-content-end mt-4">
        <form method="POST" action="{{ route('mypage.destroy') }}">
          @csrf
          @method('DELETE')
          <div>※退会手続きは<span class="link-delete" data-bs-toggle="modal" data-bs-target="#delete-user-confirm-modal">こちら</span></div>

          <div class="modal fade" id="delete-user-confirm-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel"><label>本当に退会しますか？</label></h5>
                  <button type="button" class="close" data-bs-dismiss="modal" aria-label="閉じる">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p class="text-center">一度退会するとデータはすべて削除され復旧はできません。</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">キャンセル</button>
                  <button type="submit" class="btn btn-danger">退会する</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
@endsection