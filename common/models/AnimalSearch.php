<?php

namespace common\models;

use common\models\Animal;
use yii\base\Model;
use yii\data\ActiveDataProvider;


/**
 * AnimalSearch represents the model behind the search form of `common\models\Animal`.
 */
class AnimalSearch extends Animal
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'type', 'age', 'status'], 'integer'],
            [['name', 'timestamp'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Animal::find();

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

        Animal::$giveAwayTimeStamp = Animal::find()->where(['status' => 1, 'type' => $this->type ?? array_keys(self::ANIMAL_TYPES)])->min('timestamp');

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'type' => $this->type,
            'age' => $this->age,
            'status' => $this->status,
            'timestamp' => $this->timestamp,
        ]);

        $query->andFilterWhere([
            'status' => 1
        ]);

        $query->orderBy('name ASC');

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
