@extends('layouts.secure')

@section('content')

<h1>{{$usuario->name}}</h1>
<!-- tab style -->
<div class="clearfix tabs-linearrow">
	<ul class="nav nav-tabs">
			<li class=""><a href="{{ route('admin.usuarios.index') }}" hreff="#tab-linearrow-one" -data-toggle="tab"> < Volver</a></li>
		<li class="active"><a href="#" hreff="#tab-linearrow-one" -data-toggle="tab">Detalles</a></li>
	</ul>
	<div class="tab-content" style="text-align: center;">	
	<div class="row">
	<table>
			<tr>
				<td>{!! Form::label('nombre', 'Nombre') !!}</td>
				<td>{!! Form::label('nombre', $usuario->nombre) !!}</td>

			</tr>
			<tr>
				<td>{!! Form::label('apellidos', 'Apelidos') !!}</td>
				<td>{{ $usuario->apellido }}</td>
			</tr>
			<tr>
				<td>{!! Form::label('email', 'Correo Electronico') !!}</td>
				<td>{{ $usuario->email }}</td>
			</tr>
			<tr>
				<td>{!! Form::label('fecha_nac', 'Fecha de nacimiento') !!}</td>
				<td>{{ $usuario->fecha_nac }}</td>
			</tr>
			<tr>
				<td>{!! Form::label('celular', 'Celular') !!}</td>
				<td>{{ $usuario->celular }}</td>
			</tr>
			<tr>
				<td>{!! Form::label('fecha_ingreso', 'Fecha de ingreso') !!}</td>
				<td>{{ $usuario->fecha_ingreso_uvm }}</td>
			</tr>
			<tr>
				<td>{!! Form::label('puesto', 'Puesto') !!}</td>
				<td>{{ $usuario->puesto }}</td>
			</tr>
			<tr>
				<td>{!! Form::label('campus', 'Campus') !!}</td>
				<td>{{ $usuario->campus }}</td>
			</tr>
			<tr>
				<td>{!! Form::label('metas_ni', 'Metas NI') !!}</td>
				<td>{{ $usuario->metas_ni }}</td>
			</tr>
			<tr>
				<td>{!! Form::label('metas_pno', 'Metas PNO') !!}</td>
				<td>{{ $usuario->metas_pno }}</td>
			</tr>
		</table>	
	</div>

	</div>
</div>
@endsection