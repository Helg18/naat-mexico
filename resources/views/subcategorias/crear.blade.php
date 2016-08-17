@extends('layouts.secure')

@section('content')

<h1>Agregar nueva Subcategoria</h1>
<!-- tab style -->
<div class="clearfix tabs-linearrow">
	<ul class="nav nav-tabs">
		<li class=""><a href="{{ URL::previous() }}" hreff="#tab-linearrow-one" -data-toggle="tab"> < Volver</a></li>
		<li class="active"><a href="#" hreff="#tab-linearrow-one" -data-toggle="tab">Nueva subcategoria</a></li>
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
	{!! Form::open(['route' => 'admin.subcategoria.store', 'method'=>'post']) !!}
	<table>
		<tr>
			<td>{!! Form::label('categoria', 'Categoria') !!}   {!! Form::label('categoria', $categoria->categoria) !!}</td>
			<td>{!! Form::hidden('categoria', $categoria->categoria, [ 'class' => 'form-control']) !!}</td>
			<td>{!! Form::hidden('id_categoria', $categoria->id, [ 'class' => 'form-control']) !!}</td>
		</tr>
		<tr>
			<td>{!! Form::label('subcategoria', 'Subcategoria') !!}</td>
			<td>{!! Form::text('subcategoria', '', [ 'class' => 'form-control']) !!}</td>
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