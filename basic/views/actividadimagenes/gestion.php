<?php

namespace app\controllers;
use Yii;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ActividadImagenesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Imágenes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="actividad-imagenes-index">
	
    <h1><?= Html::encode($this->title) ?></h1>
	
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
	<?= Html::img(Yii::$app->request->baseUrl."/images/surf.jpg") ?>
    <p>
        <?= Html::a('Añadir Imagen', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
	
            'actividad_id',
			'orden',
            'imagen_id',


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
