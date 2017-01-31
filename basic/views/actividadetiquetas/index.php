<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ActividadEtiquetasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Actividades etiquetadas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="actividad-etiquetas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Etiquetar Actividad', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
	<table>
   <?php foreach($lista as $modelo){
	   echo '<tr>'.$this->render('view', ['model' => $modelo,'disabled'=>'true', ]).'</tr>';
   }/*= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'actividad_id',
            'etiqueta_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); */?>
	</table>
</div>
