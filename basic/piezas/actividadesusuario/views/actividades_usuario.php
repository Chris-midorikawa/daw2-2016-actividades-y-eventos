<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* Variables disponibles:
        $modelo_usuario
*/
?>

<div>

    <h1 class="col-md-12 text-center">ACTIVIDADES PROPIAS</h1>
    <?php 
    //print("<pre>".print_r($modelo_usuario->actividadesPropias,true)."</pre>"); //Si se descomenta se ve el array de objetos actividad
    ?>
    <div class="col-md-12">
    <?php 
    foreach($modelo_usuario->actividadesPropias as $actividad)
    {
    ?>
        <div class="col-md-4">
            <div class="card">
                <div class="card-block">
                    <h2 class="card-title text-center"><?= $actividad->titulo?></h2>
                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>DESCRIPCIÓN: </strong><?php if($actividad->descripcion == "NULL"){echo "No hay";}else{echo $actividad->descripcion;}?></li>
                    <li class="list-group-item"><strong>FECHA:</strong> <?= $actividad->fecha_celebracion?></li>
                    <li class="list-group-item"><strong>DIRECCIÓN:</strong> <?php if($actividad->direccion == "NULL"){echo "No hay";}else{echo $actividad->direccion;}?></li>
                    <li class="list-group-item"><strong>CÓMO LLEGAR:</strong> <?php if($actividad->como_llegar == "NULL"){echo "No hay";}else{echo $actividad->como_llegar;}?></li>
                </ul>

                <div class="card-block">
                <?= Html::a('VER', ['actividades/viewnormal', 'id' => $actividad->id], ['class' => 'btn btn-success']) ?>
                <?= Html::a('MODIFICAR', ['actividades/update', 'id' => $actividad->id], ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
    <?php 
    }
    ?>
    </div>

    <h1 class="col-md-12 text-center">ACTIVIDADES EN SEGUIMIENTO</h1>
    <?php 
    //print("<pre>".print_r($modelo_usuario->actividadesSeguimiento,true)."</pre>");
    ?>
    <div class="col-md-12">
    <?php
    foreach($modelo_usuario->actividadesSeguimiento as $actividad)
    {?>
        <div class="col-md-4">
            <div class="card">
                <div class="card-block">
                    <h2 class="card-title text-center"><?= $actividad->titulo?></h2>
                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>DESCRIPCIÓN: </strong><?= $actividad->descripcion?></li>
                    <li class="list-group-item"><strong>FECHA:</strong> <?= $actividad->fecha_celebracion?></li>
                </ul>

                <div class="card-block">
                <?= Html::a('VER', ['actividades/viewnormal', 'id' => $actividad->id], ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
    <?php 
    }
    ?>
    </div>

     <h1 class="col-md-12 text-center">ACTIVIDADES EN LAS QUE PARTICIPA</h1>
    <?php 
    //print("<pre>".print_r($modelo_usuario->actividadesParticipante,true)."</pre>");
    ?>
    <div class="col-md-12">
    <?php
     foreach($modelo_usuario->actividadesParticipante as $actividad)
    {?>
        <div class="col-md-4">
            <div class="card">
                <div class="card-block">
                    <h2 class="card-title text-center"><?= $actividad->titulo?></h2>
                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>DESCRIPCIÓN: </strong><?= $actividad->descripcion?></li>
                    <li class="list-group-item"><strong>FECHA:</strong> <?= $actividad->fecha_celebracion?></li>
                </ul>

                <div class="card-block">
                <?= Html::a('VER', ['actividades/viewnormal', 'id' => $actividad->id], ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
    <?php 
    }
    ?>
    </div>
</div>