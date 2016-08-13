@extends('layouts.secure')

@section('content')

<h1>{{ $usuario->name }}</h1>
<!-- tab style -->
<div class="clearfix tabs-linearrow">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#" hreff="#tab-linearrow-one" -data-toggle="tab">Editar</a></li>
	</ul>
	<div class="tab-content" style="text-align: center;">	
	<div class="row">
		{!! Form::open(['route' => ['admin.usuarios.update', $usuario->id], 'method'=>'put']) !!}
		<table>
			<tr>
				<td>{!! Form::label('nombre', 'Nombre') !!}</td>
				<td>{!! Form::text('nombre', $usuario->nombre, [ 'class' => 'form-control']) !!}</td>

			</tr>
			<tr>
				<td>{!! Form::label('apellidos', 'Apelidos') !!}</td>
				<td>{!! Form::text('apellido', $usuario->apellido, ['class' => 'form-control']) !!}</td>
			</tr>
			<tr>
				<td>{!! Form::label('email', 'Correo Electronico') !!}</td>
				<td>{!! Form::email('email', $usuario->email, ['class' => 'form-control']) !!}</td>
			</tr>
			<tr>
				<td>{!! Form::label('pass', 'Contraseña') !!}</td>
				<td>{!! Form::password('pass', ['class' => 'form-control']) !!}</td>
			</tr>
			<tr>
				<td>{!! Form::label('rpass', 'Repetir contraseña') !!}</td>
				<td>{!! Form::password('rpass', ['class' => 'form-control']) !!}</td>
			</tr>
			<tr>
				<td>{!! Form::label('fecha_nac', 'Fecha de nacimiento') !!}</td>
				<td>{!! Form::date('fecha_nac', $usuario->fecha_nac, ['class' => 'form-control']) !!}</td>
			</tr>
			<tr>
				<td>{!! Form::label('celular', 'Celular') !!}</td>
				<td>{!! Form::text('celular', $usuario->celular, ['class' => 'form-control']) !!}</td>
			</tr>
			<tr>
				<td>{!! Form::label('fecha_ingreso', 'Fecha de ingreso') !!}</td>
				<td>{!! Form::date('fecha_ingreso', $usuario->fecha_ingreso_uvm, ['class' => 'form-control']) !!}</td>
			</tr>
			<tr>
				<td>{!! Form::label('puesto', 'Puesto') !!}</td>
				<td>{!! Form::text('puesto', $usuario->puesto, ['class' => 'form-control']) !!}</td>
			</tr>
			<tr>
				<td>{!! Form::label('campus', 'Campus') !!}</td>
				<td>{!! Form::text('campus', $usuario->campus, ['class' => 'form-control']) !!}</td>
			</tr>
			<tr>
				<td>{!! Form::label('metas_ni', 'Metas NI') !!}</td>
				<td>{!! Form::text('metas_ni', $usuario->metas_ni, ['class' => 'form-control']) !!}</td>
			</tr>
			<tr>
				<td>{!! Form::label('metas_pno', 'Metas PNO') !!}</td>
				<td>{!! Form::text('metas_pno', $usuario->metas_pno, ['class' => 'form-control']) !!}</td>
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