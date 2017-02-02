<?php

use app\piezas\datosusuario\DatosUsuarioWidget;
use app\piezas\avisosusuario\AvisosUsuarioWidget;
use app\piezas\actividadesusuario\ActividadesUsuarioWidget;
use app\piezas\alertasusuario\AlertasUsuarioWidget;

$this->title = "Mi Perfil";
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
        <li class="<?php if ($active_tab==="tab_datos") {echo "active";}?>">
            <a data-toggle="tab" href="#menu_mis_datos">MIS DATOS</a>
        </li>
        <li class="<?php if ($active_tab==="tab_actividades") {echo "active";}?>">
            <a data-toggle="tab" href="#menu_actividades">ACTIVIDADES</a>
        </li>
        <li class="<?php if ($active_tab==="tab_avisos") {echo "active";}?>">
            <a data-toggle="tab" href="#menu_avisos_notificaciones">AVISOS Y NOTIFICACIONES</a>
        </li>
        <li class="<?php if ($active_tab==="tab_alertas") {echo "active";}?>">
            <a data-toggle="tab" href="#menu_alertas_notas">ALERTAS Y NOTAS</a>
        </li>
    </ul>

    <!-- CONTENIDO DE LOS TABS -->
    <div class="tab-content">
        <div id="menu_mis_datos" class="tab-pane fade in <?php if ($active_tab==="tab_datos") {echo "active";}?>">
            <?= DatosUsuarioWidget::widget(['modelo_usuario' => $modelo_usuario]) ?>
        </div>
        <div id="menu_actividades" class="tab-pane fade in <?php if ($active_tab==="tab_actividades") {echo "active";}?>">
            <?= ActividadesUsuarioWidget::widget(['modelo_usuario' => $modelo_usuario]) ?>
        </div>
        <div id="menu_avisos_notificaciones" class="tab-pane fade in <?php if ($active_tab==="tab_avisos") {echo "active";}?>">
            <?= AvisosUsuarioWidget::widget(['modelo_usuario' => $modelo_usuario]) ?>
        </div>
        <div id="menu_alertas_notas" class="tab-pane fade in <?php if ($active_tab==="tab_alertas") {echo "active";}?>">
            <?= AlertasUsuarioWidget::widget(['modelo_usuario' => $modelo_usuario]) ?>
        </div>
    </div>
</div>