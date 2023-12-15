@extends('layouts.app')
@section('content')
<div class="container pt-4">
  {{ Breadcrumbs::render('company.index') }}
</div>
<div class="w-50 m-auto py-4">
  <h1 class="mb-4 text-center">会社概要</h1>

  <div class="container">
    <div class="row pb-2 mb-2 border-bottom">
      <div class="col-3">
        <span class="fw-bold">会社名</span>
      </div>
      <div class="col">
        <span>{{$company_info->name}}</span>
      </div>
    </div>
    <div class="row pb-2 mb-2 border-bottom">
      <div class="col-3">
        <span class="fw-bold">代表者名</span>
      </div>
      <div class="col">
        <span>{{$company_info->representative}}</span>
      </div>
    </div>
    <div class="row pb-2 mb-2 border-bottom">
      <div class="col-3">
        <span class="fw-bold">所在地</span>
      </div>
      <div class="col">
        <span>〒{{$company_info->postal_code}} {{$company_info->address}}</span>
      </div>
    </div>
    <div class="row pb-2 mb-2 border-bottom">
      <div class="col-3">
        <span class="fw-bold">資本金</span>
      </div>
      <div class="col">
        <span>{{$company_info->capital}}</span>
      </div>
    </div>
    <div class="row pb-2 mb-2 border-bottom">
      <div class="col-3">
        <span class="fw-bold">事業内容</span>
      </div>
      <div class="col">
        <span>{{$company_info->business}}</span>
      </div>
    </div>
    <div class="row pb-2 mb-2 border-bottom">
      <div class="col-3">
        <span class="fw-bold">従業員数</span>
      </div>
      <div class="col">
        <span>{{$company_info->number_of_employees}} 名</span>
      </div>
    </div>
  </div>
</div>

@endsection