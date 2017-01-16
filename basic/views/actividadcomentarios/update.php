<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ActividadComentarios */

$this->title = 'Modificar Comentario: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Actividad Comentarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="actividad-comentarios-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form2', [
        'model' => $model,
    ]) ?>

</div>
