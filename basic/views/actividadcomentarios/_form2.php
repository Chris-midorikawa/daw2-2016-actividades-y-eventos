<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;



/* @var $this yii\web\View */
/* @var $model app\models\ActividadComentarios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="actividad-comentarios-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'actividad_id')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'crea_usuario_id')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'crea_fecha')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'modi_usuario_id')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'modi_fecha')->hiddenInput()->label(false) ?>

	 <?= $form->field($model, 'comentario_id')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'texto')->textarea(['rows' => 6]) ?>

   
    <?= $form->field($model, 'cerrado')->checkbox() ?>

    <?= $form->field($model, 'num_denuncias')->textInput() ?>

    <?= $form->field($model, 'fecha_denuncia1')->hiddenInput()->label(false)?>

    <?= $form->field($model, 'bloqueado')->checkbox() ?>

    <?= $form->field($model, 'fecha_bloqueo')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'notas_bloqueo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
