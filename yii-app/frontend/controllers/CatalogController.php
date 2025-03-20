<?php
/**
 *
 * @since 2021-10-19 10:20:27
 */

namespace frontend\controllers;

use common\models\Gaz;
use common\models\Manufacture;
use common\models\MeasurementType;
use common\models\search\ProductSearch;
use common\models\Seo;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CatalogController extends Controller
{
    /**
     * @param null $sort
     * @return string
     */
    public function actionIndex($sort = null)
    {
        $searchModel = new ProductSearch();

        if ($this->request->isAjax) {
            return $this->renderPartial('popover-filter', [
                'searchModel' => $searchModel,
                'dataProvider' => $searchModel->searchFront($this->request->post()),
            ]);
        }

        $params = $this->request->queryParams;

        $dataProvider = $searchModel->searchFront($params);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'seo' => $searchModel->manufacture->seo ?? null,
        ]);
    }

    /**
     * @param $slug
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionGas($slug)
    {
        $searchModel = new ProductSearch();

        $params = $this->request->queryParams;

        if (!$gaz = Gaz::findOne(['slug' => $slug])) {
            throw new NotFoundHttpException();
        }

        $params['ProductSearch']['gaz_id'] = $gaz->id;

        $dataProvider = $searchModel->searchFront($params);

        $dataProvider->query->joinWith('manufacture')->orderBy('manufacture.weight, id');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'seo' => $gaz->seo,
        ]);
    }

    /**
     * @param $slug
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionManufacture($slug)
    {
        $searchModel = new ProductSearch();

        $params = $this->request->queryParams;

        if (!$manufacture = Manufacture::findOne(['slug' => $slug])) {
            throw new NotFoundHttpException();
        }

        $seo = Seo::find()->where(['type' => Seo::TYPE_CATALOG_MANUFACTURES, 'ref_id' => $manufacture->id])->one();

        $params['ProductSearch']['manufacture_id'] = $manufacture->id;
        $dataProvider = $searchModel->searchFront($params);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'seo' => $seo,
        ]);
    }

    /**
     * @param int $manufacture_id
     * @return void
     */
    public function actionGazOptions(int $manufacture_id)
    {
        $rows = Gaz::find()->orderBy('title')->asArray()->all();

        $noAvailableIds = Gaz::find()->select(['gaz.id'])
            ->leftJoin('product_gaz', 'product_gaz.gaz_id = gaz.id')
            ->leftJoin('product', 'product.id = product_gaz.product_id')
            ->andWhere(['product.manufacture_id' => $manufacture_id])
            ->column();

        $options = '<option value="" label=""></option>';

        foreach ($rows as $row) {
            if (in_array($row['id'], $noAvailableIds) === false) {
                $options .= '<option value="' . $row['id'] . '" disabled="disabled">' . $row['title'] . '</option>';
            } else {
                $options .= '<option value="' . $row['id'] . '">' . $row['title'] . '</option>';
            }
        }

        echo $options;
    }

    /**
     * @param int $gaz_id
     * @return void
     */
    public function actionManufactureOptions(int $gaz_id)
    {
        $rows = Manufacture::find()->orderBy('title')->asArray()->all();

        $noAvailableIds = Manufacture::find()->select(['manufacture.id'])
            ->leftJoin('product', 'product.manufacture_id = manufacture.id')
            ->leftJoin('product_gaz', 'product_gaz.product_id = product.id')
            ->andWhere(['product_gaz.gaz_id' => $gaz_id])
            ->column();

        $options = '<option value="" label=""></option>';

        foreach ($rows as $row) {
            if (in_array($row['id'], $noAvailableIds) === false) {
                $options .= '<option value="' . $row['id'] . '" disabled="disabled">' . $row['title'] . '</option>';
            } else {
                $options .= '<option value="' . $row['id'] . '">' . $row['title'] . '</option>';
            }
        }

        echo $options;
    }

    public function actionMeasurementTypeOptions()
    {
        $rows = MeasurementType::find()->orderBy('name')->asArray()->all();
        $noAvailableIds = MeasurementType::findAvailableMeasurementTypeAjaxIds();

        $options = '<option value="" label=""></option>';

        foreach ($rows as $row) {
            if (in_array($row['id'], $noAvailableIds)=== false) {
                $options .= '<option value="' . $row['id'] . '" disabled="disabled">' . $row['name'] . '</option>';
            } else {
                $options .= '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
            }
        }

        echo $options;
    }
}

