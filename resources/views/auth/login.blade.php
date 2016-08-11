@extends('layouts.app')

@section('content')

<form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}" >
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


    <div class="md-input-container md-float-label form-group{{ $errors->has('password') ? ' has-error' : '' }}">
    	<input type="password"  class="md-input" name="password" >
    	<label>Contraseña</label>
    	@if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>





    <!--<div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-btn fa-sign-in"></i>Login
            </button>

            <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
        </div>
    </div>-->



    <div class="btn-group btn-group-justified mb15">
		<div class="btn-group">
			<a class="btn btn-default" href="{{ url('/password/reset') }}"><span class="ion ion-help"></span>&nbsp;&nbsp;Olvidé mi acceso</a>
		</div>
		<div class="btn-group">
			<button type="submit" class="btn btn-info">Ingresar</button>
		</div>
	</div>
</form>

@endsection
