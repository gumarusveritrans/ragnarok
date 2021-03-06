@extends('layouts.default')

@section('content')
  <div id="subheader-wrapper">
    <span class="subtitle customer">MY PROFILE</span>
    <div class="balance">
          Balance<br/>
          <span class="currency">
            Rp {{{ number_format($data['balance'], 2, ',', '.') }}}
          </span><br/>
            from the limit of
          Rp {{{ number_format($data['limitBalance'], 2, ',', '.') }}}
    </div>
  </div>

  <hr id="customer-horizontal-line"/>

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
        Rp {{{ number_format($data['balance'], 2, ',', '.') }}}
      </div>
      <div class="profile-header">
        Limit Balance
      </div>
      <div class="profile-content">
        Rp {{{ number_format($data['limitBalance'], 2, ',', '.') }}}
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
              <p class="error-message">{{ Session::pull('error_password_current')}}</p>
            </div>

            <div>
              {{ Form::label('password', 'Password') }}<br />
              {{ Form::password('password', array('maxlength' => 32, 'id' => 'password-id', 'class' => 'form-control')) }}
              <p class="error-message">{{ Session::pull('error_password_new')}}</p>
            </div>

            <div>
              {{ Form::label('password_confirmation', 'Password Confirmation') }}<br />
              {{ Form::password('password_confirmation', array('maxlength' => 32, 'class' => 'form-control')) }}
              <p class="error-message">{{ Session::pull('error_password_confirmation')}}</p>
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

  $("#password-id").strength();
  
</script>

@stop