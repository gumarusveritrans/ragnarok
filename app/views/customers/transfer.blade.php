@extends('layouts.default')

@section('content')
  <div id="subheader-wrapper">
    <span class="subtitle customer">TRANSFER</span>
    <div class="balance">
      Balance<br/>
          <span class="currency">
            Rp {{{ number_format($data['balance'], 2, ',', '.') }}}
          </span><br/>
            from the limit of
          Rp {{{ number_format($data['limitBalance'], 2, ',', '.') }}}
    </div>
  </div>

  <hr id="horizontal-line-dashboard" noshade size=1 width=95% />

  <div id="subcontent-wrapper">

    <div id="transaction-box-wrapper">

      {{ Form::open() }}

        <div id="transaction-form-wrapper">

          <div>
            {{ Form::label('transfer_recipient', 'Transfer to Account (Username)') }}
            {{ Form::text('transfer_recipient', Input::old('transfer_recipient'), array('class' => 'form-control')) }}
          </div>

          <div>
            {{ Form::label('transfer_amount', 'Transfer Amount') }}
            {{ Form::text('transfer_amount', '', array('class' => 'form-control')) }}
             @if(Session::has('errors'))<p class="error-message">{{ Session::pull('errors'); }}</p>@endif 
          </div>
          <br/>
          <div class="block">
            {{ Form::submit('Confirm Transfer', array('class' => 'button darkbrown close-account')) }}
          </div>
        </div>

      {{ Form::close() }}

    </div>
    <div class="transaction-box-info">
      <h2>How To Transfer</h2>
      <p>
        Input your destination account email.
      </p>
      <p>
        Make sure the amount you input doesn't exceed your balance amount.
      </p>
    </div>

  </div>
@stop