<script type="text/ng-template" id="myModalContent.html">
    <div class="modal-header">
        <h3 class="modal-title">Detalles del Usuario</h3>
    </div>
    <div class="modal-body">


        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <label class="col-md-3">Nombre</label>
                    <div class="col-md-9">@{{user.name}} @{{user.last_name}}</div>
                </div>


                <div class="row">
                    <label class="col-md-3">Email</label>
                    <div class="col-md-9">@{{user.email}}</div>
                </div>

                <strong>Direccion</strong><br />
                <p>@{{ user.address }} @{{ user.city }} @{{ user.state }} @{{ user.zip }}</p>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <label class="col-md-4">Sexo</label>
                    <div class="col-md-8">@{{user.sex}}</div>
                </div>

                <div class="row">
                    <label class="col-md-4">Estado Civil</label>
                    <div class="col-md-8">@{{user.marital_status}}</div>
                </div>

                <div class="row">
                    <label class="col-md-4">Nacimiento</label>
                    <div class="col-md-8">@{{user.day_of_birth}} <small>(@{{ user.age }} años)</small></div>
                </div>

                <div class="row">
                    <label class="col-md-4">Puntos por Encuestas</label>
                    <div class="col-md-8">@{{user.earned_points}}</div>
                </div>

                <div class="row">
                    <label class="col-md-4">Puntos NSE</label>
                    <div class="col-md-8">@{{user.nse_points}}</div>
                </div>

                <div class="row">
                    <label class="col-md-4">Nivel NSE</label>
                    <div class="col-md-8"><big style="color: gold">@{{user.nse}}</big></div>
                </div>


            </div>
        </div>






    </div>
    <div class="modal-footer">
        <button class="btn btn-primary" type="button" ng-click="ok()">Ok</button>
    </div>
</script>