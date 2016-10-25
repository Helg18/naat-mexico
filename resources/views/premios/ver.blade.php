@extends('layouts.secure')

@section('content')

<h1>{{$premio->premios}}</h1>
<!-- tab style -->
<div class="clearfix tabs-linearrow">
	<ul class="nav nav-tabs">
			<li class=""><a href="{{ route('admin.premios.index') }}" hreff="#tab-linearrow-one" -data-toggle="tab"> < Volver</a></li>
		<li class="active"><a href="#" hreff="#tab-linearrow-one" -data-toggle="tab">Detalles</a></li>
	</ul>
	<div class="tab-content" style="text-align: center;">	
	<div class="row">
	<table>
			<tr>
				<td>{!! Form::label('premios', 'Premio') !!}</td>
				<td>{!! Form::label('premios', $premio->premios) !!}</td>

			</tr>
			<tr>
				<td>{!! Form::label('descipcion', 'Descripcion del premio') !!}</td>
				<td>{{ $premio->descripcion_premios }}</td>
			</tr>
			<tr>
				<td>{!! Form::label('status', 'Estatus') !!}</td>
				<td>
				@if ($premio->is_active == 1)
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