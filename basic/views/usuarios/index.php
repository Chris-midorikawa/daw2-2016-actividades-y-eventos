<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuariosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-index">

<?= Html::a(Yii::t('app', 'Volver'), ['/usuarios/portal'], ['class' => 'btn btn-primary']) ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Usuarios', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'email:email',
            'password',
            'nick',
            'nombre',
            'apellidos',
            'fecha_nacimiento',
            // 'direccion:ntext',
            // 'area_id',
            // 'rol',
            // 'avisos_por_correo',
            // 'avisos_agrupados',
            // 'avisos_marcar_leidos',
            // 'avisos_eliminar_borrados',
            // 'fecha_registro',
            // 'confirmado',
            // 'fecha_acceso',
            // 'num_accesos',
            // 'bloqueado',
            // 'fecha_bloqueo',
            // 'notas_bloqueo:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
