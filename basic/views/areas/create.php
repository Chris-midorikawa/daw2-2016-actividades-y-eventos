<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Areas */

if ($nombre_padre=="NUEVO CONTINENTE"){
    $this->title = 'Crear Nuevo Continente';
}else{
    $this->title = 'Crear Área (Derivada de '.$nombre_padre.")";
}
$this->params['breadcrumbs'][] = ['label' => 'Áreas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="areas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_crear', [
        'model' => $model,
    ]) ?>

</div>
