<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Avisos */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Avisos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="avisos-view">

    <h1><?= Html::encode($this->title) ?></h1>

     <?= $this->render('_form_modificar', [
        'model' => $model,
        'usuarios' => $usuarios,
    ]) ?>

</div>
