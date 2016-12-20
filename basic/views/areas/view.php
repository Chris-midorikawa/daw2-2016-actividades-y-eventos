<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Areas */

//TÍTULO CON EL NOMBRE DEL ÁREA
$this->title = $model->nombre;

//CREACIÓN DEL BREADCRUMB
$this->params['breadcrumbs'][] = ['label' => 'ÁREAS', 'url' => ['index']];
foreach ($breadcrumb_actual as $tag_model)
{
    $url_enlace = ['areas/view', 'id' => $tag_model->id];
    $this->params['breadcrumbs'][] = ['label' =>$tag_model->nombre, 'url' => $url_enlace];
}
$this->params['breadcrumbs'][] = $model->nombre;

?>
<div class="areas-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'clase_area_id',
            'nombre',
            'area_id',
        ],
    ]) ?>
    <?//NO MOSTRAR GRIDVIEW SI EL ÁREA NO TIENE HIJOS
    if ($dataProvider->totalCount > 0) {?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'clase_area_id',
            'nombre',
            'area_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    }?>

</div>
