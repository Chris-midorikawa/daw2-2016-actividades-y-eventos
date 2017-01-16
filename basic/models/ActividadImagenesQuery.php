<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ActividadImagenes]].
 *
 * @see ActividadImagenes
 */
class ActividadImagenesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ActividadImagenes[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ActividadImagenes|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
