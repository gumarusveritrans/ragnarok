@extends('layouts.default')

@section('content')
	<div id="notification" class="container">
		<h1>Error 403</h1>
		<div class="wrapper">
			<p>Sorry the page you requested is forbidden. Please visit link below.</p>
			<br/>
			<div style="text-align:left">
				{{ link_to ("/", 'Visit Homepage') }}
			</div>
		</div>
	</div>
@stop