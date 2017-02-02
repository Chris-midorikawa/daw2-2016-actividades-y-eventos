<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ActividadesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Actividades';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="actividades-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Actividad', ['create'], ['class' => 'btn btn-success']) ?>

        <?= Html::a('Ver Actividades etiquetadas', ["actividadetiquetas/index"], ['class' => 'btn btn-success']) ?>
    </p>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'titulo:ntext',
            'descripcion:ntext',
            'fecha_celebracion',
            'duracion_estimada',
            // 'detalles_celebracion:ntext',
            // 'direccion:ntext',
            // 'como_llegar:ntext',
            // 'notas_lugar:ntext',
            // 'area_id',
            // 'notas:ntext',
            // 'url:ntext',
            // 'imagen_id',
            // 'edad_id',
            // 'publica',
            // 'visible',
            // 'terminada',
            // 'fecha_terminacion',
            // 'notas_terminacion:ntext',
            // 'num_denuncias',
            // 'fecha_denuncia1',
            // 'bloqueada',
            // 'fecha_bloqueo',
            // 'notas_bloqueo:ntext',
            // 'max_participantes',
            // 'min_participantes',
            // 'reserva_participantes',
            // 'formulario_participacion:ntext',
            // 'votosOK',
            // 'votosKO',
            // 'crea_usuario_id',
            // 'crea_fecha',
            // 'modi_usuario_id',
            // 'modi_fecha',
            // 'notas_admin:ntext',

            ['class' => 'yii\grid\ActionColumn', 'template'=>$template],
        ],
    ]); ?>
</div>
