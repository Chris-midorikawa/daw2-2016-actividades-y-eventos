<?php

use yii\helpers\Html;

//vista para actualizar variable de configuracion

$this->title = 'Actualizar Variable: ' . $model->variable;
$this->params['breadcrumbs'][] = ['label' => 'Configuraciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->variable, 'url' => ['view', 'id' => $model->variable]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="configuraciones-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
