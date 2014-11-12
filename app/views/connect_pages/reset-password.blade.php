@extends('layouts.default')

@section('content')
	<div id="login-register-form" class="customer form-container centered">

		<h1 class="line-title customer">
			<span class="line-center customer">
				RESET PASSWORD
			</span>
		</h1>
		<br/>
		<h2>Please enter your email address. We will send your new password directly to your email.</h2>
		{{ Form::open() }}

	    	<div id="login-register-form" class="form-wrapper">
	        	{{ Form::label('email', 'Email') }}
	        	{{ Form::text('email', '', array('class' => 'form-control')) }}
	      	  @if(Session::has('errors'))<p class="error-message">{{ Session::pull('errors'); }}</p>@endif
	    	</div>

	    	<div id="login-register-form" class="form-bottom-wrapper">
	        	{{ Form::submit('RESET', array('class' => 'button darkbrown')) }}
	    	</div>
	  
		{{ Form::close() }}
	</div>
@stop
