@extends('layouts.secure')

@section('content')

<h1>{{ $regla->regla }}</h1>
<!-- tab style -->
<div class="clearfix tabs-linearrow">
	<ul class="nav nav-tabs">
		<li class=""><a href="{{ route('admin.reglas.index') }}" hreff="#tab-linearrow-one" -data-toggle="tab">Reglas</a></li>
		<li class="active"><a href="#" hreff="#tab-linearrow-one" -data-toggle="tab">Editar</a></li>
	</ul>
	<div class="tab-content" style="text-align: center;">	
	<div class="row">
		{!! Form::open(['route' => ['admin.reglas.update', $regla->id], 'method'=>'put']) !!}
		<table>
			<tr>
				<td>{!! Form::label('regla', 'Regla') !!}</td>
				<td>{!! Form::text('regla', $regla->regla, [ 'class' => 'form-control']) !!}</td>
			</tr>
			<tr>
				<td>{!! Form::label('descripcion', 'Descripción de la regla') !!}</td>
				<td>{!! Form::textarea('descripcion_regla', $regla->descripcion_regla, ['class' => 'form-control']) !!}</td>
			</tr>
			<tr>
				<td>{!! Form::label('status', 'Estatus') !!}</td>
				<td>{!! Form::select('is_active', [1 => 'Activo', 0 => 'Inactivo'], $regla->is_active, ['placeholder' => 'Seleccione un estatus...', 'class' => 'form-control']) !!}</td>
			</tr>
			<tr>
				<td colspan="2">{!! Form::submit('Actualizar', ['class' => 'btn']) !!}</td>
			</tr>
		</table>	
		{!! Form::close() !!}
	</div>

	</div>
</div>
@endsection