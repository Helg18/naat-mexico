@extends('layouts.app')

@section('content')

<form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}" >
    {!! csrf_field() !!}

    <input type="hidden" name="token" value="{{ $token }}">

    <div class="md-input-container md-float-label form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    	<input type="email"  class="md-input" name="email" value="{{ $email or old('email') }}">
    	<label>Email</label>
    	@if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>

    <div class="md-input-container md-float-label form-group{{ $errors->has('password') ? ' has-error' : '' }}">
    	<input type="password"  class="md-input" name="password" value="{{ old('password') }}">
    	<label>Contraseña</label>
    	@if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>

    <div class="md-input-container md-float-label form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
    	<input type="password"  class="md-input" name="password_confirmation" value="{{ old('password_confirmation') }}">
    	<label>Confirmar contraseña</label>
    	@if ($errors->has('password_confirmation'))
            <span class="help-block">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
        @endif
    </div>

    <div class="btn-group btn-group-justified mb15">
		<div class="btn-group">
			<button type="submit" class="btn btn-info"><i class="fa fa-btn fa-refresh"></i> Recuperar contraseña</button>
		</div>
	</div>

</form>

@endsection
