<?php
use app\models\Actividades;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Areas;
use app\models\AreasQuery;

?>

<div class="actividades-form">

    <?php $form = ActiveForm::begin(); 
		$modelosAreas=Areas::find()->all();
		$areas[0]="Sin área";
		foreach($modelosAreas as $modelo){
			$areas[$modelo->id]=$modelo->nombre;
		}
		$disabled=true;
		
		
		
			
	?>

    <?= '<h2>'.$form->field($model, 'titulo')->textarea(['rows' => 1, 'disabled'=>$disabled]).'</h2>' ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 2, 'disabled'=>$disabled]) ?>

    <?= $form->field($model, 'fecha_celebracion')->textInput(['disabled'=>$disabled]) ?>

    <?= $form->field($model, 'duracion_estimada')->textInput(['disabled'=>$disabled]) ?>

    <?= $form->field($model, 'detalles_celebracion')->textarea(['rows' => 2, 'disabled'=>$disabled]) ?>

    <?= $form->field($model, 'direccion')->textarea(['rows' => 3,'disabled'=>$disabled]) ?>

    <?= $form->field($model, 'como_llegar')->textarea(['rows' => 6, 'disabled'=>$disabled]) ?>

    
    <?= $form->field($model, 'area_id')->dropDownList($areas,['disabled'=>$disabled]) ?>

    
    <?= $form->field($model, 'url')->textarea(['rows' => 1,'disabled'=>$disabled]) ?>
	<?=Html::img(Yii::$app->request->baseUrl."/images/".$model->imagen_id,['width'=>500,'height'=>500])?>
	
    <?= $form->field($model, 'edad_id')->dropDownList(Actividades::edades(),['disabled'=>$disabled]) ?>

    
    <?= $form->field($model, 'terminada')->dropDownList(Actividades::terminada(),['disabled'=>$disabled])  ?>
	<?= $form->field($model, 'fecha_terminacion')->textInput(['disabled'=>$disabled])?>
	  <?= $form->field($model, 'num_denuncias')->textInput(['disabled'=>$disabled]) ?>
	
   
   <?= $form->field($model, 'votosOK')->textInput(['disabled'=>$disabled]) ?>

    <?= $form->field($model, 'votosKO')->textInput(['disabled'=>$disabled]) ?>
	
			

   

    <?php ActiveForm::end(); ?>

</div>
