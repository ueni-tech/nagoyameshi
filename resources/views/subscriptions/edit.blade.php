@extends('layouts.app')
@section('content')
<div class="container pt-4">
  {{ Breadcrumbs::render('subscription.edit') }}
</div>
<div class="mypage pb-4">
  <div class="w-50 m-auto mt-3">
    <div>
      <h1 class="text-center mb-4">クレジットカード情報</h1>
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
    </div>
    <div class="container mb-4">
      <div class="row pb-2 mb-2 border-bottom">
        <div class="col-3">
          <span class="fw-bold">カード種別</span>
        </div>

        <div class="col">
          <span>{{$paymentMethod->card->brand}}</span>
        </div>
      </div>

      <div class="row pb-2 mb-2 border-bottom">
        <div class="col-3">
          <span class="fw-bold">カード名義人</span>
        </div>

        <div class="col">
          <span>{{$paymentMethod->billing_details->name}}</span>
        </div>
      </div>

      <div class="row pb-2 mb-2 border-bottom">
        <div class="col-3">
          <span class="fw-bold">カード番号</span>
        </div>

        <div class="col">
          <span>**** **** **** {{$paymentMethod->card->last4}}</span>
        </div>
      </div>
    </div>
    <div>

      <form action="{{route('subscription.update')}}" method="post" id="setup-form">
        @csrf
        <input id="card-holder-name" type="text" placeholder="カード名義人" name="card-holder-name">
        <div id="card-element"></div>
        <button id="card-button" data-secret="{{$intent->client_secret}}" class="btn btn-primary bg_main w-100">更新</button>
      </form>

    </div>
  </div>
</div>

@push('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
  const stripe = Stripe('pk_test_51OHLVEKhH49tdTK43Vplg03etoeJEcbmp5B7hCd4Idlz4IUSCneTU1IzZrKUb3nEaGFFauPuqd5sva2TmulcyNtO00oeNKflt2');
  const elements = stripe.elements();
  const cardElement = elements.create('card');
  cardElement.mount('#card-element');

  const cardHolderName = document.getElementById('card-holder-name');
  const cardButton = document.getElementById('card-button');
  const clientSecret = cardButton.dataset.secret;

  cardButton.addEventListener('click', async (e) => {
    e.preventDefault();
    const {
      setupIntent,
      error
    } = await stripe.confirmCardSetup(
      clientSecret, {
        payment_method: {
          card: cardElement,
          billing_details: {
            name: cardHolderName.value
          }
        }
      });

    if (error) {
      // Display "error.message" to the user...
      console.log(error);
    } else {
      // The card has been verified successfully...
      stripePaymentIdHandler(setupIntent.payment_method);
    }
  });

  function stripePaymentIdHandler(paymentMethodId) {
    // Insert the paymentMethodId into the form so it gets submitted to the server
    const form = document.getElementById('setup-form');

    const hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'paymentMethodId');
    hiddenInput.setAttribute('value', paymentMethodId);
    form.appendChild(hiddenInput);

    // Submit the form
    form.submit();
  }
</script>

@endpush

@endsection