@extends('layouts.secure')

@section('content')

<h1>Usuarios</h1>
<!-- tab style -->
<div class="clearfix tabs-linearrow">
	<ul class="nav nav-tabs">
		<li class="{{ $user || count($errors)>0 ? '' : 'active' }}"><a href="{{url($module)}}" hreff="#tab-linearrow-one" -data-toggle="tab">CONSULTAS</a></li>

		<li class="{{ $user || count($errors)>0 ? 'active' : '' }}"><a href="#tab-create" data-toggle="tab">{{ $user ? 'EDITAR' : 'NUEVO' }}</a></li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane {{ $user|| count($errors)>0  ? '' : 'active' }}" id="tab-linearrow-one">

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
									    <th>
                                    		Username
                                    		<!--<div class="th">
                                    			<i class="fa fa-caret-up icon-up"></i>
                                    			<i class="fa fa-caret-down icon-down"></i>
                                    		</div>-->
                                    	</th>
										<th>
											Nombre
											<!--<div class="th">
												<i class="fa fa-caret-up icon-up"></i>
												<i class="fa fa-caret-down icon-down"></i>
											</div>-->
										</th>

										<th>
											Rol
											<!--<div class="th">
												<i class="fa fa-caret-up icon-up"></i>
												<i class="fa fa-caret-down icon-down"></i>
											</div>-->
										</th>
										<th>
											Status
											<!--<div class="th">
												<i class="fa fa-caret-up icon-up"></i>
												<i class="fa fa-caret-down icon-down"></i>
											</div>-->
										</th>
										<th>Eliminar</th>

									</tr>
								</thead>
								<tbody>
									<!-- data initialize via script, can also be load via ajax -->

									@foreach($users as $u)
									<tr class="{{!$u->is_active ? 'text-disable' : ''}}">
									    <td><a href="{{url($module ."/{$u->id}/edit")}}">{{$u->email}}</a></td>
									    <td>{{$u->name}}</td>
									    <td>{{$u->roles->implode('name',',')}}</td>
									    <td><a href="{{url($module."/{$u->id}/status")}}">{{$u->is_active_slug()}}</a></td>
									    <td width="5%">
									        @if($u->canDelete())
									        <a href="{{url($module."/{$u->id}")}}" data-method="delete" data-token="{{csrf_token()}}" data-confirm="Estas seguro?" class="md-fab md-primary md-button md-mini waves-effect"><i class="fa fa-remove"></i></a>
									        @endif
									    </td>
									</tr>
									@endforeach
								</tbody>
							</table>
							<!-- #end data table -->
							</div>



		</div>

		<div class="tab-pane {{ $user || count($errors)>0  ? 'active' : '' }}" id="tab-create">
		    <form role="form" class="form-horizontal" method="POST" action="{{ url($module) }}{{$user ? "/{$user->id}" : ''}}">
		    {!! csrf_field() !!}

		        @if($user)
		        <input type="hidden" name="_method" value="PUT">
		        @endif

                <div class="form-group">
                    <label class="col-md-2 control-label">Nombre Completo</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" value="{{$user ? $user->name : old('name')}}" name="name" autocomplete="off">
                        @if ($errors->has('name'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-md-2">
                        <div class="ui-checkbox ui-checkbox-success ui-checkbox-circle">
                            <label>
                                <input type="checkbox" {{ ($user && $user->is_active) || !$user ? 'checked' : '' }} name="is_active">
                                <span>Esta activo</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @if(!Shinobi::is('customer'))
                    <div class="col-md-4">

                        <select class="form-control" required name="role_id">
                            <option selected disabled>Seleccione un Rol</option>
                            @foreach($roles as $r)
                            <option value="{{$r->id}}" {{$user && $user->is($r->slug) ? 'selected' : ''}}>{{$r->name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('role_id'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('role_id') }}</strong>
                            </span>
                        @endif

                    </div>
                    @endif

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-{{Shinobi::is('customer') ? 2 : 3}} control-label">Usuario</label>
                            <div class="col-md-{{Shinobi::is('customer') ? 10 : 9}}">
                                <div class="input-group">
                                    <span class="input-group-addon ion ion-person"></span>
                                    <input type="text" class="form-control" placeholder="10 caracteres, letras y/o números" value="{{$user ? $user->email : old('email')}}" name="email" autocomplete="off">
                                    @if ($errors->has('email'))
                                        <span class="alert alert-danger">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Contraseña</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <span class="input-group-addon ion ion-locked"></span>
                                    <input type="password" class="form-control" placeholder="10 caracteres, letras y/o números" name="password">
                                    @if ($errors->has('password'))
                                         <span class="alert alert-danger">
                                             <strong>{{ $errors->first('password') }}</strong>
                                         </span>
                                     @endif
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Confirmación</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <span class="input-group-addon ion ion-locked"></span>
                                    <input type="password" class="form-control" placeholder="10 caracteres, letras y/o números" name="password_confirmation">
                                    @if ($errors->has('password_confirmation'))
                                        <span class="alert alert-danger">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="btn-group">
                            <!--<button class="btn btn-default">Borrar</button>-->
                            @if($user)
                            <a href="{{url($module."/{$user->id}")}}" data-method="delete"
                              data-token="{{csrf_token()}}" data-confirm="Estas seguro?" class="btn btn-default">Borrar</a>
                            @endif
                            <button class="btn btn-success" type="submit">Guardar</button>
                        </div>
                    </div>
                </div>



		    </form>
		</div>
	</div>
</div>
<!-- tab style -->
<script>var change_menu='menu-user';</script>
@endsection