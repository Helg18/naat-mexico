@extends('layouts.secure')

@section('content')

<h1>{{$categoria->categoria}}</h1>
<!-- tab style -->
<div class="clearfix tabs-linearrow">
	<ul class="nav nav-tabs">
			<li class=""><a href="{{ route('admin.categorias.index') }}" hreff="#tab-linearrow-one" -data-toggle="tab"> < Volver</a></li>
		<li class="active"><a href="#" hreff="#tab-linearrow-one" -data-toggle="tab">Detalles</a></li>
	</ul>
	<div class="tab-content" style="text-align: center;">	
	<div class="row">
	<table>
			<tr>
				<td>{!! Form::label('categoria', 'Categoria') !!}</td>
				<td>{!! Form::label('categoria', $categoria->categoria) !!}</td>
			</tr>

			<tr>
				<td>{!! Form::label('status', 'Estatus') !!}</td>
				<td>
				@if ($categoria->is_active == 1)
				Activo
				@else
				Inactivo
				@endif
			</td>
		</table>	
	</div>
	<hr>
	<div class="row">
		<table>
			<thead>
				<tr>
					<td colspan="2"> Subcategorias</td>
				</tr>
			</thead>
			<tbody>
				@foreach ($subcategorias as $subcategoria)
				<tr>
					<td>{{ $subcategoria->subcategoria }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	</div>
</div>
@endsection