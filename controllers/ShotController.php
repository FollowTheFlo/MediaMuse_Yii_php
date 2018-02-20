<?php

class ShotController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
				'actions'=>array('index','view','showshot','displaySavedImage','editshot','addshot','upload','delete','UpdateOrderDraggableShot'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin'),
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	
	public function actionShowshot($id)
	{
		$model=$this->loadModel($id);
		
		
		$this->renderPartial('_form',array(
			'model'=>$model,
		));
		
		/*
		$this->renderPartial('sequence_cube',array(
			'sequences'=>$model->sequences,
			'film'=>$model,
		));
		
		*/
		
		
		//echo CHtml::encode(print_r($_POST, true));
		//Yii :: app()->end();
	}

public function actionDisplaySavedImage()
{
    $model=$this->loadModel($_GET['id']);
 
        header('Content-type: image/jpg');
        echo $model->sketch;
        
        return;
}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($id,$seq_id)
	{
		$model=new Shot;
		$user=User::model()->findByPk($id);
		$selected_sequence=Sequence::model()->findByPk($seq_id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Shot']))
		{
			$model->attributes=$_POST['Shot'];
			if($model->save())
			{
				$film_id = $selected_sequence->film_id;
				$this->redirect(array('//user/dashboard','id'=>$user->id,'film_id'=>$film_id));
			}
		}

		$this->render('create',array(
			'user'=>$user,
			'selected_seq'=>$selected_sequence,
		));
	}
	
public function actionEditshot($id=null)
	{
		
		$model=new Shot;
		//$this->performAjaxValidation($model);
		print_r($_POST);
		if(isset($_POST['Shot']))
		{
			//$model=$this->loadModel($_POST['Shot']['id']);
			//echo $model->sketch;
			
			$model->attributes=$_POST['Shot'];
			//$model->sketch= CUploadedFile::getInstance($model,'sketch');
			//echo CUploadedFile::getError();
			//$file=CUploadedFile::getInstanceByName($_POST['Shot']['sketch']);
                       /* if(!$file->getHasError()) {
                                $model->filename=$file->getName(); 
                                $model->mime_type=$file->getType();
                                $model->file_size=$file->getSize();
                                $model->file_data=file_get_contents($file->tempName);
                        }*/
			
			//echo $model->sketch;
			if($model->save())
				{
					echo "Shot saved!!";					
					//$this->renderPartialWithHisOwnClientScript('_poster',array('model'=>$model),false,true);
				}
				else 
				{
					echo "Error:". $model->getErrors();
					
				}
		}else 
		{
			$model=$this->loadModel($id);
			$this->renderPartialWithHisOwnClientScript('_form',array(
				'model'=>$model,false,true
			));
		}
	}
	
public function actionAddshot()
	{
		$model=new Shot;
		//$this->performAjaxValidation($model);
		
		if(isset($_POST['Shot']))
		{
			//$model=$this->loadModel($_POST['Shot']['id']);
			echo "Test";
			//$model=new Film;
			$model->attributes=$_POST['Shot'];
			
			if($model->save())
			{
				//$this->redirect(array('view','id'=>$model->id));
				$this->renderPartialWithHisOwnClientScript('_poster',array(
			'model'=>$this->loadModel($model->$id),false,true
		));
			}
		}
		else
		{
		
		
		//$model=$this->loadModel($id);
			$this->renderPartialWithHisOwnClientScript('_form',array(
				'model'=>$model,false,true
			));
		}
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

		if(isset($_POST['Shot']))
		{
			$model->attributes=$_POST['Shot'];
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
	public function actionDelete($shot_id)
	{
		
			// we only allow deletion via POST request
			$user=User::model()->findByPk(1);
			$shot=Shot::model()->findByPk($shot_id);
			$sequence= Sequence::model()->findByPk($shot->sequence_id);
			
			$this->loadModel($shot_id)->delete();
			/*
			$this->render('//sequence/view',array(
			'user'=>$user,
			'selected_seq'=>$sequence,
			));*/
			$this->reorderShotRank($sequence->id);
			
			$this->redirect(array('//sequence/View/id/'.$user->id.'/seq_id/'.$sequence->id));
		
			
			
/*
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	*/
	}
	
public function reorderShotRank($seq_id)
	{
		
		$sequence_entity= Sequence::model()->findByPk($seq_id);
		$shot_list = $sequence_entity->shots(array('order'=>'rank ASC'));
		
		$index=0;
		foreach($shot_list as $shot)
    	{
    		$shot->rank = ++$index;
	    	if ($shot->validate())
		          	{
					
						if($shot->save())
						{
							
							//$this->renderPartialWithHisOwnClientScript('_poster',array('model'=>$model),false,true);
						}
						else 
						{
							echo "Error in update:". $shot->getErrors();
							
						}
	            
					}
	    		
	    	}
		
	}
	
	
public function actionUpdateOrderDraggableShot()
{
	if(isset($_POST['shotOrder']))
		{
			//echo $_POST['shotOrder'];
			$shotOrder_string = $_POST['shotOrder'];
			
			$shotOrder_list = explode("," , $shotOrder_string);
		
			$index=0;
			$seq_id;
			foreach($shotOrder_list as $shot_id)
			{
				//receive value as 'shot_2', so remove the first 5 char
				$shot_id = substr($shot_id,5);
				$model=$this->loadModel($shot_id);
				$model->rank=++$index;
				$seq_id=$model->sequence_id;
				
				if ($model->validate())
		        {
					
					if($model->save())
					{
												
							//$this->renderPartialWithHisOwnClientScript('_poster',array('model'=>$model),false,true);
					}
					else 
					{
						echo "Error in update:". $model->getErrors();
							
					}
	            
				}
	    		
	    	}
	    	
	    	$sequence = Sequence::model()->findByPk($seq_id);
	    	$film = Film::model()->findByPk($sequence->film_id);
	    	
	    	$this->renderPartialWithHisOwnClientScript('//user/sequence_menu',array(
							'film'=>$film,false,true
						));					
								
		}
		
		else 
		{
			echo "Ajax failed";
		}

}	

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Shot');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Shot('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Shot']))
			$model->attributes=$_GET['Shot'];

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
		$model=Shot::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='shot-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
public function actionUpload()
{
        Yii::import("ext.EAjaxUpload.qqFileUploader");
 
        $folder='upload/';// folder for uploaded files
        $allowedExtensions = array("jpg","jpeg","gif");//array("jpg","jpeg","gif","exe","mov" and etc...
        $sizeLimit = 10 * 1024 * 1024;// maximum file size in bytes
        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload($folder);
        $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
 
        $fileSize=filesize($folder.$result['filename']);//GETTING FILE SIZE
        $fileName=$result['filename'];//GETTING FILE NAME
        
        echo  $fileSize;
        echo  $fileName;
 
        echo $return;// it's array
}
}
