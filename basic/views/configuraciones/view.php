<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

//vista para ver una variable de configuración

$this->title = 'Variable: ' . $model->variable;
$this->params['breadcrumbs'][] = ['label' => 'Configuraciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="configuraciones-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar Variable', ['update', 'id' => $model->variable], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Volver al menú', ['index'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'variable',
            'valor:ntext',
        ],
    ]) ?>

</div>
