<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Clasificaciones;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AvisosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Clasificaciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clasificaciones-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => 'Mostrando {begin}-{end} de {totalCount} elementos',
        'columns' => [
             'id', //atributos virtuales
             'nombre', //atributos virtuales
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

    <?= Html::a('Crear Clasificación', ['clasificaciones/create', 'id'=>''], ['class' => 'btn btn-success']) ?>

</div>
