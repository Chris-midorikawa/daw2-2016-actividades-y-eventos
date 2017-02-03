<?php

namespace app\models;

use Yii;
use yii\base\Model;
use  yii\web\IdentityInterface;
/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $nick;
    public $password;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['nick', 'password'], 'required'],

        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        $hash = Yii::$app->getSecurity()->generatePasswordHash($this->password);
            if (Yii::$app->getSecurity()->validatePassword($this->password,$hash)) {
                $user = $this->getUser();

            } else {
                $this->addError($attribute, 'Usuario o Contraseña no valido.');
            }

    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if($this->getUser()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }else { echo "Usuario o contraseña no valido."; return false;}
    }

    // LLAMADA A USUARIOS PARA COMPROBAR NICK Y PASSWORD "LOGIN"
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = Usuarios::ValidarUsuario($this->nick,$this->password);
        }

        return $this->_user;
    }
}
