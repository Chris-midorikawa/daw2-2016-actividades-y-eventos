<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ActividadComentarios]].
 *
 * @see ActividadComentarios
 */
class ActividadComentariosQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ActividadComentarios[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ActividadComentarios|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
