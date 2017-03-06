<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ClasificacionEtiquetas */

$this->title = 'Update Clasificacion Etiquetas: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Clasificacion Etiquetas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="clasificacion-etiquetas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
