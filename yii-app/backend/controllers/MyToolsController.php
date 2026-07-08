<?php

namespace backend\controllers;

use application\Tools\Service\ControllerTemplateService;
use Yii;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\Response;

class MyToolsController extends Controller
{
    public function actionCreateView(string $filename): Response
    {
        return $this->asJson($this->templateService()->createView($filename));
    }

    public function actionCreateAction(string $route, array $queryParams = []): string
    {
        $preview = $this->templateService()->buildActionPreview($route, $queryParams);

        return implode('', [
            Html::tag('div', Html::encode("{$preview['controllerName']} {$preview['controllerName']}.php {$preview['methodName']}")),
            Html::tag('textarea', Html::encode($preview['actionCode']), [
                'id' => 'ta1',
                'cols' => 80,
                'rows' => 10,
                'class' => 'ta',
            ]),
            Html::tag('hr'),
            Html::tag('textarea', Html::encode($preview['controllerCode']), [
                'id' => 'ta2',
                'cols' => 80,
                'rows' => 30,
                'class' => 'ta',
            ]),
            $this->copyScript(),
        ]);
    }

    private function templateService(): ControllerTemplateService
    {
        return Yii::$container->get(ControllerTemplateService::class);
    }

    private function copyScript(): string
    {
        return <<<HTML
<script>
document.querySelectorAll('.ta').forEach((item) => {
    item.onclick = function() {
        this.select();
        document.execCommand('copy');
    };
});
</script>
HTML;
    }
}
