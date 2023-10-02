<?php
/**
 * generated 21-10-19 14:21:17
 *
 */

namespace common\models;

use common\helpers\Tools;
use common\models\base\ProductBase;
use common\models\query\ProductQuery;
use common\models\traits\CreatedUpdateAtText;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use common\models\traits\DynamicForm;

/**
 *
 * @property Seo $seo
 * @property ProductGaz $mainProductGaz
 * @property Gaz $mainGaz
 * @property Gaz $mainGaz2
 * @property Gaz $mainGaz3
 * @property Gaz $notMainGazes
 * @property string $pictUrl
 * @property string $pictPath
 * @property string $url
 */
class Product extends ProductBase
{
    use CreatedUpdateAtText;
    use DynamicForm;

    /**
     * @var UploadedFile
     */
    public $uploadPict;

    /**
     * @var UploadedFile
     */
    public $uploadPdf;

    /**
     * @var UploadedFile
     */
    public $uploadPdf2;

    /**
     * @var UploadedFile
     */
    public $uploadPdf3;

    public function getMainGazId()
    {
        return $this->mainGaz->id ?? null;
    }

    public function getMainGaz2Id()
    {
        return $this->mainGaz2->id ?? null;
    }

    public function getMainGaz3Id()
    {
        return $this->mainGaz3->id ?? null;
    }

    /**
     * @return array
     */
    public function rules()
    {
        $rules = parent::rules();

        $rules[] = ['uploadPict', 'file', 'extensions' => 'png, jpg, gif'];
        $rules[] = [['uploadPdf', 'uploadPdf2', 'uploadPdf3'], 'file', 'extensions' => 'pdf'];

        return $rules;
    }

    /**
     * {@inheritDoc}
     * @see \yii\base\Component::behaviors()
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
            ],
            'sluggable' => [
                'class' => SluggableBehavior::class,
                'attribute' => 'name',
                'immutable' => true,
            ],
        ];

    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeo()
    {
        return $this->hasOne(Seo::class, ['ref_id' => 'id'])
            ->andOnCondition(['type' => Seo::TYPE_PRODUCT]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMainProductGaz()
    {
        return $this->hasOne(ProductGaz::class, ['product_id' => 'id'])->andOnCondition(['is_main' => 1]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMainProductGaz2()
    {
        return $this->hasOne(ProductGaz::class, ['product_id' => 'id'])->andOnCondition(['is_main_2' => 1]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMainProductGaz3()
    {
        return $this->hasOne(ProductGaz::class, ['product_id' => 'id'])->andOnCondition(['is_main_3' => 1]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMainGaz()
    {
        return $this->hasOne(Gaz::class, ['id' => 'gaz_id'])->via('mainProductGaz');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMainGaz2()
    {
        return $this->hasOne(Gaz::class, ['id' => 'gaz_id'])->via('mainProductGaz2');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMainGaz3()
    {
        return $this->hasOne(Gaz::class, ['id' => 'gaz_id'])->via('mainProductGaz3');
    }

    /**
     * @return Gaz[]
     */
    public function getNotMainGazes()
    {
        $gazs = $this->gazs;

        if ($gazs and $mainGaz = $this->mainGaz) {
            $gazs = array_filter($gazs, function ($gaz) use ($mainGaz) {
                return $gaz->id !== $mainGaz->id;
            });
        }

        return $gazs;
    }


    /**
     * @param $colname
     * @param false $isPrependEmpty
     * @return array|false
     * @throws \yii\db\Exception
     */
    public static function getDropDownDataGroupCol($colname, $isPrependEmpty = false)
    {
        $q = self::find()->select($colname)->groupBy($colname);
        //->having(['not', [$colname => null]]);
        $rows = $q->createCommand()->queryColumn();

        $rows = array_combine($rows, $rows);

        if ($isPrependEmpty) {
            $rows = Tools::array_unshift_assoc($rows);
        }

        return $rows;
    }

    /**
     * @return false|string
     */
    public static function getUploadPictDir()
    {
        return \Yii::getAlias('@documentroot' . self::getUploadPictBaseUrl());
    }

    /**
     * @return string
     */
    public static function getUploadPictBaseUrl()
    {
        return '/i/products';
    }

    /**
     * @param bool $addTimestamp
     * @return string|void
     */
    public function getPictUrl($addTimestamp = true)
    {
        if (!$this->img) {
            return;
        }

        $url = self::getUploadPictBaseUrl() . "/{$this->id}.{$this->img}";

        if ($addTimestamp) {
            $url .= '?t=' . (int)$this->updated_at;
        }

        return $url;
    }

    /**
     * @return false|string
     */
    public function getPictPath()
    {
        return \Yii::getAlias('@documentroot' . $this->getPictUrl(false));
    }

