<?php
/**
 *
 * @since 2021-12-20
 */

namespace common\helpers;

use Yii;
use common\models\Redirect;
use yii\base\ActionFilter;
use common\models\Url;

class MyBehavior extends ActionFilter
{
    const SESSION_KEY_COUNTER = 'redirectCount';

    public $limit = 5;

    /**
     * @param \yii\base\Action $action
     * @return bool
     */
    public function beforeAction($action)
    {
        $uri = $_SERVER['REQUEST_URI'] ?? null;

        /** @var $session \yii\web\Session */
        $session = Yii::$app->session;

        if ($uri = trim($uri, ' /')) {

            $model = Redirect::findOne([
                'from' => '/' . $uri,
            ]);

            if ($model) {
                $val = $session->get(self::SESSION_KEY_COUNTER, 0) + 1;
                $session->set(self::SESSION_KEY_COUNTER, $val);

                if ($val < $this->limit) {
                 Yii::$app->getResponse()->redirect($model->to, 301);
                 return false;
                }
            }

            $model = Url::findOne([
                'url' => '/' . $uri,
                'is_nofollow' => 1,
            ]);

            $q = Url::find()
                ->andWhere(['url' => '/' . $uri])
                ->andWhere(['or', ['is_nofollow' => 1], ['is_noindex' => 1]]);

            if ($model = $q->one()) {
                /* @var $request \yii\web\View */
                $view = Yii::$app->view;
                $content = [];
                if ($model->is_noindex) {
                    $content[] = 'noindex';
                }
                if ($model->is_nofollow) {
                    $content[] = 'nofollow';
                }

                $view->registerMetaTag(['name' => 'robots', 'content' => join(',', $content)]);
            }
        }

        $session->remove(self::SESSION_KEY_COUNTER);

        return parent::beforeAction($action);
    }
}