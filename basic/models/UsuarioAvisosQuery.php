<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[UsuarioAvisos]].
 *
 * @see UsuarioAvisos
 */
class UsuarioAvisosQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return UsuarioAvisos[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return UsuarioAvisos|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
