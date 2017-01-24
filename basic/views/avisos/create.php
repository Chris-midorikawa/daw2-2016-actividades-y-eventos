<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Avisos */

$this->params['breadcrumbs'][] = ['label' => 'Avisos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="avisos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_crear', [
        'model' => $model,
    ]) ?>

</div>
