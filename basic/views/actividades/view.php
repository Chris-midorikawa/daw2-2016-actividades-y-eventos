<?php

use yii\helpers\Html;

use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model app\models\Actividades */

$this->title = 'Actividad: ' . $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Actividades', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id];
$this->params['breadcrumbs'][] = 'View';
?>
<div class="actividades-update">

    <h1><?= Html::encode($this->title) ?></h1>
<?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        
    <?= $this->render('_form', [
        'model' => $model,
		'disabled'=>true,
    ]) ?>

    <h3><?= Html::encode("PARTICIPANTES") ?></h3>
     <?= GridView::widget([
         'dataProvider' => $dataProviderParticipantes,
         'columns' => [
             ['attribute' => "Nombre",
                 'content' => function ($model, $key, $index, $column) {
                     return (\app\models\Usuarios::find()->where(["id" => $model->usuario_id])->one()->nombre);
                 }],
         ],
     ]); ?>
     <?= Html::a('Añadir Participante', ['actividad-participantes/add-participante', 'id_actividad' => $model->id], ['class' => 'btn btn-success']) ?>
 
</div>
