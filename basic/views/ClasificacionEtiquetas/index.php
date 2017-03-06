<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ClasificacionEtiquetasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Clasificacion Etiquetas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clasificacion-etiquetas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Clasificacion Etiquetas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'clasificacion_id',
            'etiqueta_id',
            'clasificacion_etiqueta_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
