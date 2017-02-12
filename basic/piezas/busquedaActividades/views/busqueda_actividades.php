<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* Variables disponibles:
        $modelo_usuario
*/
?>

<div>

    
    <div class="col-md-12">
    <?php 
    foreach($modelo_actividades as $actividad)
    {
    ?>
        <div class="col-md-4">
            <div class="card">
                <div class="card-block">
                    <h2 class="card-title text-center"><?= $actividad->titulo?></h2>
                </div>

                <ul class="list-group list-group-flush">
                 
                    <li class="list-group-item"><strong>DESCRIPCIÓN: </strong><?php if($actividad->descripcion == NULL || $actividad->descripcion == 'NULL' ){echo 'No hay';}else{echo $actividad->descripcion;}?></li>
                    <li class="list-group-item"><strong>FECHA:</strong> <?php if($actividad->fecha_celebracion == '0000-00-00 00:00:00'){echo 'No definida';}else{echo $actividad->fecha_celebracion;}?></li>
                    <li class="list-group-item"><strong>DIRECCIÓN:</strong> <?php if($actividad->direccion == NULL || $actividad->direccion == 'NULL'){echo 'No definida';}else{echo $actividad->direccion;}?></li>
                    <li class="list-group-item"><strong>DURACIÓN:</strong> <?php if($actividad->duracion_estimada == NULL || $actividad->duracion_estimada == 'NULL' ){echo "No definida";}else{echo $actividad->duracion_estimada;}?></li>
                    <li class="list-group-item"><strong>CÓMO LLEGAR:</strong> <?php if($actividad->como_llegar == 'NULL' || $actividad->como_llegar == NULL){echo 'No definido';}else{echo $actividad->como_llegar;}?></li>
                    

                </ul>

                
            </div>
        </div>
    <?php 
    }
    ?>
    </div>

</div>
