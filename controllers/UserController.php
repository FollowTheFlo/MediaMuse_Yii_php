<?php

class UserController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/main';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','dashboard','refreshfilms','showfilm'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		
		$user = $this->loadModel($id);
		
		$this->render('//user/hall',array(
			'user'=>$user,
		));
	}
	
public function actionDashboard($id,$film_id)
{
		$user = $this->loadModel($id);
		$film_model=Film::model()->findByPk($film_id);
		//$film = Model::Film->$this->loadModel($film_id);
		//$film = $this->createFilm($user);
		
		$this->render('dashboard',array(
			'model'=>$user,
			'selected_film'=>$film_model,
		));
	}
	

	

public function actionRefreshfilms($id)
	{		
		Yii::app()->clientScript->scriptMap['*.js'] = false;
                
		$user = $this->loadModel($id);
		$this->renderPartial('_films',array(
      'films'=>$user->films,
    ));
    Yii::app()->clientScript->scriptMap['*.js'] = false;
		
		
	}
	
public function actionShowformfilm($id)
	{		
                Yii::app()->clientScript->scriptMap['*.js'] = false;
		$user = $this->loadModel($id);
		$this->renderPartial('film/formfilms',array(
      'films'=>$user->films,
    ));
    
		
		Yii::app()->clientScript->scriptMap['*.js'] = false;
	}
	
public function actionShowfilm($id)
	{
		$model=Film::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
			
		$this->renderPartial('//film/_poster',array(
			'model'=>$model,
		));
	}
	

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new User;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	
protected function createFilm($user)
	{
		$film=new Film;  
		if(isset($_POST['Film']))
		{
			$film->attributes=$_POST['Film'];
			if($user->addFilm($film))
			{
				Yii::app()->user->setFlash('filmSubmitted',"Your film has been added." );
				$this->refresh();
			}
		}
		return $film;
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('User');
		$this->render('dashboard',array(
			'dataProvider'=>$dataProvider,
		));
	}
	

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
