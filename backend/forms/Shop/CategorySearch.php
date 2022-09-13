<?php

namespace backend\forms\Shop;

use shop\entities\Shop\Brand;
use shop\entities\Shop\Category;
use shop\entities\Shop\Tag;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class CategorySearch extends Model
{
    public $id;
    public $name;
    public $slug;
    public $title;
    public $description;

    public function rules(): array
    {
        return [
            [['id'], 'integer'],
            [['name', 'slug', 'title', 'description'], 'safe']
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = Category::find()->where(['>', 'depth', 0]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['left' => SORT_ASC],
            ]
        ]);

        $this->load($params);
        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id' => $this->id,
        ]);
        $query->andFilterWhere(['ilike', 'name', $this->name])
            ->andFilterWhere(['ilike', 'slug', $this->slug])
            ->andFilterWhere(['ilike', 'title', $this->title])
            ->andFilterWhere(['ilike', 'description', $this->description]);

        return $dataProvider;
    }

}