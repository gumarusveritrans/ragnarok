@extends('layouts.default-admin')

@section('content-admin')
	<div id="login-register-form" class="admin form-container centered">

		<h1 class="line-title admin"><span class="line-center admin">ADMIN LOGIN</span></h1>

		{{ Form::open() }}

	      <div id="login-register-form" class="form-wrapper">
	        {{ Form::label('username', 'Username') }}
	        {{ Form::text('username', '', array('maxlength' => 20, 'class' => 'form-control admin')) }}

	        {{ Form::label('password', 'Password') }}
	        {{ Form::password('password', array('maxlength' => 32, 'class' => 'form-control admin')) }}
	        @if(Session::has('errors'))<p class="error-message">{{ Session::pull('errors'); }}</p>@endif
	      </div>

	      <div id="login-register-form" class="form-bottom-wrapper">
	          	{{ Form::submit('LOGIN', array('class' => 'button darkblue')) }}
	      </div>
	  
	  {{ Form::close() }}
	</div>
@stop