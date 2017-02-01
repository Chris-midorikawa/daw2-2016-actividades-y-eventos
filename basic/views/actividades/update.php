<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Actividades */

$this->title = 'Editar Actividad: ' . $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Actividades', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="actividades-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= ($rol=='A') ? $this->render('_formupdateadmin', ['model' => $model,	'rol'=>$rol,]) : $this->render('_formupdate', ['model' => $model,	'rol'=>$rol,])?>

</div>
