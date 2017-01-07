<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuariosAreaModeracionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mantenimiento de Áreas de moderación para Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-area-moderacion-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Nuevo Moderador de Area', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'usuario_id',
            'area_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
