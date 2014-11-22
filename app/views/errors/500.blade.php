@extends('layouts.default')

@section('content')
	<div id="notification" class="container">
		<h1>Error 500</h1>
		<div class="wrapper">
			<p>Sorry, it seems there was a problem serving the requested page.</p>
			<br/>
			<div style="text-align:left">
				{{ link_to ("/", 'Visit Homepage') }}
			</div>
		</div>
	</div>
@stop