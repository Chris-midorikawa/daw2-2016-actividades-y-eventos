<?php

use yii\helpers\Html;

use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model app\models\Actividades */

$this->title = 'Actividad: ' . $model->titulo;
?>
<div class="actividades-view">

    <h1><?= Html::encode($this->title) ?></h1>
        
    <?= $this->render('_form', [
        'model' => $model,
		'disabled'=>true,
    ]) ?>

</div>