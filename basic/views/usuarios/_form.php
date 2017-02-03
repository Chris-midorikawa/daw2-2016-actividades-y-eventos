<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Usuarios;
use app\models\areas;

/*MODELO REGISTRO PARA ADMINS*/
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
    <?= $form->field($model, 'area_id')->dropDownList(areas::getClasesAreas(),(['maxlength' => true])) ?>
    <?= $form->field($model, 'rol')->dropDownList(usuarios::listaroles(),(['maxlength' => true])) ?>
    <?= $form->field($model, 'avisos_por_correo')->checkbox($options = []) ?>
    <?= $form->field($model, 'avisos_agrupados')->checkbox($options = []) ?>
    <?= $form->field($model, 'avisos_marcar_leidos')->textInput() ?>
    <?= $form->field($model, 'avisos_eliminar_borrados')->textInput() ?>
    <?= $form->field($model, 'fecha_registro')->textInput(/*yii::$app->user->identity->fecha_registro*/(['maxlength' => true]),(['readonly'=>true])) ?>
    <?= $form->field($model, 'confirmado')->textInput() ?>
    <?= $form->field($model, 'fecha_acceso')->textInput() ?>
    <?= $form->field($model, 'num_accesos')->textInput() ?>
    <?= $form->field($model, 'bloqueado')->textInput() ?>
    <?= $form->field($model, 'fecha_bloqueo')->textInput() ?>
    <?= $form->field($model, 'notas_bloqueo')->textarea(['rows' => 6]) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear Usuario' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Volver'), ['/usuarios/index'], ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
