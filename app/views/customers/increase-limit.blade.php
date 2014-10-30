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
					    	{{ Form::radio('gender', 'Male') }}
					    	{{ Form::label('gender', 'Male') }}
					    	{{ Form::radio('gender', 'Female') }}
					    	{{ Form::label('gender', 'Female') }}
				    	</div>

				    	<div>
				      		{{ Form::label('birth_place', 'Birth Place') }}<br />
				        	{{ Form::text('birth_place', '', array('class' => 'form-control')) }}
				    	</div>

				    	<div>
				      		{{ Form::label('birth_date', 'Birth Date') }}<br />
				        	{{ Form::selectRange('number', 1, 31) }}
				        	{{ Form::selectMonth('month') }}
				        	{{ Form::selectYear('year', 1900, 2014) }}
				    	</div>

				    	<div>
				      		{{ Form::label('address', 'Address') }}<br />
				        	{{ Form::text('address', '', array('class' => 'form-control')) }}
				    	</div>

				    	<div>
				      		{{ Form::label('province', 'Province') }}<br />
				        	{{ Form::text('province', '', array('class' => 'form-control')) }}
				    	</div>

				    	<div>
				      		{{ Form::label('city', 'City') }}<br />
				        	{{ Form::text('city', '', array('class' => 'form-control')) }}
				    	</div>

				    	<div>
				      		{{ Form::label('postal_code', 'Postal Code') }}<br />
				        	{{ Form::text('postal_code', '', array('class' => 'form-control')) }}
				    	</div>

					</div>

				    <div>
				    	{{ Form::submit('NEXT', array('class' => 'button darkbrown')) }}
				    </div>

			    {{ Form::close() }}
			</div>
		</div>

		<div id="upload-id-card" style="display:none">
			<h2 style="text-align:left">Step 3 of 3 - Upload ID Card</h2>
			<div>
			        {{ Form::open(array('url'=>'apply/upload','method'=>'POST', 'files'=>true)) }}
				    <div class="control-group">
				        <div class="controls">
				        	{{ Form::file('image') }}
				      		<p class="errors">{{$errors->first('image')}}</p>
				    		@if(Session::has('error'))
				    		<p class="errors">{{ Session::get('error') }}</p>
				    		@endif
				        </div>
				    </div>
				    <div id="success"> </div>
				      {{ Form::submit('Submit', array('class'=>'send-btn')) }}
				      {{ Form::close() }}
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

		    $( "form" ).submit(function(event) {
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
