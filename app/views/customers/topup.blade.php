@extends('layouts.default')

@section('content')
  <div id="subheader-wrapper">
    <span class="subtitle customer">TOP-UP</span>
    <div class="balance">
      Balance<br/>
          <span class="currency">
            Rp {{{ number_format($data['balance'], 2, ',', '.') }}}
          </span><br/>
            from the limit of
          Rp {{{ number_format($data['limitBalance'], 2, ',', '.') }}}
    </div>
  </div>

  <hr/>

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
      @if($data['limitBalance'] == 1000000)
        <p>
          Click button below to increase your maximum limit balance.
        </p>
        <div class="block">
          <a href="{{ url('/customers/increase-limit') }}"><button class="button darkbrown profile">INCREASE LIMIT</button></a>
      </div>
      @endif
    </div>

  </div>
@stop