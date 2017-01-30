<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Etiquetas */

$this->title = 'Modificar Etiqueta: ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Etiquetas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombre, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="etiquetas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'todas' => $todas
    ]) ?>

</div>
