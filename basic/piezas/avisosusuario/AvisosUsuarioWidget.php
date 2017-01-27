<?php
/**
 * Created by PhpStorm.
 * User: ernesto
 * Date: 27/1/17
 * Time: 13:21
 */

namespace app\piezas\avisosusuario;


use yii\base\Widget;

class AvisosUsuarioWidget extends Widget
{
    public $modelo_usuario;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->render('avisos_usuario', ['modelo_usuario' => $this->modelo_usuario]);
    }
}