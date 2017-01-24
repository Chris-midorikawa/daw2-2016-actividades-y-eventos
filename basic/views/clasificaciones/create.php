<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Clasficaciones */

$this->params['breadcrumbs'][] = ['label' => 'Clasificaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clasificaciones-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_crear', [
        'model' => $model,
    ]) ?>

</div>
