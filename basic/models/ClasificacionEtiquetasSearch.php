<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ClasificacionEtiquetas;

/**
 * ClasificacionEtiquetasSearch represents the model behind the search form about `app\models\ClasificacionEtiquetas`.
 */
class ClasificacionEtiquetasSearch extends ClasificacionEtiquetas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'clasificacion_id', 'etiqueta_id', 'clasificacion_etiqueta_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ClasificacionEtiquetas::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'clasificacion_id' => $this->clasificacion_id,
            'etiqueta_id' => $this->etiqueta_id,
            'clasificacion_etiqueta_id' => $this->clasificacion_etiqueta_id,
        ]);

        return $dataProvider;
    }
}
