<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* Variables disponibles:
        $modelo_usuario
*/

?>

<div>
    <h1>ACTIVIDADES PROPIAS</h1>
    <? print_r($modelo_usuario->actividadesPropias)?>

    <h1>ACTIVIDADES EN SEGUIMIENTO</h1>
    <? print_r($modelo_usuario->actividadesSeguimiento)?>

     <h1>ACTIVIDADES EN LAS QUE PARTICIPA</h1>
    <? print_r($modelo_usuario->actividadesParticipante)?>
</div>