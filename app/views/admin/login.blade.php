@extends('layouts.default-admin')

@section('content-admin')
	<div id="login-register-form" class="admin form-container centered">

		<h1 class="line-title admin"><span class="line-center admin">ADMIN LOGIN</span></h1>

		{{ Form::open() }}

	      <div id="login-register-form" class="form-wrapper">
	        {{ Form::label('email', 'Email Address') }}
	        {{ Form::text('email', '', array('class' => 'form-control')) }}

	        {{ Form::label('password', 'Password') }}
	        {{ Form::password('password', array('class' => 'form-control')) }}
	        @if(Session::has('errors'))<p class="error-message">{{ Session::pull('errors'); }}</p>@endif
	      </div>

	      <div id="login-register-form" class="form-bottom-wrapper">
	          	{{ Form::submit('LOGIN', array('class' => 'button darkblue')) }}
	      </div>
	  
	  {{ Form::close() }}
	</div>
@stop