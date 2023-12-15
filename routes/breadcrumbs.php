<?php
// トップ
Breadcrumbs::for('home', function ($trail) {
  $trail->push('トップ', route('home'));
});

// トップ > 店舗一覧
Breadcrumbs::for('restaurants.index', function ($trail) {
  $trail->parent('home');
  $trail->push('店舗一覧', route('restaurants.index'));
});

// トップ > 店舗一覧 > 店名
Breadcrumbs::for('restaurants.show', function ($trail, $restaurant) {
  $trail->parent('restaurants.index');
  $trail->push($restaurant->name, route('restaurants.show', $restaurant->id));
});

// トップ > マイページ
Breadcrumbs::for('mypage', function ($trail) {
  $trail->parent('home');
  $trail->push('マイページ', route('mypage'));
});

// トップ > マイページ > あなたのレビュー
Breadcrumbs::for('mypage.reviews', function ($trail) {
  $trail->parent('mypage');
  $trail->push('あなたのレビュー', route('mypage.reviews'));
});

// トップ > マイページ > お気に入り店舗
Breadcrumbs::for('mypage.favorite', function ($trail) {
  $trail->parent('mypage');
  $trail->push('お気に入り店舗', route('mypage.favorite'));
});

// トップ > マイページ > 予約一覧
Breadcrumbs::for('mypage.reservations', function ($trail) {
  $trail->parent('mypage');
  $trail->push('予約一覧', route('mypage.reservations'));
});

// トップ > マイページ > 会員情報
Breadcrumbs::for('mypage.edit', function ($trail) {
  $trail->parent('mypage');
  $trail->push('会員情報', route('mypage.edit'));
});

// トップ > マイページ > クレジットカード情報
Breadcrumbs::for('subscription.edit', function ($trail) {
  $trail->parent('mypage');
  $trail->push('クレジットカード情報', route('subscription.edit'));
});

// トップ > マイページ > 有料会員解約申請
Breadcrumbs::for('subscription.cancel', function ($trail) {
  $trail->parent('mypage');
  $trail->push('有料会員解約申請', route('subscription.cancel'));
});

// トップ > マイページ > 有料会員登録
Breadcrumbs::for('subscription', function ($trail) {
  $trail->parent('mypage');
  $trail->push('有料会員登録', route('subscription'));
});

// トップ > 会社概要
Breadcrumbs::for('company.index', function ($trail) {
  $trail->parent('home');
  $trail->push('会社概要', route('company.index'));
});

// トップ > 利用規約
Breadcrumbs::for('terms', function ($trail) {
  $trail->parent('home');
  $trail->push('利用規約', route('terms'));
});