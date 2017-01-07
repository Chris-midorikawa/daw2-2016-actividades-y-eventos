<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ActividadParticipantes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="actividad-participantes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fecha_registro')->textInput() ?>

    <?= $form->field($model, 'actividad_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usuario_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'datos_participacion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fecha_cancelacion')->textInput() ?>

    <?= $form->field($model, 'notas_cancelacion')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
