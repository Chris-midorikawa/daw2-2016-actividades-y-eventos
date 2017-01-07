<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ActividadParticipantes */

$this->title = 'Mantenimiento de Participantes en Actividades';
$this->params['breadcrumbs'][] = ['label' => 'Actividad Participantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="actividad-participantes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
