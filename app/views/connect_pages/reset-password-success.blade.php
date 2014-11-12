@extends('layouts.default')

@section('content')
<div id="notification" class="container">
	<h1>Reset Password Success</h1>
	<div class="wrapper">
		<p>Your request for new password has been send to your email account. Please check your email
		and don't forget to change your password.</p>
		<br/>
		<div style="text-align:left">
			{{ link_to ("/login", 'Login to Connect') }}
		</div>
	</div>
</div>
@stop