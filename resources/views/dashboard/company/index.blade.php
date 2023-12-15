@extends('layouts.dashboard')

@section('content')
<div class="w-85 m-auto">
  <h2 class="mb-4">会社概要</h2>
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
  @foreach($companies as $company)
  <form method="POST" action="{{route('dashboard.company.update', $company)}}" class="mb-5">
    @csrf
    @method('put')
    <div class="container">
      <div class="form-inline my-4 row">
        <label for="company-name" class="col-3 d-flex justify-content-start">会社名</label>
        <input type="text" id="company-name" name="name" class="form-control col-8" value="{{old('name', $company->name)}}" placeholder="例）○○○株式会社">
      </div>
      <div class="form-inline my-4 row">
        <label for="company-postal_code" class="col-3 d-flex justify-content-start">郵便番号</label>
        <input type="text" id="company-postal_code" name="postal_code" class="form-control col-8" value="{{old('postal_code', $company->postal_code)}}" placeholder="例）000-0000">
      </div>
      <div class="form-inline my-4 row">
        <label for="company-address" class="col-3 d-flex justify-content-start">住所</label>
        <input type="text" id="company-address" name="address" class="form-control col-8" value="{{old('address', $company->address)}}" placeholder="例）愛知県名古屋市○○○">
      </div>
      <div class="form-inline my-4 row">
        <label for="company-representative" class="col-3 d-flex justify-content-start">代表者名</label>
        <input type="text" id="company-representative" name="representative" class="form-control col-8" value="{{old('representative', $company->representative)}}" placeholder="例）侍太郎">
      </div>
      <div class="form-inline my-4 row">
        <label for="company-capital" class="col-3 d-flex justify-content-start">資本金</label>
        <input type="text" id="company-capital" name="capital" class="form-control col-8" value="{{old('capital', $company->capital)}}" placeholder="例）○○○万円">
      </div>
      <div class="form-inline my-4 row">
        <label for="company-business" class="col-3 d-flex justify-content-start">事業内容</label>
        <input type="text" id="company-business" name="business" class="form-control col-8" value="{{old('business', $company->business)}}" placeholder="例）○○○の販売">
      </div>
      <div class="form-inline my-4 row">
        <label for="company-number_of_employees" class="col-3 d-flex justify-content-start">従業員数</label>
        <input type="text" id="company-number_of_employees" name="number_of_employees" class="form-control col-8" value="{{old('number_of_employees', $company->number_of_employees)}}" placeholder="例）○○○名">
      </div>
      <div class="form-inline my-4 row">
        <button type="submit" class="btn btn-primary w-25">更新</button>
      </div>
    </div>
  </form>
  @endforeach
</div>
@endsection