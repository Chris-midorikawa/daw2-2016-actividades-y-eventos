<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

//Vista del portal de un admin

$this->title = 'Portal del admin';
?>
<div class="usuarios-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php //los botones de momento no enlazan ?>
    <p> 
        <?= Html::a('Usuarios', ['view',] /* 'id' => Yii::$app->user->identity->id] */, ['class' => 'btn btn-primary']) ?>
    </p>
    <p>
        <?= Html::a('Configuraciones', ['notificaciones',/* 'id' => Yii::$app->user->identity->id */] , ['class' => 'btn btn-primary']) ?>
    </p>
    <p>
        <?= Html::a('Actividades', ['actividad-participantes',/* 'id' => Yii::$app->user->identity->id */] , ['class' => 'btn btn-primary']) ?>
    </p>
     <p>
        <?= Html::a('Avisos', ['avisos',/* 'id' => Yii::$app->user->identity->id */] , ['class' => 'btn btn-primary']) ?>
    </p>
     <p>
        <?= Html::a('Copias de Seguridad', ['actividad-participantes',/* 'id' => Yii::$app->user->identity->id */] , ['class' => 'btn btn-primary']) ?>
    </p>
     

</div>
