<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Avisos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="avisos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'clase_aviso_id')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'fecha')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'origen_usuario_id')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'destino_usuario_id')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'texto')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'actividad_id')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'comentario_id')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'fecha_lectura')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'fecha_borrado')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'fecha_aceptado')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
