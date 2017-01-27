<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

//Vista del portal de un usuario normal

$this->title = 'Mi perfil';
?>
<div class="usuarios-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php //los botones de momento no enlazan ?>
    <p> 
        <?= Html::a('Mis datos', ['view',] /* 'id' => Yii::$app->user->identity->id] */, ['class' => 'btn btn-primary']) ?>
    </p>
    <p>
        <?= Html::a('Avisos y notificaciones', ['notificaciones',/* 'id' => Yii::$app->user->identity->id */] , ['class' => 'btn btn-primary']) ?>
    </p>
    <p>
        <?= Html::a('Mis actividades', ['actividad-participantes',/* 'id' => Yii::$app->user->identity->id */] , ['class' => 'btn btn-primary']) ?>
    </p>
     <p>
        <?= Html::a('Mis avisos', ['avisos',/* 'id' => Yii::$app->user->identity->id */] , ['class' => 'btn btn-primary']) ?>
    </p>
     <p>
        <?= Html::a('Mis comentarios', ['actividad-participantes',/* 'id' => Yii::$app->user->identity->id */] , ['class' => 'btn btn-primary']) ?>
    </p>
     <p>
        <?= Html::a('Mis imagenes', ['actividadimagenes',/* 'id' => Yii::$app->user->identity->id */] , ['class' => 'btn btn-primary']) ?>
    </p>

</div>
