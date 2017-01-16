<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ActividadImagenes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="actividad-imagenes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'actividad_id')->dropDownList($actividades) ?>

    <?= $form->field($model, 'orden')->textInput() ?>

    <?= $form->field($model, 'imagen_id')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
