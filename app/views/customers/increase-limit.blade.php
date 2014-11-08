@extends('layouts.default')

@section('content')
	<div id="increase-limit-form" class="container centered">

		<h1 class="line-title customer"><span class="line-center customer">Increase Limit</span></h1>
		<br/>
		<div id="user-agreements" >
			<h2>Step 1 of 3 - User Agreements</h2>
			<div class="eula-box">
				Here's the end user licence agreements. Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum.
			</div>
			<h3>
				<input type="checkbox" name="checkbox" id="checkbox" class="css-checkbox" />
				I agree with these terms and agreements
			</h3>
			<div class="next-button">
				<a href="#user-information"><button id="button-1" class="button darkbrown">NEXT</button></a>
			</div>
		</div>

		<div id="user-information" style="display:none">
			<h2>Step 2 of 3 - User Information</h2>
			<div>
				{{ Form::open(array('url' => 'user-information-form', 'method' => 'post')) }}
			    	<div id="login-register-form" class="wrapper">
			    		<div>
					    	{{ Form::label('full_name', 'Full Name') }}<br />
					    	{{ Form::text('full_name', '', array('class' => 'form-control')) }}
					    	@if ($errors->has('full_name')) <p class="error-message">{{ $errors->first('full_name') }}</p> @endif
				    	</div>
			    		<div>
					    	{{ Form::label('id_type', 'ID Type') }}<br />
					    	{{ Form::text('id_type', '', array('class' => 'form-control')) }}
					    	@if ($errors->has('id_type')) <p class="error-message">{{ $errors->first('id_type') }}</p> @endif
				    	</div>
			    		<div>
					    	{{ Form::label('id_number', 'Identity Number') }}<br />
					    	{{ Form::text('id_number', '', array('class' => 'form-control')) }}
					    	@if ($errors->has('id_number')) <p class="error-message">{{ $errors->first('id_number') }}</p> @endif
				    	</div>
				    	<div>
					    	{{ Form::label('gender', 'Gender') }}<br />
					    	<div class="radio-style">
						    	{{ Form::radio('gender', 'male') }}
						    	{{ Form::label('gender', 'Male') }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						    	{{ Form::radio('gender', 'female') }}
						    	{{ Form::label('gender', 'Female') }}
					    	</div>
					    	@if ($errors->has('gender')) <p class="error-message">{{ $errors->first('gender') }}</p> @endif
				    	</div>
				    	<div>
				      		{{ Form::label('birth_place', 'Birth Place') }}<br />
				        	{{ Form::text('birth_place', '', array('class' => 'form-control')) }}
				        	@if ($errors->has('birth_place')) <p class="error-message">{{ $errors->first('birth_place') }}</p> @endif
				    	</div>
				    	<div>
				    		{{ Form::label('birth_date', 'Birth Date') }}<br />
				    		<input id="birth_date" class="form-control" name="birth_date" type="text" value="">
				    		@if ($errors->has('birth_date')) <p class="error-message">{{ $errors->first('birth_date') }}</p> @endif
				    	</div>

				    	<div id="id_address_form">
				      		{{ Form::label('address', 'Identity Address') }}<br />
				        	{{ Form::text('address', '', array('class' => 'form-control')) }}
				        	@if ($errors->has('address')) <p class="error-message">{{ $errors->first('address') }}</p> @endif
				    	</div>

				    	<div>
				    		{{ Form::hidden('status', 'In process') }}
				    	</div>

				    	<input type="checkbox" name="checkbox_address" id="checkbox_address" value="false" class="css-checkbox" />
				    	My current address is different with identity address 

				    	<div id="current_address_form" style="display: none">
				      		{{ Form::label('current_address', 'Current Address') }}<br />
				        	{{ Form::text('current_address', '', array('class' => 'form-control')) }}
				        	@if ($errors->has('current_address')) <p class="error-message">{{ $errors->first('current_address') }}</p> @endif
				    	</div>

					</div>

				    <div class="next-button">
				    	<a href="#upload-id-card">{{ Form::submit('NEXT', array('id' => 'button-2', 'class' => 'button darkbrown')) }}</a>
				    </div>

			    {{ Form::close() }}
			</div>
		</div>

		<div id="upload-id-card" style="display:none">
			<h2 style="text-align:left">Step 3 of 3 - Upload ID Card</h2>
			<div>
			    {{ Form::open(array('url'=>'upload-id-card','method'=>'POST', 'files'=>true, 'id'=>'upload-form')) }}
			    	<div id="uploaded-image" class="block"></div>
				    <div>
			        	{{ Form::file('image', array('id'=>'image-upload')) }}
			      		<p class="errors">{{$errors->first('image')}}</p>
			    		@if(Session::has('error'))
			    		<p class="errors">{{ Session::get('error') }}</p>
			    		@endif
<!-- 			    		{{ Form::hidden('full_name_fix') }}
			    		{{ Form::hidden('id_type_fix') }}
			    		{{ Form::hidden('id_number_fix') }}
			    		{{ Form::hidden('gender_fix') }}
			    		{{ Form::hidden('birth_place_fix') }}
			    		{{ Form::hidden('birth_date_fix') }}
			    		{{ Form::hidden('id_address_fix') }}
			    		{{ Form::hidden('address_fix') }} -->
			    		<input id="finish-form" name="finish-form" type="hidden" value="">
				    </div>
				    <div id="validation-errors"></div>
				    <div class="next-button">
				      {{ Form::submit('FINISH', array('id'=>'finish-button', 'class'=>'button darkbrown')) }}
				    </div>
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

	<div id="notification" class="container" style="display:none">
		<h1>Thank you</h1>
		<div class="wrapper">
			<p>Your request for increasing your limit have been received, we will verified for the agreement
			within 1x24 hours. Please check your e-mail for further information.</p>
			<br/>
			<div style="text-align:left">
				{{ link_to ("/customers/dashboard", 'Back to Dashboard') }}
			</div>
		</div>
	</div>

	<script type="text/javascript">

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
		                $("#finish-form").val("false");
		            }
		        });
		        $("#validation-errors").show();
		    } else {
		        $("#uploaded-image").html("<img src='"+response.file+"' class='centered' />");
		        $("#uploaded-image").css('display','block');
		        $("#finish-form").val("true");
			    $("#finish-button" ).click(function() {
			    	if ($("#finish-form").val() == "true"){

			    		$( "#increase-limit-form" ).hide();
			      		$( "#notification" ).fadeIn();
			    	}
			    });
		    }
		}

		$(function(){

			$( "#checkbox" ).change(function() {
				var $input = $( this );
				if($input.prop("checked")) {
				   	$("#button-1").prop("disabled", false);// something when checked
				} else {
					$("#button-1").prop("disabled", true);// something else when not
				}
			}).change();

			$( "#checkbox_address" ).change(function() {
				var $input = $(this);
				//var $current_address = $('#id_address_form').find('input[name="address"]').val();
				if($input.prop("checked")) {
				   	$( "#current_address_form" ).fadeIn();
				   	$( "#checkbox_address" ).val("true");
				}
				else {
					$( "#current_address_form" ).hide();
					$( "#checkbox_address" ).val("false");
					$( "#current_address" ).val("");
					//$( "#current_address" ).val($current_address);
				}
			}).change();

			$( "#button-1" ).click(function() {
		      $( "#user-agreements" ).hide();
		      $( "#upload-id-card" ).hide();
		      $( "#user-information" ).fadeIn();
		    });

			$( "#button-2" ).click(function() {
		      $( "#full_name_fix" ).val($("#full_name").val());
		      $( "#id_type_fix" ).val($("#id_type").val());
		      $( "#id_number_fix" ).val($("#id_number").val());
		      $( "#gender_fix" ).val($("#gender").val());
		      $( "#birth_place_fix" ).val($("#birth_place").val());
		      $( "#birth_date_fix" ).val($("#birth_date").val());
		      $( "#id_address_fix" ).val($("#id_address").val());
			  $( "#address_fix" ).val($("#address").val()); 	
		    });

			$("#birth_date").datepicker({
				maxDate: 0,
				changeMonth: true,
    			changeYear: true,
    			yearRange: "-80:+0"
			});

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



	</script>
@stop
