<?php

namespace frontend\helpers;

use common\models\Gaz;
use common\models\Manufacture;
use common\models\search\ProductSearch;
use yii\web\Controller;

class CatalogFilterHelper extends Controller
{
    public static function findAvailableManufacturesIds(ProductSearch $searchModel)
    {
        $params = \Yii::$app->request->queryParams;

        if ($searchModel->gaz_id) {
            unset($params['ProductSearch']['manufacture_id']);

            $ids = (new ProductSearch())->searchFront($params)->query->select(['product.id'])->column();

            $manufactureAvailableIds = \Yii::$app->db->createCommand("
                SELECT m.id FROM `manufacture` m
                LEFT JOIN product p ON p.manufacture_id = m.id
                WHERE p.id IN (" . join(',', $ids) . ")
                GROUP BY m.id
            ")->queryColumn();

        } else {
            $manufactureAvailableIds  = Manufacture::find()->select(['id'])->column();
        }

        return $manufactureAvailableIds;
    }

    public static function findAvailableGazIds(ProductSearch $searchModel)
    {
        $params = \Yii::$app->request->queryParams;

        if ($searchModel->manufacture_id) {
            unset($params['ProductSearch']['gaz_id']);

            $ids = (new ProductSearch())->searchFront($params)->query->select(['product.id'])->column();

            $gazAvailableIds = \Yii::$app->db->createCommand("
				SELECT g.id FROM `gaz` g
                LEFT JOIN product_gaz pg ON pg.gaz_id = g.id
                LEFT JOIN product p ON p.id = pg.product_id
                WHERE p.id IN (" . join(',', $ids) . ")
                GROUP BY g.id
            ")->queryColumn();

        } else {
            $gazAvailableIds  = Gaz::find()->select(['id'])->column();
        }

        return $gazAvailableIds;
    }
}