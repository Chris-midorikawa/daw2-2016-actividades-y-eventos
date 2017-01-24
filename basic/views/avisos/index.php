<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Avisos;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AvisosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Avisos y Notificaciones';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="avisos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
        foreach (Avisos::getClasesAvisos() as $key => $value) {
            echo Html::a($value, ['', 'clase_aviso_id'=>$key], ['class' => 'btn btn-info']); echo ' ';
        }
        ?>        
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => 'Mostrando {begin}-{end} de {totalCount} elementos',
        'columns' => [
             'claseAvisoInstancia', //atributos virtuales
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

    <?= Html::a('Crear Aviso', ['avisos/create', 'id'=>''], ['class' => 'btn btn-success']) ?>

</div>
