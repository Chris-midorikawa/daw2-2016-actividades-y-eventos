<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Avisos;
use app\models\Usuarios;

/* @var $this yii\web\View */
/* @var $model app\models\Avisos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="avisos-form">

    <?php $form = ActiveForm::begin(); ?>
 
    <?= $form->field($model, 'clase_aviso_id')->dropDownList(Avisos::getClasesAvisos(),['disabled'=>true])->label("Tipo de aviso") ?>

    <?= $form->field($model, 'fecha')->textInput(['disabled'=>true])->label("Enviado:") ?>

    <?= $form->field($model, 'origen_usuario_id')->hiddenInput(['disabled'=>true])->label("de: ".Usuarios::findOne($model->origen_usuario_id)->nick) ?>

    <?= $form->field($model, 'destino_usuario_id')->hiddenInput(['disabled'=>true])->label("Para: ".Yii::$app->user->identity->nick) ?>

    <?= $form->field($model, 'texto')->textInput(['maxlength' => true, 'disabled'=>true]) ?>

    <?= $form->field($model, 'actividad_id')->hiddenInput(['maxlength' => true])->label(false) ?>

    <?= $form->field($model, 'comentario_id')->hiddenInput(['maxlength' => true])->label(false) ?>

    <?= $form->field($model, 'fecha_lectura')->textInput(['maxlength' => true, 'disabled' => true])->label(false) ?>
    <?= "Marcar como no leido ".Html::checkbox("noleido", false) ?>

    <?php
        //se filtra la aceptacion de del aviso (solo si es admin o moderador)
        if((Yii::$app->user->identity->rol=='A' or Yii::$app->user->identity->rol=='M') and $model->fecha_aceptado == null)
        {
            echo $form->field($model, 'fecha_aceptado')->hiddenInput(['maxlength' => true])->label(false);
            echo "Aceptar ".Html::checkbox("aceptado", false);
        }
        //aparecera la opcion de borrado
        else
        {
            //echo $form->field($model, 'fecha_borrado')->textInput(['maxlength' => true])->label("Fecha de borrado");
            echo "Borrar ".Html::checkbox("borrar", false) ;
        }
    ?>

    <?= $form->field($model, 'fecha_borrado')->hiddenInput(['maxlength' => true, 'disabled' => true])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Enviar' : 'Guardar cambios', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
