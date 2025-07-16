<?php

namespace frontend\controllers;

use yii\web\Controller;
use yii\helpers\Inflector;

class MyToolsController extends Controller
{
    /**
     * @param $filename
     */
    public function actionCreateView($filename)
    {
        var_dump($filename);
        $result = exec("/home/user/touchView $filename", $o);
        var_dump($result);
        var_dump($o);
    }

    /**
     * @param $route
     * @param array $queryParams
     */
    public function actionCreateAction($route, array $queryParams = [])
    {
        //list($controller, $action) = explode('/', $route);

        $arr = explode('/', $route);

        $action = array_pop($arr);
        $controller = array_pop($arr);

        $ns = $arr ? '\\' . join('\\', $arr) : '';

        var_dump($queryParams);

        $methodName = 'action' . Inflector::id2camel($action);
        $controllerName = Inflector::id2camel($controller) . 'Controller';

        echo "$controllerName $controllerName.php<br/>$methodName<br/>";

        $params = [];
        $paramsCalled = [];

        foreach ($queryParams as $name => $val) {
            if (is_array($val)) {
                continue;
            }

            $params[] = "\$$name = null";
            $paramsCalled[] = "\$$name = '$val'";
        }

        $paramsStr = join(', ', $params);
        $paramsCalledStr = join(', ', $paramsCalled);

        $strAction = <<<EOD
public function $methodName($paramsStr)
{
    //$paramsCalledStr
    //\Yii::\$app->response->format = Response::FORMAT_JSON;
    //\$req = Yii::\$app->request
    //Yii::\$app->session->addFlash('error', Json::encode(\$model->errors));
    //Yii::\$app->session->addFlash('success', '');
    //return \$this->render(\$this->action->id, []);
    //return \$this->redirect(['index']);
    //return \$this->redirect(Yii::\$app->request->referrer ?: ['index']);
}
EOD;

        echo "<textarea id='ta1' cols='80' rows='10' class='ta'>$strAction</textarea>";

        $date = date('Y-m-d H:i:s');

        $strAction = str_replace("\n", "\n    ", $strAction);

        $strController = <<<EOD
<?php
/**
 *
 * @since $date
 */

namespace backend\controllers$ns;

use yii\web\Controller;

class $controllerName extends Controller
{
    $strAction
}

EOD;


        echo "<hr/><textarea id='ta2' cols='80' rows='30' class='ta'>$strController</textarea>";

        echo "<script>
            var el = document.getElementById('ta1');
            var els = document.getElementsByClassName('ta');
            var selectors = [].slice.call(els)

            console.log(document.getElementsByClassName('ta'), selectors);

            selectors.forEach((item, i) => {
                console.log(item, i);
                item.onclick = function() {
                    console.log('click', this);
                    this.select();
                    document.execCommand('copy');
                };
            })

        </script>";


    }


}
