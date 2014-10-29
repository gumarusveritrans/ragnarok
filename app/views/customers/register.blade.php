@extends('layouts.default')

@section('content')
	<div id="login-register-form" class="customer form-container centered">
	  
		<h1 class="line-title"><span class="line-center customer">REGISTRATION</span></h1>
	  
		{{ Form::open() }}
	    
	    	<div id="login-register-form" class="form-wrapper">
		    	<div>
			    	{{ Form::label('username', 'Username') }}<br />
			    	{{ Form::text('username', '', array('class' => 'form-control')) }}
		    	</div>

		    	<div>
			    	{{ Form::label('email', 'Email') }}<br />
			    	{{ Form::text('email', '', array('class' => 'form-control')) }}
		    	</div>

		    	<div>
		      		{{ Form::label('password', 'Password') }}<br />
		        	{{ Form::password('password', array('class' => 'form-control')) }}
		    	</div>

		    	<div>
		    		{{ Form::label('password_confirmation', 'Password Confirmation') }}<br />
		        	{{ Form::password('password_confirmation', array('class' => 'form-control')) }}
		    	</div>

		    	<p>By clicking <b>REGISTER</b> button, you have agree to our Terms and Condition</p>
	    	</div>

		    <div>
		    	{{ Form::submit('Sign up', array('class' => 'button darkbrown')) }}
		    </div>

	    {{ Form::close() }}

	</div>
@stop