<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* Variables disponibles:
        $modelo_usuario
*/
?>

<div>
    <h1>AVISOS RECIBIDOS</h1>
    <? print_r($modelo_usuario->avisosRecibidos)?>
    <h1>AVISOS ENVIADOS</h1>
    <? print_r($modelo_usuario->avisosEnviados)?>
</div>