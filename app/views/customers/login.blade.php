@extends('layouts.default')

@section('content')
	<div id="login-register-form" class="customer form-container centered">

		<h1 class="line-title customer">
			<span class="line-center customer">
				USER LOGIN
			</span>
		</h1>

		{{ Form::open() }}

	      <div id="login-register-form" class="form-wrapper">
	        {{ Form::label('email', 'Email Address') }}
	        {{ Form::text('email', '', array('class' => 'form-control')) }}

	        {{ Form::label('password', 'Password') }}
	        {{ Form::password('password', array('class' => 'form-control')) }}
	      </div>

	      <div id="login-register-form" class="form-wrapper">
	        <div class="table">
	          <div class="column">
	          	{{ Form::submit('LOGIN', array('class' => 'button darkbrown')) }}
	          </div>
	          <div class="column">
	          	Forgot Password?
	          </div>
	        </div>
	      </div>
	  
	  {{ Form::close() }}

	  <h2 class="line-title customer">
	  	<span class="line-center customer">
	  		Haven't Registered Yet?
	  	</span>
	  </h2>

	  <div id="login-register-form" class="form-bottom-wrapper">
	    <button href="" class="button darkbrown">REGISTER</button>
	  </div>

	</div>
@stop
