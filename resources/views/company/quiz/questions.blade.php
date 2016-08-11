@if($register)
    <div ng-controller="QuizCtrl" class="ng-cloak">
        <script>var quiz_id = '{{$register->id}}';</script>
        <hr />


        <table class="table table-striped">
            <thead>
            <tr>
                <th><button type="button" class="btn btn-xs btn-info btn-rounded waves-effect" ng-click="modalQuestion()"><i class="fa fa-plus"></i></button> Agregar Pregunta</th>
                <th>Tipo de pregunta</th>
                <th>Respuestas</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="q in questions">
                <td><a href="javascript: void(0);" ng-click="modalQuestion(q)">@{{ q.question }}</a></td>
                <td>@{{ q.type }}</td>
                <td>
                    <label class="label label-info mr5" ng-repeat="a in q.answers_json" ng-show="!a.image_src">@{{ a.answer }}</label>
                    <img ng-src="@{{a.image_src}}" ng-repeat="a in q.answers_json" style="max-width: 40px; max-height: 40px;">
                </td>
                <td width="1%"><button type="button" class="btn btn-danger btn-rounded btn-xs waves-effect" ng-confirm-click="Estas seguro?" ng-click="deleteQuestion(q)"><i class="fa fa-close"></i></button></td>
            </tr>
            </tbody>
        </table>


        @include('company.quiz.modal')
    </div>
@endif