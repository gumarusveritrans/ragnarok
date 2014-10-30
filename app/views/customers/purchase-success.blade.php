@extends('layouts.default')

@section('content')
<div id="notification" class="container">
	<h1>Thank you</h1>
	<div class="wrapper">
		<p>Thank you for purchasing at XXX. We will send the transaction details to your email</p>
		<br/>
		<div style="text-align:left">
			{{ link_to ("/customers/dashboard", 'Back to Dashboard') }}
		</div>
	</div>
</div>
@stop