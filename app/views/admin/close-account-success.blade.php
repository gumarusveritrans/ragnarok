@extends('layouts.default-admin')

@section('content-admin')
<div id="notification" class="container admin">
	<h1>Close Account Success</h1>
	<div class="wrapper">
		<p>Customer's account has been closed successfully</p>
		<br/>
		<div style="text-align:left">
			{{ link_to ("/admin/dashboard", 'Back to Dashboard') }}
		</div>
	</div>
</div>
@stop