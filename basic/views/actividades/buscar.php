<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EtiquetasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Búsqueda';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="etiquetas-index">

    <h1><?= Html::encode($this->title) ?></h1>
   
    <?php if(count($resultado)==0) {
			echo $this->render('_search',['model'=>$modelo]);
	}else{
			foreach($resultado as $model){
				echo $this->render('_detalleresumido',['model'=>$model]);
			}
			
	}?>
</div>
                                                                                      