<?php

namespace app\modules\admin\controllers;

use app\models\Category;
use app\models\imageUploader;
use app\models\Tag;
use Yii;
use app\models\Article;
use app\models\ArticleSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Article model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = Article::findOne($id);
        $tagsString = $model->getTagsString();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'tags' => $tagsString,
        ]);
    }

    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Article();

        $categories = Category::getCategoriesArray();
        $tags = Tag::getTagsArray();

        $imageUploader = new ImageUploader();

        $request = Yii::$app->request;

        if ($model->load($request->post()) && $model->save()) {

            $imageUploader->imageFile = UploadedFile::getInstance($imageUploader, 'imageFile');
            $imageUploader->lastImageFile = $model->image;

            $selectedCategory = $request->post('category');
            $selectedTags = $request->post('tags');

            $model->saveCategory($selectedCategory);
            $model->saveTags($selectedTags);

            $imageUploader->upload();
            $model->saveImage($imageUploader->imageFile);

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'imageUploader' => $imageUploader,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $selectedCategory = $model->getSelectedCategoryId();
        $categories = Category::getCategoriesArray();

        $selectedTags = $model->getSelectedTagsIds();
        $tags = Tag::getTagsArray();

        $request = Yii::$app->request;
        $imageUploader = new ImageUploader();

        if ($model->load($request->post()) && $model->save()) {

            $imageUploader->imageFile = UploadedFile::getInstance($imageUploader, 'imageFile');
            $imageUploader->lastImageFile = $model->image;

            $selectedCategory = $request->post('category');
            $selectedTags = $request->post('tags');

            $model->saveCategory($selectedCategory);

            $model->saveTags($selectedTags);

            $imageUploader->upload();
            $model->saveImage($imageUploader->imageFile);


            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'imageUploader' => $imageUploader,
            'selectedCategory' => $selectedCategory,
            'categories' => $categories,
            'tags' => $tags,
            'selectedTags' => $selectedTags,
        ]);
    }

    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        $imageUploader = new ImageUploader();
        $imageUploader->deleteImage($model->image);

        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
