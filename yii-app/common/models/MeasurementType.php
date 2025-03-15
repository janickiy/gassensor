<?php
/**
 * generated 21-10-19 14:22:24
 *
 */

namespace common\models;

use common\helpers\Tools;
use common\models\base\MeasurementTypeBase;
use common\models\query\MeasurementTypeQuery;
use common\models\search\ProductSearch;
use yii\helpers\ArrayHelper;
use Yii;

class MeasurementType extends MeasurementTypeBase
{

    /**
     * @param false $isPrependEmpty
     * @return array
     */
    public static function getDropDownData(bool $isPrependEmpty = false): array
    {
        $rows = self::find()->cache(10)->all();
        $rows = ArrayHelper::map($rows, 'id', 'name');

        if ($isPrependEmpty) {
            $rows = Tools::array_unshift_assoc($rows);
        }

        return $rows;
    }


    /**
     * @inheritdoc
     * @return MeasurementTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MeasurementTypeQuery(get_called_class());
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

    /**
     * @param ProductSearch $searchModel
     * @return array
     */
    public static function measurementTypeOption(ProductSearch $searchModel): array
    {
        $measurementTypeIds = self::findAvailableMeasurementTypeIds($searchModel);
        $measurementTypeOption = ['' => ['label' => ' ']];

        if ($measurementTypeIds) {
            foreach (MeasurementType::getDropDownData(true) as $id => $label) {
                if (!in_array($id, $measurementTypeIds) && !empty($id)) {
                    $measurementTypeOption[$id] = ['disabled' => true];
                }
            }
        }

        return $measurementTypeOption;
    }
}