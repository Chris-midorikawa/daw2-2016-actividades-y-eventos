<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Areas;
use app\models\Actividades;
use app\models\AreasQuery;

?>

<div class="actividades-form">

    <?php $form = ActiveForm::begin(); 
		$modelosAreas=Areas::find()->all();
		$areas[0]="Sin área";
		foreach($modelosAreas as $modelo){
			$areas[$modelo->id]=$modelo->nombre;
		}
		
		if(Yii::$app->user->isGuest){
			$id=0;
		}else{
			$id=Yii::$app->user->identity->id;
		}
		$model->titulo="Aquí el título";
		$model->duracion_estimada=0;
		$model->imagen_id="";
		$model->num_denuncias=0;
		$model->max_participantes=-1;
		$model->min_participantes=-1;
		$model->votosKO=0;
		$model->votosOK=0;
		$model->crea_usuario_id=$id;
		$model->crea_fecha=date("Y/m/d H:i:s");	
		$model->publica=0;
		$model->visible=0;
		$model->terminada=0;
		$model->fecha_terminacion=null;
		$model->notas_terminacion=null;
		$model->num_denuncias=0;
		$model->fecha_denuncia1=null;
		$model->bloqueada=0;
		$model->fecha_bloqueo=null;
		$model->notas_bloqueo=null;	
	?>

    <?= $form->field($model, 'titulo')->textarea(['rows' => 1]) ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'fecha_celebracion')->textInput() ?>

    <?= $form->field($model, 'duracion_estimada')->textInput() ?>

    <?= $form->field($model, 'detalles_celebracion')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'direccion')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'como_llegar')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'notas_lugar')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'area_id')->dropDownList($areas) ?>

    <?= $form->field($model, 'notas')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'url')->textarea(['rows' => 1]) ?>

    <?= $form->field($model, 'imagen_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'edad_id')->dropDownList(Actividades::edades()) ?>

    <?= $form->field($model, 'publica')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'visible')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'terminada')->hiddenInput()->label(false)  ?>
	<?= $form->field($model, 'fecha_terminacion')->hiddenInput()->label(false)?>
	<?= $form->field($model, 'notas_terminacion')->hiddenInput(['rows' => 6])->label(false) ?>
    <?= $form->field($model, 'num_denuncias')->hiddenInput()->label(false) ?>

    <?=$form->field($model, 'fecha_denuncia1')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'bloqueada')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'fecha_bloqueo')->hiddenInput()->label(false)?>

    <?= $form->field($model, 'notas_bloqueo')->hiddenInput(['rows' => 6])->label(false)?>

    <?= $form->field($model, 'max_participantes')->textInput() ?>

    <?= $form->field($model, 'min_participantes')->textInput() ?>

    <?= $form->field($model, 'reserva_participantes')->checkbox() ?>

    <?= $form->field($model, 'formulario_participacion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'votosOK')->textInput() ?>

    <?= $form->field($model, 'votosKO')->textInput() ?>
		<?= $form->field($model, 'crea_usuario_id')->hiddenInput()->label(false)?>

    <?= $form->field($model, 'crea_fecha')->hiddenInput()->label(false)?>

    <?=$form->field($model, 'modi_usuario_id')->hiddenInput()->label(false)?>

    <?= $form->field($model, 'modi_fecha')->hiddenInput()->label(false)?>

    <?= $form->field($model, 'notas_admin')->textarea(['rows' => 6])?>

    <div class="form-group">
	
        <?php echo Html::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
