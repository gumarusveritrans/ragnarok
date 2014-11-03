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
				<a href="#user-information"><button id="button-1" class="button darkbrown">NEXT</button></a>
			</div>
	      	
		</div>

		<div id="user-information" style="display:none">
			<h2 style="text-align:left">Step 2 of 3 - User Information</h2>
			<div>
				{{ Form::open(array('url' => 'user-information-form', 'method' => 'post')) }}
	    
			    	<div id="login-register-form" class="wrapper">
				    	<div>
					    	{{ Form::label('id_number', 'Identity Number') }}<br />
					    	{{ Form::text('id_number', '', array('class' => 'form-control')) }}
					    	@if ($errors->has('id_number')) <p class="error-message">{{ $errors->first('id_number') }}</p> @endif
				    	</div>

				    	<div>
					    	{{ Form::label('gender', 'Gender') }}<br />
					    	{{ Form::radio('gender', 'Male') }}
					    	{{ Form::label('gender', 'Male') }}
					    	{{ Form::radio('gender', 'Female') }}
					    	{{ Form::label('gender', 'Female') }}
					    	@if ($errors->has('gender')) <p class="error-message">{{ $errors->first('gender') }}</p> @endif
				    	</div>

				    	<div>
				      		{{ Form::label('birth_place', 'Birth Place') }}<br />
				        	{{ Form::text('birth_place', '', array('class' => 'form-control')) }}
				        	@if ($errors->has('birth_place')) <p class="error-message">{{ $errors->first('birth_place') }}</p> @endif
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
				        	@if ($errors->has('address')) <p class="error-message">{{ $errors->first('address') }}</p> @endif
				    	</div>

				    	<div>
				      		{{ Form::label('province', 'Province') }}<br />
				        	{{ Form::text('province', '', array('class' => 'form-control')) }}
				        	@if ($errors->has('province')) <p class="error-message">{{ $errors->first('province') }}</p> @endif
				    	</div>

				    	<div>
				      		{{ Form::label('city', 'City') }}<br />
				        	{{ Form::text('city', '', array('class' => 'form-control')) }}
				        	@if ($errors->has('city')) <p class="error-message">{{ $errors->first('city') }}</p> @endif
				    	</div>

				    	<div>
				      		{{ Form::label('postal_code', 'Postal Code') }}<br />
				        	{{ Form::text('postal_code', '', array('class' => 'form-control')) }}
				        	@if ($errors->has('postal_code')) <p class="error-message">{{ $errors->first('postal_code') }}</p> @endif
				    	</div>

					</div>

				    <div>
				    	<a href="#upload-id-card">{{ Form::submit('NEXT', array('class' => 'button darkbrown')) }}</a>
				    </div>

			    {{ Form::close() }}
			</div>
		</div>

		<div id="upload-id-card" style="display:none">
			<h2 style="text-align:left">Step 3 of 3 - Upload ID Card</h2>
			<div>
			    {{ Form::open(array('url'=>'upload-id-card','method'=>'POST', 'files'=>true, 'id'=>'upload-form')) }}
			    	<div id="uploaded-image" class="block">

			    	</div>
				    <div class="centered">
				        	{{ Form::file('image', array('id'=>'image-upload')) }}
				      		<p class="errors">{{$errors->first('image')}}</p>
				    		@if(Session::has('error'))
				    		<p class="errors">{{ Session::get('error') }}</p>
				    		@endif
				    </div>
				    <div id="validation-errors"></div>
				      {{ Form::submit('FINISH', array('id'=>'finish-upload-button', 'class'=>'button darkbrown')) }}
				{{ Form::close() }}
<!-- 				<div id="uploaded-image" class="block"></div>
				<form class="form-horizontal" id="upload-form" enctype="multipart/form-data" method="post" action="{{ url('upload-id-card') }}" autocomplete="off">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <input type="file" name="image" id="image-upload" />
                    <br/><br/>
                    <input type="submit" class="button darkbrown" value="FINISH">
                </form>
                <div id="validation-errors"></div> -->
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

			var isClick = false;


			var user_information_path = location.href.split("#")[1];
		    if(user_information_path == "user-information") {
		      $( "#button-1" ).trigger("click");
		    }

		    var upload_id_path = location.href.split("#")[1];
		    if(upload_id_path == "upload-id-card") {
		      $( "#user-agreements" ).hide();
		      $( "#user-information" ).hide();
		      $( "#upload-id-card" ).fadeIn();
		    }

		    var options = { 
                beforeSubmit:  showRequest,
		        success:       showResponse,
		        dataType: 'json' 
		        }; 

		     $('body').delegate('#image-upload','change', function(){
		         $('#upload-form').ajaxForm(options).submit();          
		     }); 

		});

		function showRequest(formData, jqForm, options) { 
		    $("#validation-errors").hide().empty();
		    $("#uploaded-image").css('display','none');
		    return true; 
		} 

		function showResponse(response, statusText, xhr, $form)  { 
		    if(response.success == false)
		    {
		        var arr = response.errors;
		        $.each(arr, function(index, value)
		        {
		            if (value.length != 0)
		            {
		                $("#validation-errors").append('<div class="alert alert-error"><strong>'+ value +'</strong><div>');
		            }
		        });
		        $("#validation-errors").show();
		    } else {
		        $("#uploaded-image").html("<img src='"+response.file+"' class='centered' />");
		        $("#uploaded-image").css('display','block');
		        $( "#finish-upload-button" ).click(function() {
		    		window.location="{{ URL::to('customers/increase-limit-success') }}";
		    	});
		    }
		}

	</script>
@stop
