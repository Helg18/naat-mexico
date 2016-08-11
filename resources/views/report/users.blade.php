
@extends('layouts.secure')

@section('content')

    <div class="page-header">
        <h1>Personas que han contestado Mis Encuestas</h1>
    </div>

    <div ng-controller="ReportCtrl">



            <div class="panel panel-lined table-responsive panel-hovered mb20 data-table" style="padding-bottom: 20px">
                <div class="panel-heading">Personas</div>
                <div class="panel-body">
                    <div class="small text-bold left mt5">
                        Mostrar&nbsp;
                        <select class="lengthSelect">
                            <option value="5">5</option>
                            <option value="10" selected="">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                        </select>
                        &nbsp;personas
                    </div>

                    <form class="form-horizontal right col-lg-4" action="javascript:;">
                        <input type="text" class="form-control input-sm searchInput" placeholder="Buscar en la tabla">
                    </form>
                </div>
                <!-- data table -->

                <table class="table">
                    <thead>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Encuestas</th>
                        <th>Nivel NSE</th>
                        <th>Puntos NSE</th>
                        <th>Edad</th>
                        <th>Sexo</th>
                        <th>Estado Civil</th>
                        <th>Dirección</th>
                        <th>Puntos</th>

                    </thead>
                    <tbody>
                        @foreach($users as $u)
                            <tr>
                        <td>{{$u->name}} {{$u->survey_respondent->last_name}}</td>
                        <td>{{$u->email}}</td>
                        <td>{{$u->quizzes->implode('name',', ')}}</td>
                        <td>{{$u->survey_respondent->nse() ? $u->survey_respondent->nse()->name : '' }}</td>
                        <td>{{$u->survey_respondent->nse_points}}</td>
                        <td>{{$u->survey_respondent->age}}</td>
                        <td>{{$u->survey_respondent->sex}}</td>
                        <td>{{$u->survey_respondent->marital_status}}</td>
                        <td>{{$u->survey_respondent->address }} {{$u->survey_respondent->city }} {{$u->survey_respondent->state }} {{$u->survey_respondent->zip }} </td>
                        <td>{{$u->survey_respondent->earned_points}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- #end data table -->

            </div>



        @include('report.modal')
    </div>


@endsection