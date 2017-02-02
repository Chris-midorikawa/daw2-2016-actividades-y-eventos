<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ActividadImagenes */
//actualiar llama a la vista de formulario

$this->title = 'Modificar  Imagen: ';
$this->params['breadcrumbs'][] = ['label' => 'Actividad Imagenes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="actividad-imagenes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'actividades' => $actividades,
    ]) ?>

</div>
