<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

//Vista del portal de un admin

$this->title = 'Portal del admin';
?>
<div class="usuarios-view" >

    <h1><?= Html::encode($this->title) ?></h1><br/><br/><br/><br/>

    <?php  ?>
    <p class="col-md-12 text-center">
        <?= Html::a('Usuarios', ['/usuarios/index',] , ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Configuraciones', ['/configuraciones',] , ['class' => 'btn btn-primary']) ?>
    <?= Html::a(Yii::t('app', 'Actividades'), ['/actividades',], ['class' => 'btn btn-primary']) ?>
     <?= Html::a(Yii::t('app', 'Avisos'), ['/avisos',], ['class' => 'btn btn-primary']) ?>
    <?=  Html::a('Copias de Seguridad', ['/default'] , ['class' => 'btn btn-primary']) ?>
    </p>
     

</div>
