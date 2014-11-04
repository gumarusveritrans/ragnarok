@extends('layouts.default')

@section('content')
<div id="notification" class="container">
	<h1>Top-Up Confirmed</h1>
	<div class="wrapper">
		<p>Your Top-Up confirmation have been received. Please use this information details
		below to process the transaction.</p>
		<h2>Permata VA Account : {{{$va_number}}}</h2>
		<div style="text-align:left">
			{{ link_to ("/customers/dashboard", 'Back to Dashboard') }}
		</div>
	</div>
</div>
@stop