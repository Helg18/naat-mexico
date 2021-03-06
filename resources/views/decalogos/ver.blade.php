@extends('layouts.secure')

@section('content')

<h1>{{$decalogo->decalogo}}</h1>
<!-- tab style -->
<div class="clearfix tabs-linearrow">
	<ul class="nav nav-tabs">
			<li class=""><a href="{{ route('admin.decalogos.index') }}" hreff="#tab-linearrow-one" -data-toggle="tab"> < Volver</a></li>
		<li class="active"><a href="#" hreff="#tab-linearrow-one" -data-toggle="tab">Detalles</a></li>
	</ul>
	<div class="tab-content" style="text-align: center;">	
	<div class="row">
	<table>
			<tr>
				<td>{!! Form::label('decalogo', 'Decalogo') !!}</td>
				<td>{!! Form::label('decalogo', $decalogo->decalogo) !!}</td>

			</tr>
			<tr>
				<td>{!! Form::label('status', 'Estatus') !!}</td>
				<td>
				@if ($decalogo->is_active == 1)
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