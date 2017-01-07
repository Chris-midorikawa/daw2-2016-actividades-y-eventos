<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ActividadParticipantesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mantenimiento de Participantes en Actividades';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="actividad-participantes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Actividad Participantes', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'fecha_registro',
            'actividad_id',
            'usuario_id',
            'datos_participacion:ntext',
            // 'fecha_cancelacion',
            // 'notas_cancelacion:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
