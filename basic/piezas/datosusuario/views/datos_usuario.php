<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* Variables disponibles:
        $modelo_usuario
*/
?>

<div>
    <?= DetailView::widget([
        'model'=>$modelo_usuario,
        'condensed'=>true,
        'hover'=>true,
        'mode'=>DetailView::MODE_VIEW,
        'panel'=>[
            'heading'=>'Book # ' . $modelo_usuario->id,
            'type'=>DetailView::TYPE_INFO,
        ],
        'attributes'=>[
            'id',
            'nombre',
            ['attribute'=>'fecha_nacimiento', 'type'=>DetailView::INPUT_DATE],
        ]
    ]); ?>
</div>