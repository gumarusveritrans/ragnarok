@extends('layouts.default')

@section('content')
	<div id="login-register-form" class="customer form-container centered">
	  
		<h1 class="line-title"><span class="line-center customer">REGISTRATION</span></h1>
	  
		{{ Form::open(array('url' => 'register-form', 'method' => 'post')) }}
	    
	    	<div id="login-register-form" class="form-wrapper">
		    	<div>
			    	{{ Form::label('username', 'Username') }}<br />
			    	{{ Form::text('username', Input::old('name'), array('class' => 'form-control')) }}
			    	@if ($errors->has('username')) <p class="error-message">{{ $errors->first('username') }}</p> @endif
		    	</div>

		    	<div>
			    	{{ Form::label('email', 'Email') }}<br />
			    	{{ Form::text('email', Input::old('name'), array('class' => 'form-control')) }}
			    	@if ($errors->has('email')) <p class="error-message">{{ $errors->first('email') }}</p> @endif
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

		    	<p>By clicking <b>REGISTER</b> button, you have agree to our Terms and Condition</p>
	    	</div>

		    <div>
		    	{{ Form::submit('Sign up', array('class' => 'button darkbrown')) }}
		    </div>

	    {{ Form::close() }}

	</div>
@stop