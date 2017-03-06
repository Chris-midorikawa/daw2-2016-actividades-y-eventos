<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ClasificacionEtiquetasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="clasificacion-etiquetas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'clasificacion_id') ?>

    <?= $form->field($model, 'etiqueta_id') ?>

    <?= $form->field($model, 'clasificacion_etiqueta_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
