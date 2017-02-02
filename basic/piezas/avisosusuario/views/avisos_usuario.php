<?php

use yii\helpers\Html;
use app\models\Usuarios;

/* -- VARIABLES DISPONIBLES --
        $modelo_usuario
*/

/* -- DESCRIPCIÓN DE LA VISTA --
 * En esta vista se muestran los avisos recibidos, separando los por leer y los leídos en dos columnas.
 * Para ello se recupera la ActiveQuery de getAvisosRecibidos y, a partir de ella, se filtra utilizando
 * el atributo fecha_lectura: si está definido, el aviso está leído, si no (es null), está pendiente
 * de lectura.
 * Cada aviso se mostrará utilizando un alert bootstrap con el Usuario origen y el contenido.
 * */
?>

<div>
    <!-- AVISOS POR LEER-->
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <h1>Por Leer</h1>
        <?php foreach ($modelo_usuario->getAvisosRecibidos()
                           ->where(['fecha_lectura' => null])->all() as $avisoRecibido){?>
        <div class="alert alert-info col-xs-12">
            <div class="col-xs-12">
                <h4><?=$avisoRecibido->clase_aviso_id?></h4>
            </div>
            <div class="col-xs-12">
                <strong>Aviso de <?= Usuarios::find()
                        ->where(["id" => $avisoRecibido->origen_usuario_id])->one()->nick ?><br></strong>
                <?= $avisoRecibido->texto?>
            </div>
            <div class="col-xs-12"></div>
            <div class="col-xs-12">
                <?= Html::a('Marcar como leído', ['/avisos/marcar-como-leido', "id_aviso" => $avisoRecibido->id], ['class'=>'btn btn-primary']) ?>
            </div>
        </div>
        <?php }?>
    </div>

    <!-- AVISOS LEÍDOS-->
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <h1>Leídos</h1>
        <?php foreach ($modelo_usuario->getAvisosRecibidos()
            ->where(['not', ['fecha_lectura' => null]])->all() as $avisoRecibido){?>
        <div class="alert alert-success col-xs-12">
            <div class="col-xs-12">
                <h4><?=$avisoRecibido->clase_aviso_id?></h4>
            </div>
            <div class="col-xs-12">
                <strong>Aviso de <?= Usuarios::find()
                        ->where(["id" => $avisoRecibido->origen_usuario_id])->one()->nick ?> :</strong>
                <?= $avisoRecibido->texto?>
            </div>
        </div>
        <?php }?>
    </div>
</div>