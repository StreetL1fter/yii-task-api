<?php

namespace app\services;
use Yii;
use yii\web\UnprocessableEntityHttpException;
use yii\web\BadRequestHttpException;
use app\models\Task;
use yii\web\ServerErrorHttpException;






class TaskService
{
    
    public function createTask(array $data): Task{
        
    $userrequestid = Yii::$app->request->getHeaders()->get('X-User-ID');
    if($userrequestid === null || $userrequestid === '')
        {
            throw new BadRequestHttpException();
            Yii::$app->response->setStatusCode(404);
        }
    if(!is_numeric($userrequestid)){
        
        throw new BadRequestHttpException("X-User-ID должен быть числом");
    }
    $createtask = new Task();
    $userrequestid = (int)$userrequestid;
    $createtask->user_id = $userrequestid;
    unset($data['user_id']);
    $createtask->attributes = $data;
    if(!$createtask->validate())
        {
            throw new UnprocessableEntityHttpException($createtask->errors);
        }
    $createtask->save();
    return $createtask;

        
    }

    public function updateTask(array $data, int $id): Task
    {
        $userIdFromHeader = Yii::$app->request->getHeaders()->get('X-User-ID');
        if($userIdFromHeader === null || $userIdFromHeader === '')
            {
                throw new BadRequestHttpException();
                Yii::$app->response->setStatusCode(400);
            };
        if(!is_numeric($userIdFromHeader))
            {
                throw new BadRequestHttpException('X-User-ID должен быть числом');
            }
        $modelput = Task::findOne($id);
        if($modelput === null){
            throw new NotFoundHttpException();
        }
        $userIdFromHeader = (int)$userIdFromHeader;
        $owner_id = $modelput->user_id;
        if($userIdFromHeader !== $owner_id)
        {   
            throw new ForbiddenHttpException("Доступ запрещен");
        }
        $modelput->attributes = $data;
        if(!$modelput->validate())
        {
            throw new UnprocessableEntityHttpException($modelput->errors);
        }
        $modelput->save();
        return $modelput;
    }

    public function deleteTask(int $id): Void
    {
        $userfromdeleteid = Yii::$app->request->getHeaders()->get('X-User-ID');
        if($userfromdeleteid === null || $userfromdeleteid === '')
            {
                throw new BadRequestHttpException();
                Yii::$app->response->setStatusCode(400);
            };
        if(!is_numeric($userfromdeleteid))
            {
                throw new BadRequestHttpException('X-User-ID должен быть числом');
            }
        $delete_model = Task::findone($id);
        $userfromdeleteid = (int)$userfromdeleteid;
        if($delete_model === null){
            throw new NotFoundHttpException();
        }
        $owner_delete_id = $delete_model->user_id;
        if($userfromdeleteid !== $owner_delete_id)
        {   
            throw new ForbiddenHttpException("Доступ запрещен");
        }
        $delete_model->delete();
 
    }
}



?>