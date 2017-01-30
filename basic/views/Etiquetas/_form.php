<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Etiquetas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="etiquetas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
	 <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
	<?php if($todas){
		echo "Si desea unificar otra etiqueta con ésta, haga click en la deseada<p>";
		foreach($todas as $id => $nombre){
			 echo '<A HREF='.Yii::$app->request->baseURL.'/etiquetas/unifica?id='.$model->id,'&iduni='.$id.'>'.$nombre.'</a><p>';
	}}	?>

   

    <?php ActiveForm::end(); ?>

</div>
