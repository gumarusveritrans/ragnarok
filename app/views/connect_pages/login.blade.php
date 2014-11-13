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
	        {{ Form::label('username', 'Username') }}
	        {{ Form::text('username', '', array('maxlength' => 20, 'class' => 'form-control', 'maxlength' => '20')) }}

	        {{ Form::label('password', 'Password') }}
	        {{ Form::password('password', array('maxlength' => 32, 'class' => 'form-control')) }}
	        @if(Session::has('errors'))<p class="error-message">{{ Session::pull('errors'); }}</p>@endif
	      </div>

	      <div id="login-register-form" class="form-wrapper">
	        <div class="table">
	          <div class="column">
	          	{{ Form::submit('LOGIN', array('class' => 'button darkbrown')) }}
	          </div>
	          <div class="column">
	          	{{ link_to('/reset-password', 'Forget Password?', array('class' => 'reset-password')) }}
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
	    <a href="{{ url('/register') }}"><button class="button darkbrown centered">REGISTER</button></a>
	  </div>

	</div>
@stop
