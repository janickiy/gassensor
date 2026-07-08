<?php

namespace backend\controllers;

use application\User\Service\UserService;
use backend\models\UserForm;
use common\models\search\UserSearch;
use modules\admin\controllers\BaseCrudController;
use Yii;

class UserController extends BaseCrudController
{
    protected function serviceClass(): string
    {
        return UserService::class;
    }

    protected function searchModelClass(): string
    {
        return UserSearch::class;
    }

    public function actionIndex(): string
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->andWhere('id != 2');

        return $this->render('index', compact('searchModel', 'dataProvider'));
    }

    public function actionCreate()
    {
        $model = new UserForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $this->userService()->createFromForm($model);

            return $this->redirect(['index']);
        }

        return $this->render('create', compact('model'));
    }

    public function actionDelete(int $id)
    {
        $this->userService()->deleteWithRoles($id);

        return $this->redirect(['index']);
    }

    private function userService(): UserService
    {
        return Yii::$container->get(UserService::class);
    }
}
