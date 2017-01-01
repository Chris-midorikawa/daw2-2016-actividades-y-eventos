<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Areas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="areas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?//= $form->field($model, 'id')->textInput() ?>

    <?//= $form->field($model, 'clase_area_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'area_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
