@extends('layouts.default')

@section('content')
<div id="notification" class="container">
	<h1>Inrease Limit Request</h1>
	<div class="wrapper">
		<p>Your request for increasing your limit have been received, we will verified for the agreement
		within 1x24 hours. Please check your e-mail for further information.</p>
		<br/>
		<div style="text-align:left">
			{{ link_to ("/customers/dashboard", 'Back to Dashboard') }}
		</div>
	</div>
</div>
@stop