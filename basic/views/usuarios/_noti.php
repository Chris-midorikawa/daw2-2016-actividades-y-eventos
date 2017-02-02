<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Usuarios;



//formulario de notificaciones


?>

<div class="usuarios-form">

    <?php $form = ActiveForm::begin(); ?>
    
   <?= $form->field($model, 'avisos_por_correo')->checkbox($options = []) ?>
    <?= $form->field($model, 'avisos_agrupados')->checkbox($options = []) ?>
    <?= $form->field($model, 'avisos_marcar_leidos')->textInput() ?>
    <?= $form->field($model, 'avisos_eliminar_borrados')->textInput() ?>
    
 <div class="form-group">
         <?= Html::submitButton('Modificar Configuracion', ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Volver'), ['/usuarios/portal'], ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>