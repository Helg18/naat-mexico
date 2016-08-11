@if($register)
    <div ng-controller="GroupCtrl" class="ng-cloak">
        <script>var group_id = '{{$register->id}}';</script>
        <hr />


        <table class="table table-striped">
            <thead>
            <tr>
                <th><button type="button" class="btn btn-xs btn-info btn-rounded waves-effect" ng-click="modalEmail()"><i class="fa fa-plus"></i></button> Agregar Email</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="e in emails">
                <td><a href="javascript: void(0);" ng-click="modalEmail(e)">@{{ e.email }}</a></td>
                <td width="1%"><button type="button" class="btn btn-danger btn-rounded btn-xs waves-effect" ng-confirm-click="Estas seguro?" ng-click="deleteEmail(e)"><i class="fa fa-close"></i></button></td>
            </tr>
            </tbody>
        </table>


        @include('company.group.modal')
    </div>
@endif