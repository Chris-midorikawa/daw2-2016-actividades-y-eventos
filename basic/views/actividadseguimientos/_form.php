<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ActividadSeguimientos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="actividad-seguimientos-form">

    <?php $form = ActiveForm::begin();?>

    <?= $form->field($model, 'actividad_id')->dropDownList($actividades)->label('Seleccione una actividad a seguir') ?>

    <?= $form->field($model, 'usuario_id')->hiddenInput(['maxlength' => true])->label(false) ?>

    <?= $form->field($model, 'fecha_seguimiento')->hiddenInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
