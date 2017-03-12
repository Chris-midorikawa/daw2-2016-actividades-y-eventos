<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ClasificacionEtiquetas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="clasificacion-etiquetas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'clasificacion_id')->hiddenInput(['maxlength' => true])->label("Clasificación: ".$nombreClasificacion) ?>

    <?= $form->field($model, 'etiqueta_id')->dropDownList($etiquetas) ?>

    <?= $form->field($model, 'clasificacion_etiqueta_id')->hiddenInput(['maxlength' => true])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
