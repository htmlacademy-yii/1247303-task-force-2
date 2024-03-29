<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "responses".
 *
 * @property int $response_id
 * @property string $add_date
 * @property int $task_id
 * @property int $executor_id
 * @property int $price
 * @property string $description
 * @property int $rejected
 *
 * @property User $executor
 * @property Task $task
 */
class Responses extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'responses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['add_date'], 'safe'],
            [['task_id', 'executor_id', 'price', 'description', 'rejected'], 'required'],
            [['task_id', 'executor_id', 'price', 'rejected'], 'integer'],
            [['description'], 'string'],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::class, 'targetAttribute' => ['task_id' => 'task_id']],
            [['executor_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['executor_id' => 'user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'response_id' => 'Response ID',
            'add_date' => 'Add Date',
            'task_id' => 'Task ID',
            'executor_id' => 'Executor ID',
            'price' => 'Price',
            'description' => 'Description',
            'rejected' => 'RejectedAction',
        ];
    }

    /**
     * Gets query for [[Executor]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getExecutor()
    {
        return $this->hasOne(User::class, ['user_id' => 'executor_id']);
    }

    /**
     * Gets query for [[Task]].
     *
     * @return \yii\db\ActiveQuery|TasksQuery
     */
    public function getTask()
    {
        return $this->hasOne(Task::class, ['task_id' => 'task_id']);
    }

    /**
     * {@inheritdoc}
     * @return ResponsesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ResponsesQuery(get_called_class());
    }
}
