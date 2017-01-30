<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ActividadSeguimientos]].
 *
 * @see ActividadSeguimientos
 */
class ActividadSeguimientosQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ActividadSeguimientos[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ActividadSeguimientos|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
