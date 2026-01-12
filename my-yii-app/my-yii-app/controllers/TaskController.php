<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\Task;
use app\models\User;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;
use app\services\TaskService;

class TaskController extends Controller
{
    // public $modelClass = 'app\models\Task';


    public function actionIndex()
    {
        $modelIsmail = Task::find()->all();
        return $modelIsmail;
    }

    public function actionCreate()
    {
        $data = Yii::$app->request->getBodyParams();
        $service = new TaskService();
        $task = $service->createTask($data);
        Yii::$app->response->setStatusCode(201);
        return $task;

    }

    public function actionUpdate($id)
    {
        $data_meta = Yii::$app->request->getBodyParams();
        $service = new TaskService();
        $updateTask = $service->updateTask($data_meta,$id);
        Yii::$app->response->setStatusCode(200);
        return $updateTask;

    }

    public function actionDelete($id)
    {
       $delete_service = new TaskService();
       $delete_service->deleteTask($id);
       Yii::$app->response->setStatusCode(204);
       
    }


}