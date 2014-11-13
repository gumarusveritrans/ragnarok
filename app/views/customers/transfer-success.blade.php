@extends('layouts.default')

@section('content')
<div id="notification" class="container">
	<h1>Transfer Success</h1>
	<div class="wrapper">
		<p>You have successfully transfered to account <b>{{{$transfer_recipient}}}</b> with amount of <b>{{{ 'Rp '.number_format($transfer_amount, 2, ',', '.') }}}</b>.</p>
		<br/>
		<div style="text-align:left">
			{{ link_to ("/customers/dashboard", 'Back to Dashboard') }}
		</div>
	</div>
</div>
@stop