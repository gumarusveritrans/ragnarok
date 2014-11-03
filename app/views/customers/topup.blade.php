@extends('layouts.default')

@section('content')
  <div id="subheader-wrapper">
    <span class="subtitle customer">TOP-UP</span>
    <div class="balance">
      Balance<br/>
          <span class="currency">
            Rp 1.500.000,00
          </span><br/>
            from the limit of 
          @if(true)
              Rp 5.000.000,00
          @else
              Rp 1.000.000,00
          @endif
    </div>
  </div>

  <hr id="horizontal-line-dashboard" noshade size=1 width=95% />

  <div id="subcontent-wrapper">

    <div id="transaction-box-wrapper">

      {{ Form::open(array('url' => 'topup-form', 'method' => 'post')) }}

        <div id="transaction-form-wrapper">
          <div>
            {{ Form::label('topup_amount', 'Top-Up Amount') }}
            {{ Form::text('topup_amount', '', array('class' => 'form-control')) }}
            @if ($errors->has('topup_amount')) <p class="error-message">{{ $errors->first('topup_amount') }}</p> @endif
          </div>
          <br/>
          <div class="block">
            {{ Form::submit('Confirm Top-Up', array('class' => 'button darkbrown close-account')) }}
          </div>
        </div>

      {{ Form::close() }}

    </div>
    <div class="transaction-box-info">
      <h2>How to Top-Up</h2>
      <p>
        Make sure the amount you input doesn't exceed the limit amount.
      </p>
      <p>
        Confirm top-up to proceed the transaction with Permata VA Account.
      </p>
      <div class="block">
          <a href="{{ url('/customers/increase-limit') }}"><button class="button darkbrown profile">INCREASE LIMIT</button></a>
      </div>
    </div>

  </div>
@stop