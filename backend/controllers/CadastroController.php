<?php

namespace backend\controllers;

use Yii;
use common\models\Usuario;
use yii\base\BaseObject;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CadastroController implements the CRUD actions for Usuario model.
 */
class CadastroController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Creates a new Usuario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new \common\models\Usuario();

        if ($model->load(Yii::$app->request->post())) {
            $password = $model->password_hash;

            $model->created_at = time();
            $model->created_by = Yii::$app->user->id;
            $model->auth_key = Yii::$app->security->generateRandomString();
            $model->password_hash = Yii::$app->security->generatePasswordHash($password);

            $model->Foto = UploadedFile::getInstance($model, 'Foto');
            if ($model->Foto!=null){
                $model->Foto->name = $model->username . '.' . $model->Foto->extension;
                $model->Foto->saveAs('fotos/'.$model->Foto->name);
            }

            if ($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('index', [
            'model' => $model,
            $model->password_hash = '',
        ]);
    }

    /**
     * Displays a single Usuario model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the Usuario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Usuario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Usuario::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
