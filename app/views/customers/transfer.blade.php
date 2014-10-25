@extends('layouts.default')

@section('content')
  <div id="subheader-wrapper">
    <span class="subtitle">TRANSFER</span>
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

  <hr id="horizontal-line" noshade size=1 width=95% />

  <div id="subcontent-wrapper">

    <div id="transfer-box-wrapper">

      {{ Form::open() }}

        <div id="transfer-form-wrapper">

          <div>
            {{ Form::label('transfer_recipient', 'Transfer to Account (Email)') }}
            {{ Form::text('transfer_recipient', '', array('class' => 'form-control')) }}
          </div>

          <div>
            {{ Form::label('transfer_amount', 'Transfer Amount') }}
            {{ Form::text('transfer_amount', '', array('class' => 'form-control')) }}
          </div>
          <br/>
          <div class="block">
            {{ Form::submit('Confirm Transfer', array('class' => 'button darkbrown close-account')) }}
          </div>
        </div>

      {{ Form::close() }}

    </div>

  </div>
@stop