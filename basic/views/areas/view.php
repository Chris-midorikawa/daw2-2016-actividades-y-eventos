<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Areas */

//TÍTULO CON EL NOMBRE DEL ÁREA
$this->title = $model->nombre;

//CREACIÓN DEL BREADCRUMB
$this->params['breadcrumbs'][] = ['label' => 'Áreas', 'url' => ['index']];
foreach ($breadcrumb_actual as $tag_model) {
    $url_enlace = ['areas/view', 'id' => $tag_model->id];
    $this->params['breadcrumbs'][] = ['label' => $tag_model->nombre, 'url' => $url_enlace];
}
$this->params['breadcrumbs'][] = $model->nombre;

?>
<div class="areas-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <? /*= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) */ ?>
        <? /*= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) */ ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            /*'id',
            'clase_area_id',
            'nombre',
            'area_id',*/
            [
                'label' => 'Id Área',
                'value' => $model->id,
            ],
            [
                'label' => 'Nombre Área',
                'value' => $model->nombre,
            ],
            [
                'label' => 'Clase Área',
                'value' => $model->claseAreaInstancia,
            ],
        ],
    ]) ?>
    <? //NO MOSTRAR GRIDVIEW SI EL ÁREA NO TIENE HIJOS
    if ($dataProvider->totalCount > 0) { ?>
        <br>
        <h3><?= Html::encode("ÁREAS DERIVADAS") ?></h3>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            //'summary' => '',
            'columns' => [
                //['class' => 'yii\grid\SerialColumn',],

                //'id' ,
                //'clase_area_id',
                //'nombre',
                //'area_id',
                ['attribute' => "Nombre Área",
                    'content' => function ($model, $key, $index, $column) {
                        return $model->nombre;
                    }],
                ['attribute' => "Clase Área",
                    'content' => function ($model, $key, $index, $column) {
                        return \app\models\Areas::find()->where(['id' => $key])->one()->claseAreaInstancia;
                    }],
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);?>
    <? } ?>
    <?= Html::a('Añadir Área', ['areas/create', 'id_padre' => $model->id, 'clase_area_padre' => $model->clase_area_id], ['class' => 'btn btn-success']) ?>
    <br>
    <br>
    <br>
    <h3><?= Html::encode("MODERADORES") ?></h3>
    <?= GridView::widget([
        'dataProvider' => $dataProviderModeradores,
        'columns' => [
            ['attribute' => "Nombre Moderador",
                'content' => function ($model, $key, $index, $column) {
                    return (\app\models\Usuarios::find()->where(["id" => $model->usuario_id])->one()->nombre);
                }],
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
                'buttons' => [
                    'delete' => function ($url, $model, $key) {

                        return Html::a(
                            '<span class="glyphicon glyphicon-trash"></span>',
                            ['usuarios-area-moderacion/delete', 'id' => $model->id, 'id_area' => \app\models\Areas::find()->where(["id" => $model->area_id])->one()->id],
                            ['data' => ['confirm' => "¿Seguro que quieres eliminar este moderador?", 'method' => "post"]]
                        );
                    },
                ],
            ],
        ],
    ]); ?>
    <?= Html::a('Añadir Moderador', ['usuarios-area-moderacion/add-moderador', 'id_area' => $model->id], ['class' => 'btn btn-success']) ?>
</div>
