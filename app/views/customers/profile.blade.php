@extends('layouts.default')

@section('content')
  <div id="subheader-wrapper">
    <span class="subtitle">MY PROFILE</span>
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
    <div id="subbuttons-wrapper" class="right">
      <a href="#close-account"><button id="close-account-button" class="button lightbrown profile">close account</button></a>
      <a href="#change-password"><button id="change-password-button" class="button lightbrown profile">change password</button></a>
    </div>
    <div id="profile-wrapper">
      <div class="profile-header">
        Username
      </div>
      <div class="profile-content">
        {{{$data['username']}}}
      </div>
      <div class="profile-header">
        Email
      </div>
      <div class="profile-content">
        {{{$data['email']}}}
      </div>
      <div class="profile-header">
        Balance
      </div>
      <div class="profile-content">
        Rp {{{$data['balance']}}}
      </div>
      <div class="profile-header">
        Limit Balance
      </div>
      <div class="profile-content">
        Rp {{{$data['limitBalance']}}}
      </div>
    </div>

    <div class="profile-box-wrapper">
      <div id="close-account-box" class="profile-box-container" style="display: none">

        {{ Form::open(array('url' => 'close-account-form', 'method' => 'post')) }}

          <div class="profile-box-form">
            <h2>CLOSE ACCOUNT</h2>
            <p>
              By closing your account, you couldn't use your account anymore next time you login. The remaining amount of your balance will be send right back to your bank account. Please complete the details below.
            </p>

            <div>
              {{ Form::label('account_bank', 'Account Bank') }}
              {{ Form::text('account_bank', '', array('class' => 'form-control')) }}
              @if ($errors->has('account_bank')) <p class="error-message">{{ $errors->first('account_bank') }}</p> @endif
            </div>

            <div>
              {{ Form::label('account_number', 'Account Number') }}
              {{ Form::text('account_number', '', array('class' => 'form-control')) }}
              @if ($errors->has('account_number')) <p class="error-message">{{ $errors->first('account_number') }}</p> @endif
            </div>

            <div>
              {{ Form::label('account_name', 'Account Name') }}
              {{ Form::text('account_name', '', array('class' => 'form-control')) }}
              @if ($errors->has('account_name')) <p class="error-message">{{ $errors->first('account_name') }}</p> @endif
            </div>

            <div class="block">
              {{ Form::submit('Redeem & Close', array('class' => 'button darkbrown close-account')) }}
            </div>
          </div>

        {{ Form::close() }}

      </div>

      <div id="change-password-box" class="profile-box-container" style="display: none"> 
        
        {{ Form::open(array('url' => 'change-password-form', 'method' => 'post')) }}

          <div class="profile-box-form">
            <h2>CHANGE PASSWORD</h2>

            <div>
              {{ Form::label('current_password', 'Current Password') }}<br />
              {{ Form::password('current_password', array('class' => 'form-control')) }}
              @if ($errors->has('current_password')) <p class="error-message">{{ $errors->first('current_password') }}</p> @endif
            </div>

            <div>
              {{ Form::label('password', 'Password') }}<br />
              {{ Form::password('password', array('class' => 'form-control')) }}
              @if ($errors->has('password')) <p class="error-message">{{ $errors->first('password') }}</p> @endif
            </div>

            <div>
              {{ Form::label('password_confirmation', 'Password Confirmation') }}<br />
              {{ Form::password('password_confirmation', array('class' => 'form-control')) }}
              @if ($errors->has('password_confirmation')) <p class="error-message">{{ $errors->first('password_confirmation') }}</p> @endif
            </div>

            <div class="block">
              {{ Form::submit('Change Password', array('class' => 'button darkbrown close-account')) }}
            </div>
          </div>
        
        {{ Form::close() }}

      </div>
    </div>
  </div>

  <script type="text/javascript">

    $( "#close-account-button" ).click(function() {
      $( "#change-password-box" ).hide();
      $( "#close-account-box" ).fadeIn();
      $('.lightbrown').removeClass('lightbrown');
      $('.orange').removeClass('orange');
      $("#change-password-button").addClass('lightbrown');
      $(this).addClass('orange');
    });

    $( "#change-password-button" ).click(function() {
      $( "#close-account-box" ).hide();
      $( "#change-password-box" ).fadeIn();
      $('.lightbrown').removeClass('lightbrown');
      $('.orange').removeClass('orange');
      $("#close-account-button").addClass('lightbrown');
      $(this).addClass('orange');
    });

  $(document).ready(function(){
    var close_account_path = location.href.split("#")[1];
    if(close_account_path == "close-account") {
      $( "#close-account-button" ).trigger("click");
    }

    var change_password_path = location.href.split("#")[1];
    if(change_password_path == "change-password") {
      $( "#change-password-button" ).trigger("click");
    }
  });  
    
  </script>

@stop