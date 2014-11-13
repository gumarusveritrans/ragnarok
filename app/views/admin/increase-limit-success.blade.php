@extends('layouts.default-admin')

@section('content-admin')
<div id="notification" class="container admin">
	<h1>Increase Limit Success</h1>
	<div class="wrapper">
		<p>Customer's account limit has been increased successfully</p>
		<br/>
		<div style="text-align:left">
			{{ link_to ("/admin/dashboard", 'Back to Dashboard') }}
		</div>
	</div>
</div>
@stop