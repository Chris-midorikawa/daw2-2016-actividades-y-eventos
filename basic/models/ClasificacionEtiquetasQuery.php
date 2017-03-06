<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ClasificacionEtiquetas]].
 *
 * @see ClasificacionEtiquetas
 */
class ClasificacionEtiquetasQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ClasificacionEtiquetas[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ClasificacionEtiquetas|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
