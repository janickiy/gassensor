<?php

namespace frontend\helpers;

use common\models\Gaz;
use common\models\Manufacture;
use common\models\MeasurementType;
use common\models\search\ProductSearch;
use yii\web\Controller;
use Yii;

class CatalogFilterHelper extends Controller
{
    /**
     * @param ProductSearch $searchModel
     * @return array|\yii\db\DataReader
     * @throws \yii\db\Exception
     */
    public static function findAvailableManufacturesIds(ProductSearch $searchModel)
    {
        $params = Yii::$app->request->queryParams;

        if ($searchModel->gaz_id) {
            unset($params['ProductSearch']['manufacture_id']);

            $ids = (new ProductSearch())->searchFront($params)->query->select(['product.id'])->column();

            if ($ids) {
                $manufactureAvailableIds = Yii::$app->db->createCommand("
                SELECT m.id FROM `manufacture` m
                LEFT JOIN product p ON p.manufacture_id = m.id
                WHERE p.id IN (" . join(',', $ids) . ")
                GROUP BY m.id
            ")->queryColumn();
            } else {
                $manufactureAvailableIds = null;
            }
        } else {
            $manufactureAvailableIds = Manufacture::find()->select(['id'])->column();
        }

        return $manufactureAvailableIds;
    }

    /**
     * @param ProductSearch $searchModel
     * @return array|\yii\db\DataReader
     * @throws \yii\db\Exception
     */
    public static function findAvailableGazIds(ProductSearch $searchModel)
    {
        $params = Yii::$app->request->queryParams;

        if ($searchModel->manufacture_id) {
            unset($params['ProductSearch']['gaz_id']);

            $ids = (new ProductSearch())->searchFront($params)->query->select(['product.id'])->column();

            if ($ids) {
                $gazAvailableIds = Yii::$app->db->createCommand("
				SELECT g.id FROM `gaz` g
                LEFT JOIN product_gaz pg ON pg.gaz_id = g.id
                LEFT JOIN product p ON p.id = pg.product_id
                WHERE p.id IN (" . join(',', $ids) . ")
                GROUP BY g.id
            ")->queryColumn();
            } else {
                $gazAvailableIds = null;
            }
        } else {
            $gazAvailableIds = Gaz::find()->select(['id'])->column();
        }

        return $gazAvailableIds;
    }

    /**
     * @param ProductSearch $searchModel
     * @return array|\yii\db\DataReader
     * @throws \yii\db\Exception
     */
    public static function findAvailableMeasurementTypeIds(ProductSearch $searchModel)
    {
        $params = Yii::$app->request->queryParams;

        if ($searchModel->gaz_id || $searchModel->manufacture_id) {
            unset($params['ProductSearch']['measurement_type_id']);

            $ids = (new ProductSearch())->searchFront($params)->query->select(['product.id'])->column();

            if ($ids) {
                $measurementTypeIds = Yii::$app->db->createCommand("
				SELECT m.id FROM `measurement_type` m
                LEFT JOIN product p ON p.measurement_type_id = m.id
                WHERE p.id IN (" . join(',', $ids) . ")
                GROUP BY m.id
            ")->queryColumn();
            } else {
                $measurementTypeIds = null;
            }
        } else {
            $measurementTypeIds = MeasurementType::find()->select(['id'])->column();
        }

        return $measurementTypeIds;
    }
}