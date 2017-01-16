<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Clientes */

$this->title = $model->referencia;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Clientes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clientes-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->referencia], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->referencia], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Estas seguro que quieres eliminarlo?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'referencia',
            'cifnif',
            'nombre',
            'apellidos',
            'domFiscal',
            'domEnvio',
            'rol',
            'notas:ntext',
            'email:email',
            'password',
        ],
    ]) ?>

</div>
