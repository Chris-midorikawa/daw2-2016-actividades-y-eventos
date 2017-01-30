<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ActividadSeguimientos */

$this->title = 'Crear seguimiento';
$this->params['breadcrumbs'][] = ['label' => 'Actividad Seguimientos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="actividad-seguimientos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'actividades'=>$actividades,
    ]) ?>

</div>
