@extends('layouts.secure')

@section('content')

<h1>{{ $premios->premios }}</h1>
<!-- tab style -->
<div class="clearfix tabs-linearrow">
	<ul class="nav nav-tabs">
		<li class=""><a href="{{ route('admin.premios.index') }}" hreff="#tab-linearrow-one" -data-toggle="tab">Premios</a></li>
		<li class="active"><a href="#" hreff="#tab-linearrow-one" -data-toggle="tab">Editar</a></li>
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
	<div class="row">
		{!! Form::open(['route' => ['admin.premios.update', $premios->id], 'method'=>'put']) !!}
		<table>
			<tr>
				<td>{!! Form::label('premios', 'Premio') !!}</td>
				<td>{!! Form::text('premios', $premios->premios, [ 'class' => 'form-control']) !!}</td>
			</tr>
			<tr>
				<td>{!! Form::label('descripcion', 'Descripción del premio') !!}</td>
				<td>{!! Form::textarea('descripcion_premios', $premios->descripcion_premios, ['class' => 'form-control']) !!}</td>
			</tr>
			<tr>
				<td>{!! Form::label('status', 'Estatus') !!}</td>
				<td>{!! Form::select('is_active', [1 => 'Activo', 0 => 'Inactivo'], $premios->is_active, ['placeholder' => 'Seleccione un estatus...', 'class' => 'form-control']) !!}</td>
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