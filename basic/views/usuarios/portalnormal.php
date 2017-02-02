<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

//Vista del portal de un usuario normal

$this->title = 'Mi portal';
?>
<div class="usuarios-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php //los botones de momento no enlazan ?>
    <p> 
        <?= Html::a('Mis datos', ['view', 'id' => Yii::$app->user->identity->id] , ['class' => 'btn btn-primary']) ?>
    </p>
    <p>
         <?= Html::a(Yii::t('app', 'Notificaciones'), ['/usuarios/notificaciones'], ['class' => 'btn btn-primary']) ?>
    </p>
    <p>
            <?= Html::a(Yii::t('app', 'Mis actividades'), ['/actividades',], ['class' => 'btn btn-primary']) ?>
    </p>
     <p>
        <?= Html::a(Yii::t('app', 'Avisos'), ['/avisos',], ['class' => 'btn btn-primary']) ?>
    </p>
     <p>
        <?= Html::a(Yii::t('app', 'Mis comentarios'), ['/actividadcomentarios',], ['class' => 'btn btn-primary']) ?>
    </p>
     <p>
        <?= Html::a(Yii::t('app', 'Mis imagenes'), ['/actividadimagenes',], ['class' => 'btn btn-primary']) ?>
    </p>

</div>
