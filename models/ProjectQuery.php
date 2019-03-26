<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Project]].
 *
 * @see Graph
 */
class ProjectQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Graph[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Graph|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
