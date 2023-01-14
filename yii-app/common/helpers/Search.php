<?php

namespace common\helpers;

use common\models\{Gaz,Manufacture,News,Page,Product,Seo};
use yii\base\BaseObject;

class Search extends BaseObject
{
    public $q;

    public function  searchSeo()
    {
        $q = $this->q;
        return Seo::find()
            ->orWhere(['like', 'h1', $q])
            ->orWhere(['like', 'title', $q]);
    }

    public function  searchProduct()
    {
        $q = $this->q;
        return Product::find()
            ->orWhere(['like', 'name', $q])
            ->orWhere(['like', 'pdf', $q]);
    }

    public function  searchGaz()
    {
        $q = $this->q;
        return Gaz::find()
            ->orWhere(['like', 'title', $q])
            ->orWhere(['like', 'description', $q]);
    }

    public function  searchManufacture()
    {
        $q = $this->q;
        return Manufacture::find()
            ->orWhere(['like', 'title', $q])
            ->orWhere(['like', 'short_description', $q])
            ->orWhere(['like', 'description', $q]);
    }

    public function  searchNews()
    {
        $q = $this->q;
        return News::find()
            ->orWhere(['like', 'title', $q])
            ->orWhere(['like', 'content', $q]);
    }

    public function searchPage()
    {
        $q = $this->q;
        return Page::find()->orWhere(['like', 'content', $q]);
    }

}