    /**
     * @param string $i
     * @return string
     */
    public static function getPdfAttr($i = '')
    {
        return 'pdf' . ($i ? (int)$i : '');
    }

    /**
     * @return array
     */
    public static function getPdfIndexes()
    {
        return ['', 2, 3,];
    }

    /**
     * @param string $i
     * @param bool $addTimestamp
     * @return string|void
     */
    public function getPdfUrl($i = '', $addTimestamp = true)
    {
        $attr = self::getPdfAttr($i);
        if (!$this->$attr) {
            return;
        }

        $url = self::getUploadPdfBaseUrl($i) . "/{$this->id}.pdf";

        if ($addTimestamp) {
            $url .= '?t=' . (int)$this->updated_at;
        }

        return $url;
    }

    /**
     * @param string $i
     * @return false|string
     */
    public function getPdfPath($i = '')
    {
        return \Yii::getAlias('@documentroot' . $this->getPdfUrl($i, false));
    }

    /**
     * @param string $i
     * @return bool
     */
    public function isFilePdfExists($i = '')
    {
        return is_file($this->getPdfPath($i));
    }

    public static function getUploadPdfDir($i = '')
    {
        return \Yii::getAlias('@documentroot' . self::getUploadPdfBaseUrl($i));
    }

    public static function getUploadPdfBaseUrl($i = '')
    {
        return '/pdf/products' . ($i ? (int)$i : '');
    }

    /**
     * @inheritdoc
     * @return ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductQuery(get_called_class());
    }

    /**
     * @return bool
     */
    public function uploadPict()
    {
        $ext = strtolower($this->uploadPict->extension);
        $this->img = $ext;

        $filename = $this->getPictPath();

        if ($result = $this->uploadPict->saveAs($filename)) {
            $this->save(false);//save attr img
        }

        return $result;
    }

    /**
     * @param string $i
     * @return mixed
     */
    public function uploadPdf($i = '')
    {
        $i = $i ? (int)$i : '';
        $attr = 'pdf' . $i;
        $attrUpload = 'uploadPdf' . $i;

        $this->$attr = $this->$attrUpload->name;

        $filename = $this->getPdfPath($i);

        if ($result = $this->$attrUpload->saveAs($filename)) {
            $this->save(false);//save attr pdf
        }

        return $result;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        if ($this->gaz->slug ?? null) {
            return "/catalog/{$this->gaz->slug}/{$this->slug}";
        }

        return "/product/{$this->slug}";
    }

    /**
     * @param false $backend
     * @param bool $visible
     * @return array
     */
    public static function getGazesGridCol($backend = false, $visible = true)
    {
        return [
            'attribute' => 'gaz_title',
            'label' => 'Дополнительный газ',
            'visible' => $visible,
            'format' => 'raw',
            'value' => function ($model) use ($backend) {
                $gazs = $model->notMainGazes;
                $items = ArrayHelper::getColumn($gazs, function ($model) use ($backend) {
                    $label = $model->title;
                    if ($backend) {
                        $label .= " (#{$model->id})";
                        return Html::a($label, ['gaz/view', 'id' => $model->id],
                            ['class' => 'btn btn-sm btn-outline-primary m-1',
                                'target' => '_blank', 'data-pjax' => 0,]);
                    }

                    return Html::tag('div', $label, ['class' => 'fs-07']);
                    //return Html::a($label, "/catalog/{$model->slug}", ['class' => 'px-1']);
                });

                sort($items);
                return join("\n", $items);
            }
        ];

    }

    /**
     * @param false $backend
     * @return array
     */
    public static function getManufactureTitleGridCol($backend = false)
    {
        return [
            'attribute' => 'manufacture_title',
            'label' => 'Производитель',
            'format' => 'raw',
            'value' => function ($model) use ($backend) {
                $label = $model->manufacture->title ?? null;
                if ($backend) {
                    $url = ['manufacture/view', 'id' => $model->manufacture_id];
                } else {
                    $url = "/manufacture/{$model->manufacture->slug}";
                }

                return Html::a($label, $url,
                    ['target' => '_blank', 'data-pjax' => 0,]);
            }
        ];
    }

    /**
     * @return array
     */
    public static function getMeasurementTypeNameGridCol()
    {
        return [
            'attribute' => 'measurement_type_name',
            'label' => 'Тип измерения',
            'format' => 'raw',
            'value' => function ($model) {
                return $model->measurementType->name ?? null;
            }
        ];
    }

    /**
     * @param $ids
     * @throws \Exception
     */
    public function saveGazs($ids)
    {
        ProductGaz::deleteAll(['product_id' => $this->id]);

        foreach ($ids as $id) {
            $cond = ['product_id' => $this->id, 'gaz_id' => $id];
            if (ProductGaz::findOne($cond)) {//skip exists
                continue;
            }
            //todo check exists gaz?
            $model = new ProductGaz($cond);
            if (!$model->save()) {
                throw new \Exception('fail saving ProductGaz');
            }
        }
    }

