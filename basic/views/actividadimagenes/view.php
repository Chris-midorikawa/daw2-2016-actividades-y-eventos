<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ActividadImagenes */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Actividad Imagenes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="actividad-imagenes-view">

    <h1><?= Html::encode($this->title) ?></h1>
	
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'actividad_id',
            'orden',
            'imagen_id',
        ],
    ]) ?>
	<?=Html::img(Yii::$app->request->baseUrl."/images/".$model->imagen_id,['width'=>500,'height'=>500])?>

</div>
