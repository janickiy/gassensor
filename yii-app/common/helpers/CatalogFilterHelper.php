<?php

namespace common\helpers;

use common\models\Gaz;
use common\models\Manufacture;
use common\models\MeasurementType;
use common\models\search\ProductSearch;
use Yii;
use yii\web\Controller;

class CatalogFilterHelper extends Controller
{
    /**
     * @param ProductSearch $searchModel
     * @return array|null
     */
    public static function findAvailableManufacturesIds(ProductSearch $searchModel): ?array
    {
        $params = Yii::$app->request->queryParams;

        if ($searchModel->gaz_id) {
            unset($params['ProductSearch']['manufacture_id']);

            $ids = (new ProductSearch())->searchFront($params)->query->select(['product.id'])->column();

            if ($ids) {
                $manufactureAvailableIds = Manufacture::find()
                    ->select(['manufacture.id'])
                    ->leftJoin('product','product.manufacture_id = manufacture.id')
                    ->where(['in', 'product.id', $ids])
                    ->groupBy(['manufacture.id'])
                    ->column();
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
     * @return array|null
     */
    public static function findAvailableGazIds(ProductSearch $searchModel): ?array
    {
        $params = Yii::$app->request->queryParams;

        if ($searchModel->manufacture_id) {
            unset($params['ProductSearch']['gaz_id']);

            $ids = (new ProductSearch())->searchFront($params)->query->select(['product.id'])->column();

            if ($ids) {
                $gazAvailableIds = Gaz::find()
                    ->select(['gaz.id'])
                    ->leftJoin('product_gaz','product_gaz.gaz_id = gaz.id')
                    ->leftJoin('product','product.id = product_gaz.product_id')
                    ->where(['in', 'product.id', $ids])
                    ->groupBy(['gaz.id'])
                    ->column();
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
     * @return array|null
     */
    public static function findAvailableMeasurementTypeIds(ProductSearch $searchModel): ?array
    {
        $params = Yii::$app->request->queryParams;

        if ($searchModel->gaz_id || $searchModel->manufacture_id) {
            unset($params['ProductSearch']['measurement_type_id']);

            $ids = (new ProductSearch())->searchFront($params)->query->select(['product.id'])->column();

            if ($ids) {
                $measurementTypeIds = MeasurementType::find()
                    ->select(['measurement_type.id'])
                    ->leftJoin('product','product.measurement_type_id = measurement_type.id')
                    ->where(['in', 'product.id', $ids])
                    ->groupBy(['measurement_type.id'])
                    ->column();
            } else {
                $measurementTypeIds = null;
            }
        } else {
            $measurementTypeIds = MeasurementType::find()->select(['id'])->column();
        }

        return $measurementTypeIds;
    }
}