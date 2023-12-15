@extends('layouts.dashboard')
@section('content')
<div class="w-85 m-auto">

  <h2 class="mb-4">サマリー</h2>

  <div class="card mb-3">
    <div class="card-header">
      <h3 class="card-title">会員数概要</h3>
    </div>
    <div class="card-body">
      <div class="d-flex gap-2">
        <div class="card col-3">
          <div class="card-header">
            <span class="card-title">総会員数</span>
          </div>
          <div class="card-body">
            <p class="card-text text-end">{{$users_total_count}} 名</p>
          </div>
        </div>
        <div class="card col-3">
          <div class="card-header">
            <span class="card-title">無料会員数</span>
          </div>
          <div class="card-body">
            <p class="card-text text-end">{{$users_total_count - $users_subscribed_count}} 名</p>
          </div>
        </div>
        <div class="card col-3">
          <div class="card-header">
            <span class="card-title">有料会員数</span>
          </div>
          <div class="card-body">
            <p class="card-text text-end">{{$users_subscribed_count}} 名</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="card mb-3">
    <div class="card-header">
      <h3 class="card-title">店舗概要</h3>
    </div>
    <div class="card-body">
      <div class="d-flex gap-2">
        <div class="card col-3">
          <div class="card-header">
            <span class="card-title">登録店舗数</span>
          </div>
          <div class="card-body">
            <p class="card-text text-end">{{$restaurants_total_count}} 店舗</p>
          </div>
        </div>
        <div class="card col-3">
          <div class="card-header">
            <span class="card-title">当月総予約数</span>
          </div>
          <div class="card-body">
            <p class="card-text text-end">{{$reservations_this_month_count}} 件</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="card mb-3">
    <div class="card-header">
      <h3 class="card-title">サブスクリプション概要</h3>
    </div>
    <div class="card-body">
      <div class="d-flex gap-2">
        <div class="card col-4">
          <div class="card-header">
            <span class="card-title">当月サブスク合計額</span>
          </div>
          <div class="card-body d-flex justify-content-end align-items-center">
            <p class="card-text text-end fs-4">{{$total_amount}} 円</p>
          </div>
        </div>
        <div class="card col-6">
          <div class="card-header">
            <span class="card-title">月別サブスク合計額</span>
          </div>
          <div class="card-body">
            <div class="container">
              <form action="{{route('dashboard.index')}}" method="get">
                <div class="row mb-3">
                  <div class="col-4">
                    <select class="form-select form-select-sm" name="year" id="year">
                      <option selected value="">年</option>
                      @for($i = 2023; $i <= date('Y'); $i++) @if($i==$year) <option value="{{$i}}" selected>{{$i}}年</option>
                        @else
                        <option value="{{$i}}">{{$i}}年</option>
                        @endif
                        @endfor
                    </select>
                  </div>
                  <div class="col-4">
                    <select class="form-select form-select-sm" name="month" id="month">
                      <option selected value="">月</option>
                      @for($i = 1; $i <= 12; $i++) @if($i==$month) <option value="{{$i}}" selected>{{$i}}月</option>
                        @else
                        <option value="{{$i}}">{{$i}}月</option>
                        @endif
                        @endfor
                    </select>
                  </div>
                  <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-sm">検索</button>
                  </div>
                </div>
              </form>
              <div class="row">
                <p class="card-text text-end col-11 fs-4">{{$specify_month_total_amount}} 円</p>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection