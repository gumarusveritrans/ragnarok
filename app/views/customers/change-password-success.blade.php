@extends('layouts.default')

@section('content')
<div id="notification" class="container">
	<h1>Success</h1>
	<div class="wrapper">
		<p>Your password has been change with a new password!</p>
		<br/>
		<div style="text-align:left">
			{{ link_to ("/customers/dashboard", 'Back to Dashboard') }}
		</div>
	</div>
</div>
@stop