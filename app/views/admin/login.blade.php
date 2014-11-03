@extends('layouts.default-admin')

@section('content-admin')
	<div id="login-register-form" class="admin form-container centered">

		<h1 class="line-title admin"><span class="line-center admin">ADMIN LOGIN</span></h1>

		{{ Form::open(array('url' => 'admin-login-form', 'method' => 'post')) }}

	      <div id="login-register-form" class="form-wrapper">
	        {{ Form::label('email', 'Email Address') }}
	        {{ Form::text('email', '', array('class' => 'form-control')) }}
	        @if ($errors->has('email')) <p class="error-message">{{ $errors->first('email') }}</p> @endif

	        {{ Form::label('password', 'Password') }}
	        {{ Form::password('password', array('class' => 'form-control')) }}
	        @if ($errors->has('password')) <p class="error-message">{{ $errors->first('password') }}</p> @endif
	      </div>

	      <div id="login-register-form" class="form-wrapper">
	        <div class="table">
	          <div class="column">
	          	{{ Form::submit('LOGIN', array('class' => 'button darkblue')) }}
	          </div>
	        </div>
	      </div>
	  
	  {{ Form::close() }}
	</div>
@stop