<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ActividadParticipantesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="actividad-participantes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'fecha_registro') ?>

    <?= $form->field($model, 'actividad_id') ?>

    <?= $form->field($model, 'usuario_id') ?>

    <?= $form->field($model, 'datos_participacion') ?>

    <?php // echo $form->field($model, 'fecha_cancelacion') ?>

    <?php // echo $form->field($model, 'notas_cancelacion') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
