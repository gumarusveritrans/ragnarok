@extends('layouts.default-merchant')

@section('content-merchant')
	<div id="login-register-form" class="merchant form-container centered">

		<h1 class="line-title merchant"><span class="line-center merchant">MERCHANT LOGIN</span></h1>

		{{ Form::open() }}

	      <div id="login-register-form" class="form-wrapper">
	        {{ Form::label('username', 'Username') }}
	        {{ Form::text('username', '', array('maxlength' => 20, 'class' => 'form-control')) }}

	        {{ Form::label('password', 'Password') }}
	        {{ Form::password('password', array('maxlength' => 32, 'class' => 'form-control')) }}
	        @if(Session::has('errors'))<p class="error-message">{{ Session::pull('errors'); }}</p>@endif
	      </div>

	      <div id="login-register-form" class="form-bottom-wrapper">
	          	{{ Form::submit('LOGIN', array('class' => 'button darkred')) }}
	      </div>
	  
	  {{ Form::close() }}
	</div>
@stop