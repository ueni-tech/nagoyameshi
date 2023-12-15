@extends('layouts.app')
@section('content')
<div class="container pt-4">
  {{ Breadcrumbs::render('mypage.reservations') }}
</div>
<div class="mypage pb-4">
  <div class="w-75 m-auto mt-3">
    <div>
      <h1 class="text-center mb-4">予約一覧</h1>
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

      {{$reservations->links()}}
      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead>
            <tr>
              <th scope="col" class="small">No.</th>
              <th scope="col">予約日時</th>
              <th scope="col">店舗名</th>
              <th scope="col">カテゴリ</th>
              <th scope="col">予約人数</th>
              <th scope="col"></th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            @foreach($reservations as $reservation)
            <tr>
              <th scope="row">{{$loop->iteration}}</th>
              <td>{{$reservation->reserved_datetime->format('Y/m/d H:m')}}</td>
              <td>
                <span>{{$reservation->restaurant->name}}</span>
              </td>
              <td>
                @foreach($reservation->restaurant->categories()->get() as $category)
                <span class="badge bg-secondary ms-1">{{$category->name}}</span>
                @endforeach
              </td>
              <td>{{$reservation->number_of_people}}名</td>
              <td>
                <a href="{{route('restaurants.show', $reservation->restaurant_id)}}" class="btn btn-outline-secondary btn-sm">店舗情報</a>
              </td>
              <td>
                <form action="{{route('reservations.destroy', $reservation)}}" method="post" onsubmit="return confirm('本当にキャンセルしてもよろしいですか？');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-outline-danger btn-sm">キャンセル</button>
                </form>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    {{$reservations->links()}}
  </div>
</div>

@endsection