<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Avisos;


/* @var $this yii\web\View */
/* @var $model app\models\Avisos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="avisos-form">

    <?php $form = ActiveForm::begin(); ?>

 
    <?= $form->field($model, 'clase_aviso_id')->dropDownList(Avisos::getClasesAvisos())->label("Tipo de aviso") ?>

    <?= $form->field($model, 'fecha')->hiddenInput(['value'=>0])->label(false) ?>

    <?= $form->field($model, 'origen_usuario_id')->hiddenInput(['value'=>0])->label(false) ?>

    <?= $form->field($model, 'destino_usuario_id')->dropDownList($usuarios) ?>

    <?= $form->field($model, 'texto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'actividad_id')->hiddenInput(['maxlength' => true])->label(false) ?>

    <?= $form->field($model, 'comentario_id')->hiddenInput(['maxlength' => true])->label(false) ?>

    <?= $form->field($model, 'fecha_lectura')->hiddenInput(['maxlength' => true])->label(false) ?>

    <?= $form->field($model, 'fecha_borrado')->hiddenInput(['maxlength' => true])->label(false) ?>

    <?= $form->field($model, 'fecha_aceptado')->hiddenInput(['maxlength' => true])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
