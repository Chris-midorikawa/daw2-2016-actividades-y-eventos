<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Areas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuarios-area-moderacion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($modelo_usuario_area, 'id')->textInput(['value'=>$modelo_usuario_area->id])->label("Id usuario-área:") ?>
    <?= $form->field($modelo_usuario_area, 'usuario_id')->dropDownList($usuarios)->label("Elija un usuario:") ?>

    <div class="form-group">
        <?= Html::submitButton('Añadir Moderador', ['class' =>  'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
