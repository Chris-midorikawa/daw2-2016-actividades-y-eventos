<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Usuarios;



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
   <?= $form->field($model, 'avisos_por_correo')->checkbox($options = []) ?>

    <?= $form->field($model, 'avisos_agrupados')->checkbox($options = []) ?>

    <?= $form->field($model, 'avisos_marcar_leidos')->textInput() ?>

    <?= $form->field($model, 'avisos_eliminar_borrados')->textInput() ?>
 <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear Usuario' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Volver'), ['/site/login'], ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
