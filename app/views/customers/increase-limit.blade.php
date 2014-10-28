@extends('layouts.default')

@section('content')
	<div id="increase-limit-form" class="container centered">

		<h1 class="line-title"><span class="line-center">Increase Limit</span></h1>

		<div id="user-agreements" >
			<h2 style="text-align:left">Step 1 of 3 - User Agreements</h2>

			<div class="eula-box">
				<p style="text-align:justify">Here's the end user licence agreements</span>
			</div>

			<div style="font-size:15px;margin:20px 0">
				<input type="checkbox" name="checkbox" id="checkbox" class="css-checkbox" />
				I agree with these terms and agreements
			</div>

			<div>
				<button id="button-1" class="button darkbrown">NEXT</button>
			</div>
	      	
		</div>

		<div id="user-information" style="display:none">
			<h2 style="text-align:left">Step 2 of 3 - User Information</h2>
			<div>
				{{ Form::open() }}
	    
			    	<div id="login-register-form" class="wrapper">
				    	<div>
					    	{{ Form::label('id_number', 'Identity Number') }}<br />
					    	{{ Form::text('id_number', '', array('class' => 'form-control')) }}
				    	</div>

				    	<div>
					    	{{ Form::label('gender', 'Gender') }}<br />
					    	{{ Form::text('gender', '', array('class' => 'form-control')) }}
				    	</div>

				    	<div>
				      		{{ Form::label('birth_place', 'Birth Place') }}<br />
				        	{{ Form::password('birth_place', array('class' => 'form-control')) }}
				    	</div>

				    	<div>
				    		{{ Form::label('password_confirmation', 'Password Confirmation') }}<br />
				        	{{ Form::password('password_confirmation', array('class' => 'form-control')) }}
				    	</div>
					</div>

				    <div>
				    	{{ Form::submit('Sign up', array('class' => 'button darkbrown')) }}
				    </div>

			    {{ Form::close() }}
				<button id="button-2" class="button darkbrown">NEXT</button>
			</div>
		</div>

		<div id="upload-id-card" style="display:none">
			<h2 style="text-align:left">Step 3 of 3 - Upload ID Card</h2>
			<div>
				<button id="button-3" class="button darkbrown">FINISH</button>
			</div>
		</div>
		
	</div>

	<script type="text/javascript">

		$(function(){

			$( "input[type='checkbox']" ).change(function() {
				var $input = $( this );
				if($input.prop("checked")) {
				   	$("#button-1").prop("disabled", false);// something when checked
				} else {
					$("#button-1").prop("disabled", true);;// something else when not
				}
			}).change();

			$( "#button-1" ).click(function() {
		      $( "#user-agreements" ).hide();
		      $( "#upload-id-card" ).hide();
		      $( "#user-information" ).fadeIn();
		    });

		    $( "#button-2" ).click(function() {
		      $( "#user-agreements" ).hide();
		      $( "#user-information" ).hide();
		      $( "#upload-id-card" ).fadeIn();
		    });

		    $( "#button-3" ).click(function() {
		      $( "#user-information" ).hide();
		      $( "#upload-id-card" ).hide();
		      $( "#user-agreements" ).fadeIn();
		    });

		});

	</script>
@stop
