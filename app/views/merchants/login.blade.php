@extends('layouts.default-merchant')

@section('content-merchant')
	<div id="login-register-form" class="merchant form-container centered">

		<h1 class="line-title merchant"><span class="line-center merchant">MERCHANT LOGIN</span></h1>

		{{ Form::open() }}

	      <div id="login-register-form" class="form-wrapper">
	        {{ Form::label('email', 'Email Address') }}
	        {{ Form::text('email', '', array('class' => 'form-control')) }}

	        {{ Form::label('password', 'Password') }}
	        {{ Form::password('password', array('class' => 'form-control')) }}
	        @if(Session::has('errors'))<p class="error-message">{{ Session::pull('errors'); }}</p>@endif
	        
	      </div>

	      <div id="login-register-form" class="form-wrapper">
	        <div class="table">
	          <div class="column">
	          	{{ Form::submit('LOGIN', array('class' => 'button darkred')) }}
	          </div>
	        </div>
	      </div>
	  
	  {{ Form::close() }}
	</div>
@stop