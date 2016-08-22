@extends('layouts.secure')

@section('content')

<h1>Listado de Decalogos</h1>
<!-- tab style -->
<div class="clearfix tabs-linearrow">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#" hreff="#tab-linearrow-one" -data-toggle="tab">Decalogos</a></li>
		<li class=""><a href="{{ route('admin.decalogos.create') }}" hreff="#tab-linearrow-one" -data-toggle="tab">Agregar</a></li>
	</ul>
	<div class="tab-content" style="text-align: center;">
	<table width="100%">
		<thead>
			<td>Titulo</td>
			<td></td>
			<td></td>
			<td></td>
		</thead>
		<tbody>
		@foreach ($decalogos as $decalogo)
			<tr>
				<td>{!! $decalogo->decalogo !!}</td>
				<td>
					<a href="{{ route('admin.decalogos.show', $decalogo->id) }}">
						<i class="ion ion-arrow-right-b"></i>
						<span class="text">Ver</span>
					</a>
				</td>
				<td>
					<a href="{{ route('admin.decalogos.edit', $decalogo->id) }}">
						<i class="ion ion-edit"></i>
						<span class="text">Editar</span>
					</a>
				</td>
				<td>
				{!! Form::open(['route' => ['admin.decalogos.destroy', $decalogo->id], 'method' => 'DELETE']) !!}
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
<!-- tab style -->
<script>var change_menu='menu-user';</script>
@endsection