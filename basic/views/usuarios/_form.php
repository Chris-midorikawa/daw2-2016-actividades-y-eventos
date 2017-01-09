<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\base\Model;
use yii\data\ActiveDataProvider;
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

    <?= $form->field($model, 'rol')->textInput(['maxlength' => true]) ?>

    
    <div class="form-group">
        <p>Nota: si desea ser admin o patrocinador, contacte con los admines posteriormente </p>
        <?= Html::submitButton($model->isNewRecord ? 'Crear Usuario' : 'Modificar Usuario', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
