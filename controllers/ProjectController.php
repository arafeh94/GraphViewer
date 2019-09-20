<?php

namespace app\controllers;

use app\components\Tools;
use app\models\forms\LoginForm;
use app\models\Project;
use app\models\ProjectAuthors;
use app\models\ProjectQuery;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;

class ProjectController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['view', 'index'],
                        'allow' => true,
                        'roles' => ['?', '@'],
                    ],
                    [
                        'actions' => ['create', 'update'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->redirect(['project/view']);
    }

    public function actionView($focus = null)
    {
        return $this->render('view', [
            'projects' => Project::find()->with('graphs')->with('authors')->all(),
            'focus' => $focus,
        ]);
    }

    public function actionCreate()
    {
        $model = new Project();
        $request = Yii::$app->request;
        if ($request->post("Project", false)) {
            $model->load($request->post());
            if ($model->save()) {
                if ($request->post('DynamicModel', false)) {
                    foreach ($request->post('DynamicModel')['authors'] as $author_id) {
                        $projectAuthor = new ProjectAuthors();
                        $projectAuthor->project_id = $model->id;
                        $projectAuthor->author_id = $author_id;
                        $projectAuthor->save();
                    }
                }
                $this->redirect(['project/view']);
            }
        }

        return $this->render('modify', [
            'model' => $model
        ]);
    }

    public function actionUpdate($id)
    {
        $model = Project::find()->where(['id' => $id])->one();
        $request = Yii::$app->request;
        if ($request->post("Project", false)) {
            $model->load($request->post());
            if ($model->save()) {
                if ($request->post('DynamicModel', false)) {
                    foreach ($request->post('DynamicModel')['authors'] as $author_id) {
                        $projectAuthor = new ProjectAuthors();
                        $projectAuthor->project_id = $model->id;
                        $projectAuthor->author_id = $author_id;
                        $projectAuthor->save();
                    }
                }
                $this->redirect(['project/view']);
            }
        }

        return $this->render('modify', [
            'model' => $model
        ]);
    }

}
