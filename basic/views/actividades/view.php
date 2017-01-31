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
<?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        
    <?= $this->render('_form', [
        'model' => $model,
		'disabled'=>true,
    ]) ?>

</div>
