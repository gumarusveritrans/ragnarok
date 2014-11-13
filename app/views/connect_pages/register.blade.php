@extends('layouts.default')

@section('content')
	<div id="login-register-form" class="customer form-container centered">
	  
		<h1 class="line-title"><span class="line-center customer">REGISTRATION</span></h1>
	  
		{{ Form::open(array('url' => 'registration-form', 'method' => 'post')) }}
	    
	    	<div id="login-register-form" class="form-wrapper">
		    	<div>
			    	{{ Form::label('username', 'Username') }}<br />
			    	{{ Form::text('username', Input::old('name'), array('maxlength' => 20, 'class' => 'form-control')) }}
			    	@if ($errors->has('username')) <p class="error-message">{{ $errors->first('username') }}</p> @endif
		    	</div>

		    	<div>
			    	{{ Form::label('email', 'Email') }}<br />
			    	{{ Form::text('email', Input::old('name'), array('class' => 'form-control')) }}
			    	@if ($errors->has('email')) <p class="error-message">{{ $errors->first('email') }}</p> @endif
		    	</div>

		    	<p>By clicking <b>REGISTER</b> button, you have agree to our Terms and Condition</p>
	    	</div>

		    <div>
		    	{{ Form::submit('Sign up', array('class' => 'button darkbrown')) }}
		    </div>

	    {{ Form::close() }}

	</div>

@stop