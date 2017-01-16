<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\ActividadEtiquetas;
use app\models\ActividadEtiquetasSearch;
use app\models\Etiquetas;
use app\models\EtiquetasQuery;
use app\models\Actividades;
use app\models\ActividadesQuery;
/* @var $this yii\web\View */
/* @var $model app\models\ActividadEtiquetas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="actividad-etiquetas-form">

    <?php $form = ActiveForm::begin();
	$modelosEtiquetas=Etiquetas::find()->all();
	foreach($modelosEtiquetas as $modelo){
			$etiquetas[$modelo->id]=$modelo->nombre;
		}
		$modelosActividades=Actividades::find()->all();
	foreach($modelosActividades as $modelo){
			$actividades[$modelo->id]=$modelo->titulo;
		}
		if(isset($disabled)){
			$disabled=true;
		}else{
			$disabled=false;
		}
	?>

    <?= $form->field($model, 'actividad_id')->dropDownList($actividades,['disabled'=>$disabled]) ?>

    <?= $form->field($model, 'etiqueta_id')->dropDownList($etiquetas,['disabled'=>$disabled]) ?>

    <div class="form-group">
        <?php if(!$disabled)echo Html::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
