<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EtiquetasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//vista detallada de una etieueta si llegan datos
//sino no llegan datos llama a formulario de busqueda

$this->title = 'Búsqueda por etiqueta';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="etiquetas-index">

    <h1><?= Html::encode($this->title) ?></h1>
   
    <?php if($datos==null) {
			echo $this->render('_formbuscar');
	}else{
			foreach($datos as $model){
				echo $this->render('_detalleresumido',['model'=>$model]);
			}
			echo count($datos);
	}?>
</div>
                                                                                      