<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\piezas\datosusuario\DatosUsuarioWidget;
use app\piezas\avisosusuario\AvisosUsuarioWidget;
use app\piezas\actividadesusuario\ActividadesUsuarioWidget;
use app\piezas\alertasusuario\AlertasUsuarioWidget;

$this->title = "MI PERFIL";
?>


<!--SISTEMA DE PESTAÑAS BOOTSTRAP:
        1ª DATOS DE USUARIO
        2ª ACTIVIDADES DE USUARIO (PROPIAS, EN SEGUIMIENTO Y COMO PARTICIPANTE)
        3ª AVISOS Y NOTIFICACIONES
        4ª ALERTAS Y NOTAS
        DENTRO DE CADA UNA SE MOSTRARÁ UN WIDGET CON EL CONTENIDO Y LOS ENLACES A LAS
            ACCIONES CORRESPONDIENTES-->
<div>
    <!-- TABS DEL MENÚ -->
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#menu_mis_datos">MIS DATOS</a></li>
        <li><a data-toggle="tab" href="#menu_actividades">ACTIVIDADES</a></li>
        <li><a data-toggle="tab" href="#menu_avisos_notificaciones">AVISOS Y NOTIFICACIONES</a></li>
        <li><a data-toggle="tab" href="#menu_alertas_notas">ALERTAS Y NOTAS</a></li>
    </ul>

    <!-- CONTENIDO DE LOS TABS -->
    <div class="tab-content">
        <div id="menu_mis_datos" class="tab-pane fade in active">
            <?= DatosUsuarioWidget::widget(['modelo_usuario' => $modelo_usuario]) ?>
        </div>
        <div id="menu_actividades" class="tab-pane fade">
            <?= ActividadesUsuarioWidget::widget(['modelo_usuario' => $modelo_usuario]) ?>
        </div>
        <div id="menu_avisos_notificaciones" class="tab-pane fade">
            <?= AvisosUsuarioWidget::widget(['modelo_usuario' => $modelo_usuario]) ?>
        </div>
        <div id="menu_alertas_notas" class="tab-pane fade">
            <?= AlertasUsuarioWidget::widget(['modelo_usuario' => $modelo_usuario]) ?>
        </div>
    </div>
</div>