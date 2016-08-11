@extends('layouts.secure')

@section('content')

<h1>Puntos por Nivel Regla 8X7</h1>
<!-- tab style -->
<div class="clearfix tabs-linearrow">
	<ul class="nav nav-tabs">
		<li class="{{ $register || count($errors)>0 ? '' : 'active' }}"><a href="{{url('nse/level')}}" hreff="#tab-linearrow-one" -data-toggle="tab">CONSULTAS</a></li>

		<li class="{{ $register || count($errors)>0 ? 'active' : '' }}"><a href="#tab-create" data-toggle="tab">{{ $register ? 'EDITAR' : 'NUEVO' }}</a></li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane {{ $register|| count($errors)>0  ? '' : 'active' }}" id="tab-linearrow-one">

<!-- Data Table -->


                            <div class="data-table">

									<div class="small text-bold left mt5">
										Mostrar&nbsp;
										<select class="lengthSelect" >
											<option value="5">5</option>
											<option value="10" selected>10</option>
											<option value="20">20</option>
											<option value="50">50</option>
										</select>
										&nbsp;registros
									</div>

									<form class="form-horizontal right col-lg-4" action="javascript:;">
										<input type="text" class="form-control input-sm searchInput" placeholder="Buscar">
									</form>

                                <br />
                                <br />

							<!-- data table -->
							<table class="table table-bordered table-striped">
								<thead>
									<tr>
									    <th>Nombre</th>
										<th>Minimo</th>
                                        <th>Máximo</th>
										<th>Eliminar</th>

									</tr>
								</thead>
								<tbody>
									<!-- data initialize via script, can also be load via ajax -->
									@foreach($registers as $u)
									<tr>
									    <td><a href="{{url("nse/level/{$u->id}/edit")}}">{{$u->name}}</a></td>
                                        <td>{{$u->min}}</td>
                                        <td>{{$u->max}}</td>

									    <td width="5%">
									        @if($u->canDelete())
									        <a href="{{url("nse/level/{$u->id}")}}" data-method="delete" data-token="{{csrf_token()}}" data-confirm="Estas seguro?" class="md-fab md-primary md-button md-mini waves-effect"><i class="fa fa-remove"></i></a>
									        @endif
									    </td>
									</tr>
									@endforeach
								</tbody>
							</table>
							<!-- #end data table -->
							</div>



		</div>

		<div class="tab-pane {{ $register || count($errors)>0  ? 'active' : '' }}" id="tab-create">
		    <form role="form" class="form-horizontal" method="POST" action="{{ url('nse/level') }}{{$register ? "/{$register->id}" : ''}}">
		    {!! csrf_field() !!}

		        @if($register)
		        <input type="hidden" name="_method" value="PUT">
		        @endif

                <div class="form-group">
                    <label class="col-md-2 control-label">Nombre</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" value="{{$register ? $register->name : old('name')}}" name="name" autocomplete="off">
                        @if ($errors->has('name'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-md-2">
                        <div class="ui-checkbox ui-checkbox-success ui-checkbox-circle">
                            <label>
                                <input type="checkbox" {{ ($register && $register->is_active) || !$register ? 'checked' : '' }} name="is_active">
                                <span>Esta activo</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="col-md-4 control-label">Limite de minimo</label>
                        <div class="col-md-8">
                            <input type="number" class="form-control" value="{{$register ? $register->min : old('min')}}" name="min" autocomplete="off">
                            @if ($errors->has('min'))
                                <span class="alert alert-danger">
                                <strong>{{ $errors->first('min') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group col-md-6">
                        <label class="col-md-4 control-label">Limite de máximo</label>
                        <div class="col-md-8">
                            <input type="number" class="form-control" value="{{$register ? $register->max : old('max')}}" name="max" autocomplete="off">
                            @if ($errors->has('max'))
                                <span class="alert alert-danger">
                                <strong>{{ $errors->first('max') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>







                <div class="btn-group col-md-offset-2">
                    <!--<button class="btn btn-default">Borrar</button>-->
                    @if($register)
                        <a href="{{url("nse/level/{$register->id}")}}" data-method="delete"
                           data-token="{{csrf_token()}}" data-confirm="Estas seguro?" class="btn btn-default">Borrar</a>
                    @endif
                    <button class="btn btn-success" type="submit">Guardar</button>
                </div>



		    </form>
		</div>
	</div>
</div>
<!-- tab style -->
<script>var change_menu='menu-nse';</script>
@endsection