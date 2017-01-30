<?php

namespace app\piezas\alertasusuario;


use yii\base\Widget;

class AlertasUsuarioWidget extends Widget
{
    public $modelo_usuario;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->render('alertas_usuario', ['modelo_usuario' => $this->modelo_usuario]);
    }
}