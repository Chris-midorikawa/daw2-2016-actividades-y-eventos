<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\helpers\Url;

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
            'heading'=>'MIS DATOS',
            'type'=>DetailView::TYPE_INFO,
        ],
        'attributes'=> [
            //'id',
            ['attribute'=>'id', 'visible'=>false],
            'email',
            ['attribute'=>'password', 'type'=>DetailView::INPUT_TEXT, 'value'=>'****'],
            'nick',
            'nombre',
            'apellidos',
            ['attribute'=>'fecha_nacimiento', 'type'=>DetailView::INPUT_DATE],
            'direccion',
            'area_id',
            ['attribute'=>'rol'],
            ['attribute'=>'fecha_registro', 'type'=>DetailView::INPUT_DATETIME],
            [
                'attribute'=>'confirmado',
                'label'=>'Confirmado?',
                'format'=>'raw',
                'value'=>(($modelo_usuario->confirmado)!="0") ? '<span class="label label-success">Sí</span>' : '<span class="label label-danger">No</span>',
                'type'=>DetailView::INPUT_SWITCH,
                'widgetOptions' => [
                    'pluginOptions' => [
                        'onText' => 'Sí',
                        'offText' => 'No',
                    ]
                ],
                'valueColOptions'=>['style'=>'width:30%']
            ],
            ['attribute'=>'fecha_acceso', 'visible'=>false],
            ['attribute'=>'num_accesos', 'visible'=>false],
            ['attribute'=>'bloqueado', 'visible'=>false],
            ['attribute'=>'fecha_bloqueo', 'visible'=>false],
            ['attribute'=>'notas_bloqueo', 'visible'=>false],
        ],
        'formOptions' => [
                'action' => Url::to(['usuarios/update-datos-perfil', 'id' => $modelo_usuario->id]),
        ],

    ]);
    ?>
</div>