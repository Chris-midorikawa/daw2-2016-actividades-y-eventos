<?php

use yii\helpers\Html;
//use kartik\detail\DetailView;
use yii\widgets\DetailView;
use app\models\UsuarioAvisos;

/* Variables disponibles:
        $modelo_usuario
*/
?>

<div>
    <h1>AVISOS RECIBIDOS</h1>
    <? $modelo_avisos_recibidos = UsuarioAvisos::find()->where(['id' => $modelo_usuario->avisosRecibidos[0]->id])->one()?>
    <?= DetailView::widget(['model' => $modelo_avisos_recibidos,
        'attributes' => [
            'texto',
    ]
        ]);
    ?>
    <div class="alert alert-info">
        <strong>Aviso de <?= $modelo_usuario->avisosRecibidos[0]->origen_usuario_id?></strong> <?= $modelo_usuario->avisosRecibidos[0]->texto?>
    </div>
    <h1>AVISOS ENVIADOS</h1>
    <? $modelo_avisos_enviados = UsuarioAvisos::find()->where(['id' => $modelo_usuario->avisosEnviados[0]->id])->one()?>
    <?= DetailView::widget(['model' => $modelo_avisos_enviados,
        'attributes' => [
            'texto',
        ]
    ]);?>
</div>