<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;



//vista de busqueda de variable
?>

<div class="configuraciones-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'variable') ?>

    <?= $form->field($model, 'valor') ?>

    <div class="form-group">
        <?= Html::submitButton('Buscar variable', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reiniciar búsqueda', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
