
@extends('layouts.secure')

@section('content')

    <div class="page-header">
        <h1>Mis Encuestas <small class="pull-right"><a href="{{url('report/excel')}}" class="btn btn-success">Todas en Excel</a></small></h1>
    </div>

    <div ng-controller="ReportCtrl">
    @foreach($quizzes as $quiz)


        <div class="panel panel-lined table-responsive panel-hovered mb20 data-table" style="padding-bottom: 20px">
            <div class="panel-heading">{{$quiz->name}} <div class="pull-right"><a href="{{url('report/excel?id=' . $quiz->id)}}" class="btn btn-success">Excel</a></div></div>
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
                    <tr>
                    <th>Persona</th>
                    @foreach($quiz->questions as $q)
                        <th>{{$q->question}}<br /><small>({{$q->type}})</small></th>
                    @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($quiz->users as $u)
                        <tr>
                        <td><a href="javascript: void(0);" ng-click="userDetail({{$u->id}})">{{$u->name}} ({{$u->email}})</a></td>
                        @foreach($quiz->questions as $q)
                            <td>{!! $q->userAnswerString($u) !!}</td>
                        @endforeach
                        </tr>
                    @endforeach

                </tbody>
            </table>

            <!-- #end data table -->

        </div>


    @endforeach
    @include('report.modal')
    </div>


@endsection