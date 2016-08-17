@extends('layouts.secure')

@section('content')

<h1>Agregar nueva categoria</h1>
<!-- tab style -->
<div class="clearfix tabs-linearrow">
	<ul class="nav nav-tabs">
		<li class=""><a href="{{ route('admin.categorias.index') }}" hreff="#tab-linearrow-one" -data-toggle="tab"> < Volver</a></li>
		<li class="active"><a href="{{ route('admin.categorias.create') }}" hreff="#tab-linearrow-one" -data-toggle="tab">Agregar</a></li>
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
	{!! Form::open(['route' => 'admin.categorias.store', 'method'=>'post']) !!}
	<table>
		<tr>
			<td>{!! Form::label('categoria', 'Categoria') !!}</td>
			<td>{!! Form::text('categoria', '', [ 'class' => 'form-control']) !!}</td>

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