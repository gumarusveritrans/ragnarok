{{Form::open()}}
	{{ Form::label('email', 'Email') }}
	{{ Form::text('email') }}
	{{ Form::submit('LOGIN')}}
{{Form::close()}}