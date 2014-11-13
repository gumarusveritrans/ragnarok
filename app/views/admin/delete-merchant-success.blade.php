@extends('layouts.default-admin')

@section('content-admin')
<div id="notification" class="container admin">
	<h1>Delete Success</h1>
	<div class="wrapper">
		<p>Merchant has been deleted successfully</p>
		<br/>
		<div style="text-align:left">
			{{ link_to ("/admin/dashboard", 'Back to Dashboard') }}
		</div>
	</div>
</div>
@stop