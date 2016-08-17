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
		<div class="tabs-linearrow">
			<ul class="nav nav-tabs">
					<li class=""><a href="{{ route('admin.subcategorias.create', $categoria->id) }}" hreff="#tab-linearrow-one" -data-toggle="tab"><i class="ion ion-plus-round"></i> Agregar Subcategoria</a></li>
				<li class="active"><a href="#" hreff="#tab-linearrow-one" -data-toggle="tab">Subcategorias</a></li>
			</ul>
		</div>
		<table>
		<thead>
			<tr>
				<td colspan="2">Subcategorias</td>
			</tr>
		</thead>
			<tbody>
				@foreach ($subcategorias as $subcategoria)
				<tr>
					<td>{{ $subcategoria->subcategoria }}</td>
					<td>
						<a href="{{ route('admin.subcategoria.show', $subcategoria->id) }}">
							<i class="ion ion-arrow-right-b"></i>
							<span class="text">Ver</span>
						</a>
					</td>
					<td>
						<a href="{{ route('admin.subcategoria.edit', $subcategoria->id) }}">
							<i class="ion ion-edit"></i>
							<span class="text">Editar</span>
						</a>
					</td>
					<td>
					{!! Form::open(['route' => ['admin.subcategoria.destroy', $subcategoria->id], 'method' => 'DELETE']) !!}
							<button class="btn btn-link"  type="submit">
								<i class="ion ion-trash-a"></i>
								<span class="text">Eliminar</span>
							</button>
					{!! Form::close() !!}
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	</div>
</div>
@endsection