@extends('layouts.secure')

@section('content')

<h1>Encuestas</h1>
<!-- tab style -->
<div class="clearfix tabs-linearrow">
	<ul class="nav nav-tabs">
		<li class="{{ $register || count($errors)>0 ? '' : 'active' }}"><a href="{{url('company/quiz')}}" hreff="#tab-linearrow-one" -data-toggle="tab">CONSULTAS</a></li>

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
										<th>Nivel NSE</th>
										<th>Es Privada</th>
										<th>Status</th>
										<th>Eliminar</th>

									</tr>
								</thead>
								<tbody>
									<!-- data initialize via script, can also be load via ajax -->
									@foreach($registers as $u)
									<tr class="{{!$u->is_active ? 'text-disable' : ''}}">
									    <td><a href="{{url("company/quiz/{$u->id}/edit")}}">{{$u->name}}</a></td>
										<td>{{$u->nse_level ? $u->nse_level->name : 'Ninguno'}}</td>
										<td>{{$u->is_private_slug}}</td>

									    <td><a href="{{url("company/quiz/{$u->id}/status")}}">{{$u->is_active_slug()}}</a></td>
									    <td width="5%">
									        @if($u->canDelete())
									        <a href="{{url("company/quiz/{$u->id}")}}" data-method="delete" data-token="{{csrf_token()}}" data-confirm="Estas seguro?" class="md-fab md-primary md-button md-mini waves-effect"><i class="fa fa-remove"></i></a>
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
		    <form  role="form" class="form-horizontal" method="POST" action="{{ url('company/quiz') }}{{$register ? "/{$register->id}" : ''}}">
		    {!! csrf_field() !!}

		        @if($register)
		        <input type="hidden" name="_method" value="PUT">
		        @endif

                <div class="form-group">
                    <label class="col-md-2 control-label">Nombre</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" value="{{$register ? $register->name : old('name')}}" name="name" autocomplete="off">
                        @if ($errors->has('name'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-md-1">
                        <div class="ui-checkbox ui-checkbox-success ui-checkbox-circle">
                            <label>
                                <input type="checkbox" {{ ($register && $register->is_active) || !$register ? 'checked' : '' }} name="is_active">
                                <span>Esta activa</span>
                            </label>
                        </div>
                    </div>
                </div>



				<div class="row">
					<div class="form-group col-md-6">
						<label class="col-md-4 control-label">Nivel NSE</label>
						<div class="col-md-8">
							<select class="form-control" name="nse_level_id">
								<option value="">Ninguno</option>
								@foreach($nse_levels as $l)
									<option value="{{$l->id}}" {{$register && $l->id==$register->nse_level_id ? 'selected' : ''}}>{{$l->name}}</option>
								@endforeach
							</select>


							@if ($errors->has('nse_level_id'))
								<span class="alert alert-danger">
                                <strong>{{ $errors->first('nse_level_id') }}</strong>
                            </span>
							@endif
						</div>
					</div>


					<div class="form-group col-md-6">
						<label class="col-md-4 control-label">Puntos ganados</label>
						<div class="col-md-8">
							<input type="text" class="form-control" value="{{$register ? $register->points : old('points')}}" name="points" autocomplete="off">
							@if ($errors->has('points'))
								<span class="alert alert-danger">
                                <strong>{{ $errors->first('points') }}</strong>
                            </span>
							@endif
						</div>
					</div>
				</div>


				<div class="row">
					<label class="col-md-2 control-label">Visibilidad</label>

					<div class="col-md-3">
						<div class="ui-checkbox ui-checkbox-success ui-checkbox-circle">
							<label>
								<input type="checkbox" {{ ($register && $register->is_private) || !$register ? 'checked' : '' }} name="is_private">
								<span>Es privada</span>
							</label>
						</div>
					</div>


					<label class="col-md-2 control-label text-right">Aplicar a grupo</label>
					<div class="col-md-5">
						<select class="form-control" name="send_group_id">
							<option value="">Todos</option>
							@foreach($groups as $g)
								<option {{$register && $register->send_group_id == $g->id ? 'selected' : ''}} value="{{$g->id}}">{{$g->name}}</option>
							@endforeach
						</select>
					</div>
				</div>

				<br />

				<div class="row">

					<label class="col-md-2 control-label">Ultima Fecha Envio</label>
					<div class="col-md-3">
						{{ $register ? $register->last_active : 'Nunca' }}
					</div>

					<label class="col-md-2 control-label">Estado</label>
					<div class="col-md-3">
						<select class="form-control" name="state">
							<option value="">Todos</option>
							<option {{$register && $register->state == "Aguascalientes" ? 'selected' : ''}}>Aguascalientes</option>
							<option {{$register && $register->state == "Baja California" ? 'selected' : ''}}>Baja California</option>
							<option {{$register && $register->state == "Baja California Sur" ? 'selected' : ''}}>Baja California Sur</option>
							<option {{$register && $register->state == "Campeche" ? 'selected' : ''}}>Campeche</option>
							<option {{$register && $register->state == "Chiapas" ? 'selected' : ''}}>Chiapas</option>
							<option {{$register && $register->state == "Chihuahua" ? 'selected' : ''}}>Chihuahua</option>
							<option {{$register && $register->state == "Coahuila" ? 'selected' : ''}}>Coahuila</option>
							<option {{$register && $register->state == "Colima" ? 'selected' : ''}}>Colima</option>
							<option {{$register && $register->state == "Ciudad de México" ? 'selected' : ''}}>Ciudad de México</option>
							<option {{$register && $register->state == "Durango" ? 'selected' : ''}}>Durango</option>
							<option {{$register && $register->state == "Guanajuato" ? 'selected' : ''}}>Guanajuato</option>
							<option {{$register && $register->state == "Guerrero" ? 'selected' : ''}}>Guerrero</option>
							<option {{$register && $register->state == "Hidalgo" ? 'selected' : ''}}>Hidalgo</option>
							<option {{$register && $register->state == "Jalisco" ? 'selected' : ''}}>Jalisco</option>
							<option {{$register && $register->state == "Estado de México" ? 'selected' : ''}}>Estado de México</option>
							<option {{$register && $register->state == "Michoacán" ? 'selected' : ''}}>Michoacán</option>
							<option {{$register && $register->state == "Morelos" ? 'selected' : ''}}>Morelos</option>
							<option {{$register && $register->state == "Nayarit" ? 'selected' : ''}}>Nayarit</option>
							<option {{$register && $register->state == "Nuevo León" ? 'selected' : ''}}>Nuevo León</option>
							<option {{$register && $register->state == "Oaxaca" ? 'selected' : ''}}>Oaxaca</option>
							<option {{$register && $register->state == "Puebla" ? 'selected' : ''}}>Puebla</option>
							<option {{$register && $register->state == "Querétaro" ? 'selected' : ''}}>Querétaro</option>
							<option {{$register && $register->state == "Quintana Roo" ? 'selected' : ''}}>Quintana Roo</option>
							<option {{$register && $register->state == "San Luis Potosí" ? 'selected' : ''}}>San Luis Potosí</option>
							<option {{$register && $register->state == "Sinaloa" ? 'selected' : ''}}>Sinaloa</option>
							<option {{$register && $register->state == "Sonora" ? 'selected' : ''}}>Sonora</option>
							<option {{$register && $register->state == "Tabasco" ? 'selected' : ''}}>Tabasco</option>
							<option {{$register && $register->state == "Tamaulipas" ? 'selected' : ''}}>Tamaulipas</option>
							<option {{$register && $register->state == "Tlaxcala" ? 'selected' : ''}}>Tlaxcala</option>
							<option {{$register && $register->state == "Veracruz" ? 'selected' : ''}}>Veracruz</option>
							<option {{$register && $register->state == "Yucatán" ? 'selected' : ''}}>Yucatán</option>
							<option {{$register && $register->state == "Zacatecas" ? 'selected' : ''}}>Zacatecas</option>



						</select>

					</div>

					@if($register)
					<div class="col-md-1">
						<div class="ui-checkbox ui-checkbox-success ui-checkbox-circle">
							<label>
								<input type="checkbox"  name="reactivate">
								<span>Reenviar</span>
							</label>
						</div>
					</div>
					@endif

				</div>

				<br />

                <div class="btn-group col-md-offset-2">
                    <!--<button class="btn btn-default">Borrar</button>-->
                    @if($register)
                        <a href="{{url("config/quiz/{$register->id}")}}" data-method="delete"
                           data-token="{{csrf_token()}}" data-confirm="Estas seguro?" class="btn btn-default">Borrar</a>
                    @endif
                    <button class="btn btn-success" type="submit">Guardar</button>
                </div>



		    </form>


			@include('company.quiz.questions',['register'=>$register])
		</div>
	</div>
</div>
<!-- tab style -->
<script>var change_menu='menu-quiz';</script>
@endsection