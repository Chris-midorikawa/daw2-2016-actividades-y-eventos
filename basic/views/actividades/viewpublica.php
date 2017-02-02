<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Actividades */

$this->title = 'Actividad: ' . $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Actividades', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id];
$this->params['breadcrumbs'][] = 'View';
?>
<div class="actividades-update">

    <h1><?= Html::encode($this->title) ?></h1>
<?= Html::a('Denunciar', ['denunciar', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
&nbsp
<?= Html::a('Votar OK', ['votarok', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
&nbsp
<?= Html::a('Votar KO', ['votarko', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>        
    <?= $this->render('_formviewpublica', [
        'model' => $model,
		'imagenes'=>$imagenes,
		'comentarios'=>$comentarios,
    ]) ?>
	<?= Html::a('Comentar', ['actividadcomentarios/create', 'actividad_id' => $model->id], ['class' => 'btn btn-primary']) ?> 

</div>
