<div class="alert alert-info">
    <h4 class="text-light mt0">Información del plan</h4>
    <div class="row">
        <div class="col-md-6">
            <p><strong>Nombre:</strong> {{$plan->name}}</p>
            <p><strong>Usuarios:</strong> {{$plan->limit_user}}</p>
            <p><strong>Encuestas:</strong> {{$plan->limit_quiz}}</p>
        </div>
        <div class="col-md-6">
            <p><strong>Dias expiración:</strong> {{$plan->days_expiration}}</p>
            <p><strong>Precio:</strong> {{number_format($plan->price,2)}}</p>
        </div>
    </div>



</div>