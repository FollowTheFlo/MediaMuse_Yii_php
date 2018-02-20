<?php

class FilmController extends Controller
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
				'actions'=>array('index','view','showfilm','addfilm','editfilm','testfilm','showsequences','create','loadStoryboard','wall','IncrementView'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('update'),
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
		
		$this->renderPartialWithHisOwnClientScript('view',array(
			'model'=>$this->loadModel($id),
		));
		
		
		$this->renderPartial('_poster',array(
			'model'=>$this->loadModel($id),
		));
	}
	
	public function actionShowfilm($id)
	{
		$model=$this->loadModel($id);
		
		
		$this->renderPartial('_poster',array(
			'model'=>$this->loadModel($id),
		), false, false);
		
		/*
		$this->renderPartial('sequence_cube',array(
			'sequences'=>$model->sequences,
			'film'=>$model,
		));
		
		*/
		
		
		//echo CHtml::encode(print_r($_POST, true));
		//Yii :: app()->end();
	}
	
public function actionShowSequences($id)
	{
		$model=$this->loadModel($id);
		
		/*
		$this->renderPartial('_poster',array(
			'model'=>$this->loadModel($id),
		));*/
		//Yii::app()->clientScript->registerCoreScript('jquery');
		
		$this->renderPartialWithHisOwnClientScript('sequence_cube',array(
			'sequences'=>$model->sequences,
			'film'=>$model,
		));
		
		
		//echo CHtml::encode(print_r($_POST, true));
		//Yii :: app()->end();
	}
	
public function actionTestfilm()
	{
		
		
		
		echo CHtml::encode(print_r($_POST, true));
		//Yii :: app()->end();
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		
		$id=1;
		$model=new Film;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$user=User::model()->findByPk($id);
		if(isset($_POST['Film']))
		{
			
			$model->attributes=$_POST['Film'];
			$model->created_date = date('Y-m-d H:i:s');
			$model->view = 0;
			
			
			if($model->save())
			{
				$this->redirect(array('//user/dashboard','id'=>$user->id,'film_id'=>$model->id));
				/*$this->render('//user/dashboard',array(
			'model'=>$user,
			'selected_film'=>$model,
		));*/
			
			}
		}
		else
		{
		
			$this->renderPartial('create',array('user'=>$user,'model'=>$model),false,true);
		}
	}
	
public function actionAddfilm()
	{
		

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$user=User::model()->findByPk(1);
		if(isset($_POST['Film']))
		{
			$target_id=$_POST['Film']['id'];
			if($target_id==0)
			{
				$target_id=null;
				$model=new Film;
			
				$model->attributes=$_POST['Film'];
				
				
				
				//echo "scope is ".$model->scope;
				//printf($_POST['Film']);
				$model->user_id = $user->id;
				$model->created_date = date('Y-m-d H:i:s');
				$model->view = 0;
				//$model->id = 50;
				
				if ($model->validate())
	            {
					if($model->save())
					{
						$last_id = Yii::app()->db->getLastInsertID();
						$this->redirect(array('//user/dashboard','id'=>$user->id,'film_id'=>$last_id));
						//$this->renderPartialWithHisOwnClientScript('_poster',array('model'=>$model),false,true);
					}else 
						{
							echo "Error in new :". $model->getErrors();
							
						}
						
				}
				else {echo "not validate";}
			}
			
			else 
			{
				//update
				$model=Film::model()->findByPk($target_id);
				
				$model->title=$_POST['Film']['title'];
				$model->description=$_POST['Film']['description'];
				$model->user_id = $user->id;
			
			}
			
		}
		else
		{
		$model=new Film;
		$this->renderPartialWithHisOwnClientScript('_form',array(
				'model'=>$model,false,true
			));
		}
		
		//$this->performAjaxValidation($model);
		
	}
	
	
public function actionEditfilm($id=null)
	{
		
		if(isset($_POST['Film']))
		{
			$model=$this->loadModel($_POST['Film']['id']);
			echo "Test";
			//$model=new Film;
			$model->attributes=$_POST['Film'];
			if($model->save())
				{
										
					$this->renderPartialWithHisOwnClientScript('_poster',array('model'=>$model),false,true);
				}
		}else 
		{
			$model=$this->loadModel($id);
			$this->renderPartialWithHisOwnClientScript('_form',array(
				'model'=>$model),false,true
			);
		}
	}
	
public function actionWall()
{
	//$sql='SELECT * FROM {{film}}';
	//$users=$connection->createCommand($sql)->queryAll();
	$user=User::model()->findByPk(1);
	
	$films = Yii::app()->db->createCommand(array(
	    'select' => '*',
	    'from' => 'film',
	    'where' => 'Scope="private"',
	   
	))->query();

	$this->render('//film/wall',array(
				'films'=>$films,
				'user'=>$user)
			);

}

public function actionIncrementView()
{
	if(isset($_POST['film_id']))
	{
		
		$model=Film::model()->findByPk($_POST['film_id']);
		$view_num = $model->view;
		$view_num++;
		$model->view = $view_num;
		
		if($model->save())
		{
			echo "saved";
					/*
					$this->renderPartialWithHisOwnClientScript('//post/popup',array(
				     
				    ), false, false);
				    */
		}
		else 
		{
			echo "save problem";
		}
				
	}

}
	
public function actionLoadStoryboard()
{
	
	if(isset($_POST['film_id']))
		{
			$model=$this->loadModel($_POST['film_id']);
			
			$this->renderPartialWithHisOwnClientScript('//film/storyboard',array(
				'film'=>$model
			),false,true);
		}
		else 
		{
			echo "ajax error";
		}
		
	/*$this->render('//film/storyboard',array(
				'film_id'=>$film_id
			));
			*/

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

		if(isset($_POST['Film']))
		{
			$model->attributes=$_POST['Film'];
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
		$dataProvider=new CActiveDataProvider('Film');
		$this->render('dashboard',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Film('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_POST['Film']))
			$model->attributes=$_POST['Film'];

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
		$model=Film::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='film-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
