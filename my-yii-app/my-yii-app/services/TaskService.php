<?php

namespace app\services;
use yii\web\UnprocessableEntityHttpException;
use app\models\Task;
use yii\web\ServerErrorHttpException;




class TaskService
{
    
    public function createTask(array $data): Task{
        
        $createtask = new Task();
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
        $modelput = Task::findOne($id);
        if($modelput !== null){
            $modelput->attributes = $data_update;
        }else{
            throw new NotFoundHttpException();
        }
        if(!$modelput->validate())
        {
            throw new UnprocessableEntityHttpException($modelput->errors);
        }
        $modelput->save();
        if(!$modelput->save()){
            throw new ServerErrorHttpException('Не удалось обновить задачу');
        }
        return $modelput;

        

    }

    public function deleteTask(int $id): Void
    {
        $delete_model = Task::findone($id);
        if(!$delete_model){
            throw new NotFoundHttpException();
        }
        $delete_model->delete();
        
    }
}



?>