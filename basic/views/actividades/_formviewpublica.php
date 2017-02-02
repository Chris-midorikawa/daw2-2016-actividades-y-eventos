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

    <?= $form->field($model, 'titulo')->textarea(['rows' => 1, 'disabled'=>$disabled]) ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 2, 'disabled'=>$disabled]) ?>

    <?= $form->field($model, 'fecha_celebracion')->textInput(['disabled'=>$disabled]) ?>

    <?= $form->field($model, 'duracion_estimada')->textInput(['disabled'=>$disabled]) ?>

    <?= $form->field($model, 'detalles_celebracion')->textarea(['rows' => 2, 'disabled'=>$disabled]) ?>

    <?= $form->field($model, 'direccion')->textarea(['rows' => 3,'disabled'=>$disabled]) ?>

    <?= $form->field($model, 'como_llegar')->textarea(['rows' => 6, 'disabled'=>$disabled]) ?>

    <?= $form->field($model, 'notas_lugar')->textarea(['rows' => 6, 'disabled'=>$disabled]) ?>

    <?= $form->field($model, 'area_id')->dropDownList($areas,['disabled'=>$disabled]) ?>

    <?= $form->field($model, 'notas')->textarea(['rows' => 6,'disabled'=>$disabled]) ?>

    <?= $form->field($model, 'url')->textarea(['rows' => 1,'disabled'=>$disabled]) ?>
	<?=Html::img(Yii::$app->request->baseUrl."/images/".$model->imagen_id,['width'=>800,'height'=>800])?>
	<?php foreach($imagenes as $i){
		echo '<p>'.Html::img(Yii::$app->request->baseUrl."/images/".$i->imagen_id).'</p>';
	}
   ?>
    <?= $form->field($model, 'edad_id')->dropDownList(Actividades::edades(),['disabled'=>$disabled]) ?>

    
    <?= $form->field($model, 'terminada')->dropDownList(Actividades::terminada(),['disabled'=>$disabled])  ?>
	<?= $form->field($model, 'fecha_terminacion')->textInput(['disabled'=>$disabled])?>
		<?= $form->field($model, 'notas_terminacion')->textarea(['rows' => 6,'disabled'=>$disabled]) ?>
    <?= $form->field($model, 'num_denuncias')->textInput(['disabled'=>$disabled]) ?>
	
   
    <?= $form->field($model, 'max_participantes')->textInput(['disabled'=>$disabled]) ?>

    <?= $form->field($model, 'min_participantes')->textInput(['disabled'=>$disabled]) ?>

    <?= $form->field($model, 'reserva_participantes')->checkbox(['disabled'=>$disabled]) ?>

    <?= $form->field($model, 'formulario_participacion')->textarea(['rows' => 6, 'disabled'=>$disabled]) ?>

    <?= $form->field($model, 'votosOK')->textInput(['disabled'=>$disabled]) ?>

    <?= $form->field($model, 'votosKO')->textInput(['disabled'=>$disabled]) ?>
	<h1>Comentarios</h1>
	<?php foreach($comentarios as $c){
		if(!$c->cerrado && !$c->bloqueado){
		echo $form->field($c, 'crea_usuario_id')->textInput(['disabled'=>$disabled]);
		echo $form->field($c, 'crea_fecha')->textInput(['disabled'=>$disabled]);  
		echo $form->field($c, 'texto')->textarea(['rows' => 6,'disabled'=>$disabled]);
		echo $form->field($c, 'num_denuncias')->textInput(['disabled'=>$disabled]);
		echo Html::a('denunciar', ['denunciacomentario', 'comentario_id' => $c->id,'id'=>$model->id], ['class' => 'btn btn-primary']);
		}
	}?>
			

   

    <?php ActiveForm::end(); ?>

</div>
