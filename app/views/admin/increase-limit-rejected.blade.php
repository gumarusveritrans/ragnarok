@extends('layouts.default-admin')

@section('content-admin')
<div id="notification" class="container admin">
	<h1>Increase Limit Rejected</h1>
	<div class="wrapper">
		<p>Customer's request for increasing account limit has been rejected</p>
		<br/>
		<div style="text-align:left">
			{{ link_to ("/admin/dashboard", 'Back to Dashboard') }}
		</div>
	</div>
</div>
@stop