    /**
     * @param int $id
     * @return void
     * @throws \Exception
     */
    public function saveMainbGaz(int $id)
    {
        if (!$id) {
            return;
        }

        $cond = ['product_id' => $this->id, 'gaz_id' => $id];
        $model = ProductGaz::findOne($cond);

        if (!$model) {
            $model = new ProductGaz($cond);
        }

        if ($model->is_main) {
            return; //not changed
        }

        //todo check exists gaz?

        $model->is_main = 1;

        if (!$model->save()) {
            throw new \Exception('fail saving ProductGaz');
        }
    }

    /**
     * @param int|null $id
     * @return void
     * @throws \Exception
     */
    public function saveMainbGaz2(?int $id = null)
    {
        if (!$id) {
            return;
        }

        $cond = ['product_id' => $this->id, 'gaz_id' => $id];
        $model = ProductGaz::findOne($cond);

        if (!$model) {
            $model = new ProductGaz($cond);
        }

        if ($model->is_main_2) {
            return; //not changed
        }

        //todo check exists gaz?

        $model->is_main_2 = 1;

        if (!$model->save()) {
            throw new \Exception('fail saving ProductGaz');
        }
    }

    /**
     * @param int|null $id
     * @return void
     * @throws \Exception
     */
    public function saveMainbGaz3(?int $id = null)
    {
        if (!$id) {
            return;
        }

        $cond = ['product_id' => $this->id, 'gaz_id' => $id];
        $model = ProductGaz::findOne($cond);

        if (!$model) {
            $model = new ProductGaz($cond);
        }

        if ($model->is_main_3) {
            return; //not changed
        }

        //todo check exists gaz?

        $model->is_main_3 = 1;

        if (!$model->save()) {
            throw new \Exception('fail saving ProductGaz');
        }
    }

    /**
     * @return false|string
     */
    public function getJsonLd()
    {
        $images = [];
        if ($this->pictUrl) {
            $images[] = 'https://gassensor.ru' . $this->getPictUrl(false);
        }

        $data = [
            '@context' => 'https://schema.org/',
            '@type' => 'Product',
            'name' => $this->name,
            'image' => $images,
            'description' => $this->name,
            'sku' => $this->id,
            'mpn' => $this->id,
            'brand' => [
                '@type' => 'Brand',
                'name' => $this->manufacture->title ?? null,
            ],
            'review' => [
                '@type' => 'Review',
                'reviewRating' => [
                    '@type' => 'Rating',
                    'ratingValue' => 4.99,
                    'bestRating' => 5,
                ],
                'author' => [
                    '@type' => 'Person',
                    'name' => 'anonymous',
                ],

            ],
            'aggregateRating' => [
                '@type' => 'AggregateRating',
                'ratingValue' => 4.99,
                'reviewCount' => 1000,
            ],
            'offers' => [
                '@type' => 'Offer',
                'price' => 0.01,
                'availability' => 'https://schema.org/InStock',
                'url' => 'https://gassensor.ru/product/' . $this->slug,
                'priceValidUntil' => date('Y-m-d', time() + 3600 * 24 * 365),
                'priceCurrency' => 'RUR',
            ],
        ];

        return json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

        /*
            {
              "@context": "https://schema.org/",
              "@type": "Product",
              "name": "Executive Anvil",
              "image": [
                "https://example.com/photos/1x1/photo.jpg",
                "https://example.com/photos/4x3/photo.jpg",
                "https://example.com/photos/16x9/photo.jpg"
               ],
              "description": "Sleeker than ACME's Classic Anvil, the Executive Anvil is perfect for the business traveler looking for something to drop from a height.",
              "sku": "0446310786",
              "mpn": "925872",
              "brand": {
                "@type": "Brand",
                "name": "ACME"
              },
              "review": {
                "@type": "Review",
                "reviewRating": {
                  "@type": "Rating",
                  "ratingValue": "4",
                  "bestRating": "5"
                },
                "author": {
                  "@type": "Person",
                  "name": "Fred Benson"
                }
              },
              "aggregateRating": {
                "@type": "AggregateRating",
                "ratingValue": "4.4",
                "reviewCount": "89"
              },
              "offers": {
                "@type": "Offer",
                "url": "https://example.com/anvil",
                "priceCurrency": "USD",
                "price": "119.99",
                "priceValidUntil": "2020-11-20",
                "itemCondition": "https://schema.org/UsedCondition",
                "availability": "https://schema.org/InStock"
              }
            }
        */

    }

}