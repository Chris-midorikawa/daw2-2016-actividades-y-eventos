<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Etiquetas;
use app\models\EtiquetasQuery;
/* @var $this yii\web\View */
/* @var $model app\models\ActividadEtiquetas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="actividad-etiquetas-form">

    <?php $form = ActiveForm::begin();
    //se cargan todas las etiquetas
	$e=Etiquetas::find()->all();
  $etiquetas= [];
	foreach($e as $modelo){
			$etiquetas[$modelo->id]=$modelo->nombre;
		}
		$model=new Etiquetas();
	?>

     <?= '<td>'.$form->field($model, 'id')->dropDownList($etiquetas).'</td>' ?>

    <div class="form-group">
        <?php echo Html::submitButton('Buscar', ['class' => 'btn btn-primary']);?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
