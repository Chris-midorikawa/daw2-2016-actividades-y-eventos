<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Areas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="areas-form">

    <?php $form = ActiveForm::begin(); ?>

        <!-- Dropdown de tipos de áreas (Para crear áreas derivadas)-->
        <? if (($model->clase_area_id)!=1) {
            echo($form->field($model, 'clase_area_id')
                ->dropDownList($tipos_area)
                ->label("Elija un tipo de área:"));
        } else {
            echo($form->field($model, 'clase_area_id')->hiddenInput(['maxlength' => true, 'value' =>$model->clase_area_id])
                ->label(""));
        }
        ?>
        <!-- Nombre del nuevo área-->
        <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
        <!-- Id del Área padre-->
        <? if (($model->clase_area_id)==1) {
            echo($form->field($model, 'area_id')->hiddenInput(['maxlength' => true, 'value' =>$model->area_id])->label(""));
        } else {
            echo($form->field($model, 'area_id')->hiddenInput(['maxlength' => true, 'value' =>$model->area_id])
                ->label(""));
        } ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
