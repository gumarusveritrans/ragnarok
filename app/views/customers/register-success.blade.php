@extends('layouts.default')

@section('content')
<div id="notification" class="container">
	<h1>Registration Success</h1>
	<div class="wrapper">
		<p>Thank you for registering on our website. You can now login with your new account!</p>
		<br/>
		<div style="text-align:left">
			{{ link_to ("/customers/dashboard", 'Back to Dashboard') }}
		</div>
	</div>
</div>
@stop