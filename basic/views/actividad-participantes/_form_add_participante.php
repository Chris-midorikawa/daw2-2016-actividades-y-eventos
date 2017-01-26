<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Areas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="actividad-participantes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($modeloParticipante, 'usuario_id')->dropDownList($listaUsuarios)->label("Elija un usuario:") ?>

    <div class="form-group">
        <?= Html::submitButton('Añadir Participante', ['class' =>  'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
