<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project_authors".
 *
 * @property int $id
 * @property int $project_id
 * @property int $author_id
 */
class ProjectAuthors extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_authors';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'author_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'project_id' => Yii::t('app', 'Project ID'),
            'author_id' => Yii::t('app', 'Author ID'),
        ];
    }
}
