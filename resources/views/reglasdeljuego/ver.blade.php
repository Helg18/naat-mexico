@extends('layouts.secure')

@section('content')

<h1>{{$regla->regla}}</h1>
<!-- tab style -->
<div class="clearfix tabs-linearrow">
	<ul class="nav nav-tabs">
			<li class=""><a href="{{ route('admin.reglas.index') }}" hreff="#tab-linearrow-one" -data-toggle="tab"> < Volver</a></li>
		<li class="active"><a href="#" hreff="#tab-linearrow-one" -data-toggle="tab">Detalles</a></li>
	</ul>
	<div class="tab-content" style="text-align: center;">	
	<div class="row">
	<table>
			<tr>
				<td>{!! Form::label('nombre', 'Regla') !!}</td>
				<td>{!! Form::label('regla', $regla->regla) !!}</td>

			</tr>
			<tr>
				<td>{!! Form::label('descipcion', 'Descripcion de la regla') !!}</td>
				<td>{{ $regla->descripcion_regla }}</td>
			</tr>
			<tr>
				<td>{!! Form::label('status', 'Estatus') !!}</td>
				<td>
				@if ($regla->is_active == 1)
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