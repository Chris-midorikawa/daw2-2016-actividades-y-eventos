<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Usuarios;



/* MODELO REGISTRO PARA USUARIOS NORMALES*/


?>

<div class="usuarios-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'nick')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'apellidos')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'fecha_nacimiento')->textInput() ?>
    <?= $form->field($model, 'direccion')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'area_id')->hiddenInput(['value' => 2 ])->label(false);?>
    <?= $form->field($model, 'rol')->dropDownList(usuarios::listaroles(),(['maxlength' => true]))->hiddenInput(['value' => 'N'])->label(false);?>
    <?= $form->field($model, 'avisos_por_correo')->hiddenInput(['value' => 1])->label(false);?>
    <?= $form->field($model, 'avisos_agrupados')->hiddenInput(['value' => 1])->label(false);?>
    <?= $form->field($model, 'avisos_marcar_leidos')->hiddenInput(['value' => 0])->label(false);?>
    <?= $form->field($model, 'avisos_eliminar_borrados')->hiddenInput(['value' => 0])->label(false);?>
    <?= $form->field($model, 'fecha_registro')->hiddenInput(['value' => date("Y-m-d h:i:sa")])->label(false);?>
    <?= $form->field($model, 'confirmado')->hiddenInput(['value' => 0])->label(false);?>
    <?= $form->field($model, 'fecha_acceso')->hiddenInput(['value' => date("Y-m-d h:i:sa")])->label(false);?>
    <?= $form->field($model, 'num_accesos')->hiddenInput(['value' => 1])->label(false);?>
    <?= $form->field($model, 'bloqueado')->hiddenInput(['value' => 0])->label(false);?>
    <?= $form->field($model, 'fecha_bloqueo')->hiddenInput(['value' => ''])->label(false);?>
    <?= $form->field($model, 'notas_bloqueo')->hiddenInput(['value' => ''])->label(false);?>
 <div class="form-group">
         <?= Html::submitButton($model->isNewRecord ? 'Crear Usuario' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Volver'), ['/site/login'], ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
