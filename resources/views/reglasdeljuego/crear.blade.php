@extends('layouts.secure')

@section('content')

<h1>Agregar usuario nuevo</h1>
<!-- tab style -->
<div class="clearfix tabs-linearrow">
	<ul class="nav nav-tabs">
		<li class=""><a href="{{ route('admin.reglas.index') }}" hreff="#tab-linearrow-one" -data-toggle="tab"> < Volver</a></li>
		<li class="active"><a href="{{ route('admin.reglas.create') }}" hreff="#tab-linearrow-one" -data-toggle="tab">Agregar</a></li>
	</ul>
	<div class="tab-content" style="text-align: center;">
	@if (count($errors) > 0)
    <div class="alert alert-danger" style="text-align: left;">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
	@endif
	{!! Form::open(['route' => 'admin.reglas.store', 'method'=>'post']) !!}
	<table>
		<tr>
			<td>{!! Form::label('regla', 'Regla') !!}</td>
			<td>{!! Form::text('regla', '', [ 'class' => 'form-control']) !!}</td>

		</tr>
		<tr>
			<td>{!! Form::label('descripcion_regla', 'Descripcion de la regla') !!}</td>
			<td>{!! Form::textarea('descripcion_regla', '', ['class' => 'form-control']) !!}</td>
		</tr>
		<tr>
			<td colspan="2">{!! Form::submit('Guardar', ['class' => 'btn']) !!}</td>
		</tr>
	</table>	
		{!! Form::close() !!}

	</table>

	</div>
</div>
<!-- tab style -->
<script>var change_menu='menu-user';</script>
@endsection