<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\usuarios;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */
/* @var $form yii\widgets\ActiveForm */
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

    <?= $form->field($model, 'area_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rol')->dropDownList(usuarios::listaroles(),(['maxlength' => true]) ?>

    <?= $form->field($model, 'avisos_por_correo')->checkbox($aviso_correo, $checked = true, $options = []) ?>

    <?= $form->field($model, 'avisos_agrupados')->checkbox($aviso_agrupado, $checked = false, $options = []) ?>

    <?= $form->field($model, 'avisos_marcar_leidos')->checkbox($aviso_marcar_leidos, $checked = false, $options = []) ?>

    <?= $form->field($model, 'avisos_eliminar_borrados')->checkbox($aviso_eliminar_borrados, $checked = false, $options = []) ?>
<?= /*solo moderadores , admin... controlar permisos*/ ?>
    <?= $form->field($model, 'fecha_registro')->textInput() ?>

    <?= $form->field($model, 'confirmado')->textInput() ?>

    <?= $form->field($model, 'fecha_acceso')->textInput() ?>

    <?= $form->field($model, 'num_accesos')->textInput() ?>

    <?= $form->field($model, 'bloqueado')->textInput() ?>

    <?= $form->field($model, 'fecha_bloqueo')->textInput() ?>

    <?= $form->field($model, 'notas_bloqueo')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
