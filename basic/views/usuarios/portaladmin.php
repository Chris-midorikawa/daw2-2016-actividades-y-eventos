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
        <?= Html::a('Usuarios', ['/usuarios/index',] , ['class' => 'btn btn-primary']) ?>
    </p>
    <p>
        <?= Html::a('Configuraciones', ['/configuraciones',] , ['class' => 'btn btn-primary']) ?>
    </p>
    <p>
        <?= Html::a(Yii::t('app', 'Actividades'), ['/actividades',], ['class' => 'btn btn-primary']) ?>
    </p>
     <p>
         <?= Html::a(Yii::t('app', 'Avisos'), ['/avisos',], ['class' => 'btn btn-primary']) ?>
    </p>
     <p>
   
        <?=  Html::a('Copias de Seguridad', ['/copias'] , ['class' => 'btn btn-primary']) ?>
    </p>
     

</div>
