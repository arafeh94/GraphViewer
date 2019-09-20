<?php

namespace app\controllers;

use app\components\Matlab;
use app\components\Tools;
use app\models\Author;
use app\models\forms\LoginForm;
use app\models\forms\UploadForm;
use app\models\Graph;
use app\models\Project;
use app\models\ProjectQuery;
use Yii;
use yii\base\InlineAction;
use yii\data\ActiveDataProvider;
use yii\db\StaleObjectException;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\web\ViewAction;

class AuthorController extends Controller
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
                        'allow' => true,
                        'roles' => ['?', '@'],
                    ],
                    [
                        'actions' => ['update', 'create', 'delete'],
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
        $dataProvider = new ActiveDataProvider([
            'query' => Author::find(),
            'pagination' => false
        ]);
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionView($id)
    {
        $author = Author::find()->one($id);
        return $this->render('view', [
            'model' => $author
        ]);
    }

    public function actionCreate()
    {
        $model = new Author();
        if (Yii::$app->request->post('Author', false)) {
            $model->load(Yii::$app->request->post());
            if ($model->save()) $this->redirect(['author/index']);
        }
        return $this->render('create', [
            'model' => $model
        ]);
    }

    public function actionUpdate($id)
    {
        $model = Author::findOne($id);
        $request = Yii::$app->request;
        if ($request->post("Author", false)) {
            $model->load(Yii::$app->request->post());
            if ($model->save()) $this->redirect(['author/index']);
        }
        return $this->render('modify', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $model = Author::findOne($id);
        if (Author::find()->hasProjects($model->id)) {
            return $this->redirect(['author/index', 'error' => "author can't be deleted"]);
        } else {
            try {
                $model->delete();
            } catch (StaleObjectException $e) {
            } catch (\Throwable $e) {
            }
            return $this->redirect(['author/index']);
        }
    }


}
