<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "graph".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $default_input
 * @property string $mfile
 * @property int $created_by
 * @property int $project_id
 * @property string $created_at
 */
class Graph extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'graph';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'mfile'], 'required'],
            [['created_by', 'project_id'], 'integer'],
            [['created_at'], 'safe'],
            [['description'], 'string', 'max' => 255],
            [['title'], 'string', 'max' => 255],
            [['default_input'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'mfile' => Yii::t('app', 'Matlab File'),
            'created_by' => Yii::t('app', 'Created By'),
            'project_id' => Yii::t('app', 'Project ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'default_input' => Yii::t('app', 'Default Input'),
        ];
    }

    /**
     * @inheritdoc
     * @return GraphQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GraphQuery(get_called_class());
    }
}
