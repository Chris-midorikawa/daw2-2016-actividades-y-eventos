<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AreasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Áreas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="areas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Continentes', ['', 'clase_area_id'=>1], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Países', ['', 'clase_area_id'=>2], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Regiones', ['', 'clase_area_id'=>4], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Provincias', ['', 'clase_area_id'=>5], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Poblaciones', ['', 'clase_area_id'=>6], ['class' => 'btn btn-info']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'summary' => 'Mostrando {begin}-{end} de {totalCount} elementos',
        'columns' => [
            //['class' => 'yii\grid\SerialColumn',],

            //'id' ,
            //'clase_area_id',
            //'nombre',
            //'area_id',
            ['attribute' => "Nombre Área",
                'content' => function ($model, $key, $index, $column){
                    return $model->nombre;
                }],
            ['attribute' => "Clase Área",
             'content' => function ($model, $key, $index, $column){
                 return \app\models\Areas::find()->where(['id' => $key])->one()->claseAreaInstancia;
             }],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
