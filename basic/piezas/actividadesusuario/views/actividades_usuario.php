<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* Variables disponibles:
        $modelo_usuario
*/
?>

<div>

    <h1>ACTIVIDADES PROPIAS</h1>
    <?php 
    //print("<pre>".print_r($modelo_usuario->actividadesPropias,true)."</pre>"); //Si se descomenta se ve el array de objetos actividad

    foreach($modelo_usuario->actividadesPropias as $actividad)
    {?>
        <div class="col-md-4">
            <div class="card">
                <div class="card-block">
                    <h2 class="card-title text-center"><?= $actividad->titulo?></h2>
                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>DESCRIPCIÓN: </strong><?= $actividad->descripcion?></li>
                    <li class="list-group-item"><strong>FECHA:</strong> <?= $actividad->fecha_celebracion?></li>
                    <li class="list-group-item"><strong>DIRECCIÓN:</strong> <?= $actividad->direccion?></li>
                    <li class="list-group-item"><strong>CÓMO LLEGAR:</strong> <?= $actividad->como_llegar?></li>
                </ul>

                <div class="card-block">
                <a href="#" class="card-link pull-left"> VER</a>
                <a href="#" class="card-link pull-right">MODIFICAR </a>
                </div>
            </div>
        </div>
    <?php 
    }
    ?>

    <h1 class="col-md-12">ACTIVIDADES EN SEGUIMIENTO</h1>
    <?php print("<pre>".print_r($modelo_usuario->actividadesSeguimiento,true)."</pre>");?>

     <h1 class="col-md-12">ACTIVIDADES EN LAS QUE PARTICIPA</h1>
    <?php print("<pre>".print_r($modelo_usuario->actividadesParticipante,true)."</pre>");?>
</div>