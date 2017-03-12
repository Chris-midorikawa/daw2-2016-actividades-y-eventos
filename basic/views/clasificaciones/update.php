<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Avisos */

//TÍTULO CON EL NOMBRE DE LA CLASIFICACIÓN
$this->title = 'MODIFICAR CLASIFICACIÓN: '.$model->nombre;

//CREACIÓN DEL BREADCRUMB
$this->params['breadcrumbs'][] = ['label' => 'Clasificaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->nombre;
?>

<div class="clasificaciones-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_modificar', [
        'model' => $model,
    ]) ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'clasificacion_id',
            'etiqueta_id',
            //'clasificacion_etiqueta_id',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{delete}'],
        ],
    ]); ?>

    <?= Html::a('Añadir etiqueta a la clasificación', ['createrelacion' , 'id' => $model->id], ['class' => 'btn btn-success']) ?>

</div>
