<script type="text/ng-template" id="myModalContent.html">
    <div class="modal-header">
        <h3 class="modal-title">Pregunta</h3>
    </div>
    <div class="modal-body">
        <div class="form-group form-group-sm">
            <label class="control-label small">Redacta la pregunta.</label>
            <input type="text" class="form-control" placeholder="¿Que te parecio el producto 'A'?" ng-model="question.question">
        </div>

        <div class="form-group form-group-sm">
            <label class="control-label small">Tipo de pregunta.</label>
            <select ng-options="item for item in types" ng-model="question.type" class="form-control"></select>
        </div>

        <div ng-show=" question.question!='' || question.type=='Opcion Unica' || question.type=='Multiopcion' || question.type=='Porcentaje' || question.type=='Abierta' || question.type=='Numeros'
        || question.type=='Deslizador'">

            <div class="form-group form-group-sm">
                <label class="control-label small" >Sonido.</label>
                {{-- <input type="file" ng-model="question.sonido" class="form-control"> --}}
                <input type="file"  accept="audio/*"  id="sonido">
            </div>

            <div class="form-group form-group-sm">
                <label class="control-label small" >Video (Url).</label>
                <input ng-model="question.video" type="text" class="form-control">
            </div>

        </div>

            
            <div ng-show="question.type=='Opcion Unica' || question.type=='Multiopcion' || question.type=='Porcentaje' ">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th><button type="button" class="btn btn-info btn-rounded btn-xs waves-effect" ng-click="addAnswer()"><i class="fa fa-plus"></i></button> Agregar Respuesta</th>
                            <th>Puntos</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="a in question.answers">
                            <td><input type="text" ng-model="a.answer" class="form-control" ></td>
                            <td width="20%"><input type="text" ng-model="a.score" class="form-control"></td>
                            <td width="1%"><button type="button" class="btn btn-danger btn-rounded btn-xs waves-effect" ng-confirm-click="Estas seguro?" ng-click="deleteAnswer($index)"><i class="fa fa-close"></i></button></td>
                        </tr>
                    </tbody>

                </table>
            </div>

            <div ng-show="question.type=='Opcion Multiple Imagen' || question.type=='Opcion Unica Imagen' || question.type=='Cajones'">

                <div class="row">
                    <div class="img-thumbnail" ng-repeat="a in question.answers">

                        <img ng-src="@{{ a.image_src  }}"  style="max-width: 100px; max-height: 100px" class="mb10">
                        <div class="text-center"><button type="button" class="btn btn-danger btn-xs" ng-confirm-click="Estas seguro?" ng-click="deleteAnswer($index)"><i class="fa fa-close"></i></button></div>
                    </div>
                </div>


                <hr />
                <input type="file" multiple accept="image/*" id="files">
            </div>


            <div ng-show="question.type=='Tache Paloma Imagen' || question.type=='Dibujar sobre Imagen'">

                <div class="row">
                    <div class="img-thumbnail" ng-repeat="a in question.answers">
                        <img ng-src="@{{ a.image_src  }}"  style="max-width: 100px; max-height: 100px" class="mb10">
                    </div>
                </div>

                <hr />
                <input type="file"  accept="image/*" id="files2">
            </div>

        <div ng-show="question.type=='Cajones 2'">

            <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> La cantidad de respuestas en texto y la cantidad de imagenes deberan ser iguales</div>
            <div class="row">

                <div class="col-md-6">

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th><button type="button" class="btn btn-info btn-rounded btn-xs waves-effect" ng-click="addAnswer()"><i class="fa fa-plus"></i></button> Agregar Respuesta</th>

                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat="a in question.answers" ng-show="a.order!=1">
                            <td><input type="text" ng-model="a.answer" class="form-control" ></td>
                            <td width="1%"><button type="button" class="btn btn-danger btn-rounded btn-xs waves-effect" ng-confirm-click="Estas seguro?" ng-click="deleteAnswer($index)"><i class="fa fa-close"></i></button></td>
                        </tr>
                        </tbody>

                    </table>
                </div>

                <div class="col-md-6">
                    <p>Selecciona las imagenes</p>
                    <input type="file" multiple accept="image/*" id="files3">

                    <div class="img-thumbnail" ng-repeat="a in question.answers" ng-show="a.order==1">

                        <img ng-src="@{{ a.image_src  }}"  style="max-width: 100px; max-height: 100px" class="mb10">
                        <div class="text-center"><button type="button" class="btn btn-danger btn-xs" ng-confirm-click="Estas seguro?" ng-click="deleteAnswer($index)"><i class="fa fa-close"></i></button></div>
                    </div>

                </div>

            </div>

        </div>




    </div>
    <div class="modal-footer">
        <button class="btn btn-primary" type="button" ng-click="ok()">Guardar</button>
        <button class="btn btn-default" type="button" ng-click="cancel()">Cancelar</button>
    </div>
</script>