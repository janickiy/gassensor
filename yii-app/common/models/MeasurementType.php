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
     * @return array
     */
    public static function measurementTypeOption(ProductSearch $searchModel): array
    {
        $rows = self::find()->orderBy('name')->asArray()->all();

        $q = self::find()->select(['measurement_type.id']);
        $q->leftJoin('product', 'product.measurement_type_id = measurement_type.id');

        if ($searchModel->gaz_id) {
            $q->leftJoin('product_gaz', 'product_gaz.product_id = product.id');
            $q->andWhere(['product_gaz.gaz_id' => $searchModel->gaz_id]);
        }

        if ($searchModel->manufacture_id) {
            $q->andWhere(['product.manufacture_id' => $searchModel->manufacture_id]);
        }

        $options = ['' => ['label' => ' ']];

        foreach ($rows as $row) {
            if (in_array($row['id'], $q->column()) === false) $options[$row['id']] = ['disabled' => true];
        }

        return $options;
    }
}