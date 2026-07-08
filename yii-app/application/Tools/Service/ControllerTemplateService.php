<?php

namespace application\Tools\Service;

use yii\helpers\Inflector;

class ControllerTemplateService
{
    public function createView(string $filename): array
    {
        $output = [];
        $result = exec('/home/user/touchView ' . escapeshellarg($filename), $output);

        return [
            'filename' => $filename,
            'result' => $result,
            'output' => $output,
        ];
    }

    public function buildActionPreview(string $route, array $queryParams = []): array
    {
        $parts = explode('/', $route);
        $action = (string)array_pop($parts);
        $controller = (string)array_pop($parts);
        $namespace = $parts ? '\\' . implode('\\', $parts) : '';
        $methodName = 'action' . Inflector::id2camel($action);
        $controllerName = Inflector::id2camel($controller) . 'Controller';

        $params = [];
        $paramsCalled = [];
        foreach ($queryParams as $name => $value) {
            if (is_array($value)) {
                continue;
            }
            $params[] = "\${$name} = null";
            $paramsCalled[] = "\${$name} = '{$value}'";
        }

        $actionCode = $this->buildActionCode($methodName, implode(', ', $params), implode(', ', $paramsCalled));
        $controllerCode = $this->buildControllerCode($namespace, $controllerName, $actionCode);

        return [
            'controllerName' => $controllerName,
            'methodName' => $methodName,
            'actionCode' => $actionCode,
            'controllerCode' => $controllerCode,
        ];
    }

    private function buildActionCode(string $methodName, string $params, string $paramsCalled): string
    {
        return <<<PHP
public function {$methodName}({$params})
{
    //{$paramsCalled}
    //\\Yii::\$app->response->format = Response::FORMAT_JSON;
    //\$req = Yii::\$app->request
    //Yii::\$app->session->addFlash('error', Json::encode(\$model->errors));
    //Yii::\$app->session->addFlash('success', '');
    //return \$this->render(\$this->action->id, []);
    //return \$this->redirect(['index']);
    //return \$this->redirect(Yii::\$app->request->referrer ?: ['index']);
}
PHP;
    }

    private function buildControllerCode(string $namespace, string $controllerName, string $actionCode): string
    {
        $date = date('Y-m-d H:i:s');
        $actionCode = str_replace("\n", "\n    ", $actionCode);

        return <<<PHP
<?php
/**
 *
 * @since {$date}
 */

namespace backend\\controllers{$namespace};

use yii\\web\\Controller;

class {$controllerName} extends Controller
{
    {$actionCode}
}

PHP;
    }
}
