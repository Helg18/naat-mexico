@extends('layouts.secure')

@section('content')

<h1>Detalles para la fecha {{$fecha->fecha}}</h1>
<!-- tab style -->
<div class="clearfix tabs-linearrow">
	<ul class="nav nav-tabs">
			<li class=""><a href="{{ route('admin.fechas.index') }}" hreff="#tab-linearrow-one" -data-toggle="tab"> < Volver</a></li>
		<li class="active"><a href="#" hreff="#tab-linearrow-one" -data-toggle="tab">Detalles</a></li>
	</ul>
	<div class="tab-content" style="text-align: center;">	
	<div class="row">
	<table>
			<tr>
				<td>{!! Form::label('fecha', 'Fecha') !!}</td>
				<td>{!! Form::label('fecha', $fecha->fecha) !!}</td>

			</tr>
			<tr>
				<td>{!! Form::label('descipcion', 'Descripcion de la fecha') !!}</td>
				<td>{{ $fecha->descripcion_fecha }}</td>
			</tr>
			<tr>
				<td>{!! Form::label('status', 'Estatus') !!}</td>
				<td>
				@if ($fecha->is_active == 1)
				Activo
				@else
				Inactivo
				@endif
			</td>
		</table>	
	</div>

	</div>
</div>
@endsection