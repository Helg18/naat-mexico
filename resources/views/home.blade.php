@extends('layouts.secure')

@section('content')
    <div class="page page-dashboard">

        <div class="panel mb20 panel-default">

            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <div id="c3chartAnalytics"></div>
                    </div>

                    <div class="col-md-6">

                        <select class="form-control" style="border: 1px solid #e0e0e0;">
                            <option>Encuesta de prueba</option>
                        </select>

                        <div class="table-responsive">
                            <table class="table table-small">
                                <thead>
                                <tr>
                                    <th>Resultados</th>
                                    <th>Contestados</th>
                                    <th>Pendientes de Contacto</th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Luis Gilberto</td>
                                    <td>20</td>
                                    <td>5</td>

                                </tr>
                                <tr>
                                    <td>Mónica</td>
                                    <td>20</td>
                                    <td>5</td>

                                </tr>
                                <tr>
                                    <td>Roberto</td>
                                    <td>20</td>
                                    <td>5</td>

                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Porcentaje</th>
                                    <th>100%</th>
                                    <th>33.33%</th>


                                </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>





        <div class="panel panel-default mb20 panel-hovered">
            <div class="panel-heading">Estadisticas de ejemplo</div>
            <div class="panel-body text-center">
                <div id="c3chartbrowsershare"></div>
            </div>
        </div>


    </div>
@endsection