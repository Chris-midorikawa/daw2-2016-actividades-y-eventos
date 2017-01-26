<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

//formulario para variables de configuracion
?>

<div class="configuraciones-form">

    <?php $form = ActiveForm::begin(); ?>


    <?php //el nombre la variable no se podrá modificar. Para ello se pone el readonly ?>
    	<?= $form->field($model, 'variable')->textInput(['maxlength' => true, 'readOnly'=>true]) ?>

    <?= $form->field($model, 'valor')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Actualizar variable', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
