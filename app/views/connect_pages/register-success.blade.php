@extends('layouts.default')

@section('content')
<div id="notification" class="container">
	<h1>Registration Success</h1>
	<div class="wrapper">
		<p>Thank you for registering on our website. You can now login with your new account!</p>
		<br/>
		<div style="text-align:left">
			{{ link_to ("/login", 'Login to Connect') }}
		</div>
	</div>
</div>
@stop