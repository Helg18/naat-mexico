@extends('layouts.app')

<!-- Main Content -->
@section('content')

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}" >
    {!! csrf_field() !!}

    <div class="md-input-container md-float-label form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    	<input type="email"  class="md-input" name="email" value="{{ old('email') }}">
    	<label>Email</label>
    	@if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>

    <div class="btn-group btn-group-justified mb15">
		<div class="btn-group">
			<button type="submit" class="btn btn-info">Enviar link de recuperación</button>
		</div>
	</div>

</form>

@endsection
