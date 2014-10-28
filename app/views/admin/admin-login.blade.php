@extends('layouts.default-admin')

@section('content-admin')
	<div id="login-form-admin" class="container centered">

		<h1 class="line-title"><span class="line-center">ADMIN LOGIN</span></h1>

		{{ Form::open() }}

	      <div id="login-form-admin" class="wrapper">
	        {{ Form::label('email', 'Email Address') }}
	        {{ Form::text('email', '', array('class' => 'form-control')) }}

	        {{ Form::label('password', 'Password') }}
	        {{ Form::password('password', array('class' => 'form-control')) }}
	      </div>

	      <div id="login-form-admin" class="wrapper">
	        <div class="table">
	          <div class="column">
	          	{{ Form::submit('LOGIN', array('class' => 'button darkbrown')) }}
	          </div>
	        </div>
	      </div>
	  
	  {{ Form::close() }}
	</div>
@stop