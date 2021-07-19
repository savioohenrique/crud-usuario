<?php

namespace backend\controllers;

use phpDocumentor\Reflection\Types\String_;
use Yii;
use common\models\Usuario;
use backend\models\UsuarioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * UsuarioController implements the CRUD actions for Usuario model.
 */
class UsuarioController extends Controller
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
     * Lists all Usuario models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsuarioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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
     * Creates a new Usuario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Usuario();

        if ($model->load(Yii::$app->request->post())) {
            $password = $model->password_hash;

            $model->created_at = time();
            $model->created_by = Yii::$app->user->id;
            $model->auth_key = Yii::$app->security->generateRandomString();
            $model->password_hash = Yii::$app->security->generatePasswordHash($password);

            $model->Foto = UploadedFile::getInstance($model, 'Foto');
            if ($model->Foto!=null){
                $model->Foto->name = $model->username . '-' . $model->id.'.'.$model->Foto->extension;
                $model->Foto->saveAs('fotos/'.$model->Foto->name);
            }

            if ($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            $model->password_hash = '',
        ]);
    }

    /**
     * Updates an existing Usuario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $password = $model->password_hash;

            $model->updated_at = time();
            $model->updated_by = Yii::$app->user->id;
            $model->auth_key = Yii::$app->security->generateRandomString();
            $model->password_hash = Yii::$app->security->generatePasswordHash($password);

            $model->Foto = UploadedFile::getInstance($model, 'Foto');
            if ($model->Foto!=null){
                $model->Foto->name = $model->username . '-' . $model->id.'.'.$model->Foto->extension;
                $model->Foto->saveAs('fotos/'.$model->Foto->name);
            }

            if ($model->save()){
                if ($model->id == Yii::$app->user->id) {
                    return $this->redirect('/site/index');
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            $model->password_hash = '',
        ]);
    }

    /**
     * Deletes an existing Usuario model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
