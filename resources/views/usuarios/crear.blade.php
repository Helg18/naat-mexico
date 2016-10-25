@extends('layouts.secure')

@section('content')

<h1>Agregar usuario nuevo</h1>
<!-- tab style -->
<div class="clearfix tabs-linearrow">
	<ul class="nav nav-tabs">
		<li class=""><a href="{{ route('admin.usuarios.index') }}" hreff="#tab-linearrow-one" -data-toggle="tab"> < Volver</a></li>
		<li class="active"><a href="{{ route('admin.usuarios.create') }}" hreff="#tab-linearrow-one" -data-toggle="tab">Agregar</a></li>
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
	{!! Form::open(['route' => 'admin.usuarios.store', 'method'=>'post']) !!}
	<table>
		<tr>
			<td>{!! Form::label('nombre', 'Nombre') !!}</td>
			<td>{!! Form::text('nombre', '', [ 'class' => 'form-control']) !!}</td>

		</tr>
		<tr>
			<td>{!! Form::label('apellidos', 'Apelidos') !!}</td>
			<td>{!! Form::text('apellido', '', ['class' => 'form-control']) !!}</td>
		</tr>
		<tr>
			<td>{!! Form::label('email', 'Correo Electronico') !!}</td>
			<td>{!! Form::email('email', '', ['class' => 'form-control']) !!}</td>
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
			<td>{!! Form::date('fecha_nac', '', ['class' => 'form-control']) !!}</td>
		</tr>
		<tr>
			<td>{!! Form::label('celular', 'Celular') !!}</td>
			<td>{!! Form::text('celular', '', ['class' => 'form-control']) !!}</td>
		</tr>
		<tr>
			<td>{!! Form::label('fecha_ingreso_uvm', 'Fecha de ingreso') !!}</td>
			<td>{!! Form::date('fecha_ingreso_uvm', '', ['class' => 'form-control']) !!}</td>
		</tr>
		<tr>
			<td>{!! Form::label('num_empleado', 'Numero de Empleado') !!}</td>
			<td>{!! Form::text('num_empleado', '', ['class' => 'form-control']) !!}</td>
		</tr>
		<tr>
			<td>{!! Form::label('puesto', 'Puesto') !!}</td>
			<td>{!! Form::text('puesto', '', ['class' => 'form-control']) !!}</td>
		</tr>
		<tr>
			<td>{!! Form::label('campus', 'Campus') !!}</td>
			<td>{!! Form::text('campus', '', ['class' => 'form-control']) !!}</td>
		</tr>
		<tr>
			<td>{!! Form::label('metas_ni', 'Metas NI') !!}</td>
			<td>{!! Form::text('metas_ni', '', ['class' => 'form-control']) !!}</td>
		</tr>
		<tr>
			<td>{!! Form::label('metas_pno', 'Metas PNO') !!}</td>
			<td>{!! Form::text('metas_pno', '', ['class' => 'form-control']) !!}</td>
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