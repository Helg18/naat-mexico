@extends('layouts.secure')

@section('content')

<h1>Empresas</h1>
<!-- tab style -->
<div class="clearfix tabs-linearrow">
	<ul class="nav nav-tabs">
		<li class="{{ $register || count($errors)>0 ? '' : 'active' }}"><a href="{{url('companies')}}" hreff="#tab-linearrow-one" -data-toggle="tab">CONSULTAS</a></li>

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

                                <br /><br />

							<!-- data table -->
							<table class="table table-bordered table-striped">
								<thead>
									<tr>
									    <th>Nombre</th>
                                        <th>Ejecutivo</th>
                                        <th>Expiración</th>
										<th>Status</th>
										<th>Eliminar</th>

									</tr>
								</thead>
								<tbody>
									<!-- data initialize via script, can also be load via ajax -->
									@foreach($registers as $u)
									<tr class="{{!$u->is_active ? 'text-disable' : ''}}">
									    <td><a href="{{url("companies/{$u->id}/edit")}}">{{$u->name}}</a></td>
                                        <td>{{$u->user->name}}</td>
                                        <td>{{$u->expiration}}</td>
									    <td><a href="{{url("companies/{$u->id}/status")}}">{{$u->is_active_slug()}}</a></td>
									    <td width="5%">
									        @if($u->canDelete())
									        <a href="{{url("companies/{$u->id}")}}" data-method="delete" data-token="{{csrf_token()}}" data-confirm="Estas seguro?" class="md-fab md-primary md-button md-mini waves-effect"><i class="fa fa-remove"></i></a>
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
		    <form role="form" class="form-horizontal" method="POST" action="{{ url('companies') }}{{$register ? "/{$register->id}" : ''}}">
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


                <div class="form-group">
                    <label class="col-md-2 control-label">Información Adicional</label>
                    <div class="col-md-10">

                        <textarea class="form-control" name="information" autocomplete="off" rows="5">{{$register ? $register->information : old('information')}}</textarea>
                        @if ($errors->has('information'))
                            <span class="alert alert-danger">
                            <strong>{{ $errors->first('information') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                @if(!$register)
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Paquete Inicial</label>
                                <div class="col-md-8">
                                    <select class="form-control" required name="plan_id" id="plan_id">
                                        <option value="">Seleccione</option>
                                        @foreach($plans as $p)
                                            <option value="{{$p->id}}">{{$p->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" id="plan_info">

                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-2 control-label">Usuario Inicial</label>
                        <div class="col-md-5">
                            <input type="text" placeholder="Nombre" class="form-control" name="user_name" required>
                        </div>
                        <div class="col-md-5">
                            <input type="text" placeholder="Email" class="form-control" name="email" required>
                        </div>
                    </div>

                @else
                    <div class="alert alert-info col-md-offset-2">
                        <!--<h4 class="text-light mt0">Información del plan</h4>-->
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Usuarios:</strong> {{$register->limit_user}}</p>
                                <p><strong>Encuestas:</strong> {{$register->limit_quiz}}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Fecha expiración:</strong> {{$register->expiration}}</p>
                            </div>
                        </div>
                    </div>
                @endif





                <div class="btn-group col-md-offset-2">
                    <!--<button class="btn btn-default">Borrar</button>-->
                    @if($register)
                        <a href="{{url("companies/{$register->id}")}}" data-method="delete"
                           data-token="{{csrf_token()}}" data-confirm="Estas seguro?" class="btn btn-default">Borrar</a>
                    @endif
                    <button class="btn btn-success" type="submit">Guardar</button>
                </div>



		    </form>


            @if($register)
                <hr />
                <h4>Historial de compras</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Plan</th>
                            <th>Limite Usuarios</th>
                            <th>Limite Encuestas</th>
                            <th>Días Expiración</th>
                            <th class="text-right">Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($register->purchases as $p)
                        <tr>
                            <td>{{$p->plan_name}}</td>
                            <td>{{$p->limit_user}}</td>
                            <td>{{$p->limit_quiz}}</td>
                            <td>{{$p->days_expiration}}</td>
                            <td class="text-right">$ {{number_format($p->price,2)}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

		</div>
	</div>
</div>
<!-- tab style -->
<script>var change_menu='menu-companies';</script>
@endsection