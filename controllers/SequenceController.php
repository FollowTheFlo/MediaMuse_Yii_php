<?php

class SequenceController extends Controller
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
			'accessControl' // perform access control for CRUD operations
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
				'actions'=>array('index','view','showshots','showShotsMosaic','addsequence','create','delete','updateOrderDraggableSequence'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('update'),
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

	
	public function reorderSequenceRank($film_id)
	{
		$film_entity= Film::model()->findByPk($film_id);
		$sequence_list = $film_entity->sequences(array('order'=>'rank ASC'));
		
		$index=0;
		foreach($sequence_list as $sequence)
    	{
    		$sequence->rank = ++$index;
	    	if ($sequence->validate())
		          	{
					
						if($sequence->save())
						{
							//echo "Shot updated!!";					
							//$this->renderPartialWithHisOwnClientScript('_poster',array('model'=>$model),false,true);
						}
						else 
						{
							echo "Error in update:". $sequence->getErrors();
							
						}
	            
					}
	    			
	    	}
	
	}
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id,$seq_id)
	{
		
    
		
		if(isset($_POST['Shot']))
		{
			$target_id = $_POST['Shot']['id'];
			
		
			if($target_id==0)
			{
				//new shot
				
				
				$model = new shot;
				
				$max_rank = Yii::app()->db->createCommand()
			    ->select('max(rank) as max')
			    ->from('shot')
			    ->where('sequence_id='.$seq_id)
			    ->queryScalar();
		    
		
		    
				//print_r($_FILES);
				//$model = Shot::model();
				$model->attributes=$_POST['Shot'];
				$model->rank=$max_rank+1;
				$model->sketch=CUploadedFile::getInstance($model,'sketch');
				$model->sequence_id=$seq_id;
				$model->created_date = date('Y-m-d H:i:s');
				
								
				
			
				//echo $model->sketch;
				if ($model->validate())
	            {
				
					if($model->save())
					{
										
						//$this->renderPartialWithHisOwnClientScript('_poster',array('model'=>$model),false,true);
					}
					else 
					{
						echo "Error in new :". $model->getErrors();
						
					}
	            }
            
			}
			else 
			{
				//update
				$model=Shot::model()->findByPk($target_id);
				//$selected_film=Film::model()->findByPk($film_id);
		
				// Uncomment the following line if AJAX validation is needed
				// $this->performAjaxValidation($model);
				
				$original_sketch = $model->sketch;
				
			
		
				
					$model->attributes=$_POST['Shot'];
					$model->sketch=CUploadedFile::getInstance($model,'sketch');
					$model->last_modified_date = date('Y-m-d H:i:s');
					
					if(!$model->sketch)
					{
						$model->sketch = $original_sketch;
					}
			
			
			
				if ($model->validate())
	            {
				
					if($model->save())
					{
						//echo "Shot updated!!";					
						//$this->renderPartialWithHisOwnClientScript('_poster',array('model'=>$model),false,true);
					}
					else 
					{
						echo "Error in update:". $model->getErrors();
						
					}
            
				}
			}
			
			
			
			
		}
		
		$user=User::model()->findByPk($id);
		$selected_sequence=Sequence::model()->findByPk($seq_id);
		
		$this->render('//sequence/view',array(
			'user'=>$user,
			'selected_seq'=>$selected_sequence,
		));
		
	}
	
public function actionShowshots($id)
	{
		$model=$this->loadModel($id);
		
		/*
		$this->renderPartial('_poster',array(
			'model'=>$this->loadModel($id),
		));*/
		
		$this->renderPartialWithHisOwnClientScript('shot_cube',array(
			'shots'=>$model->shots,
			'sequence'=>$model,
		));
		
		
		//echo CHtml::encode(print_r($_POST, true));
		//Yii :: app()->end();
	}
	
public function actionUpdateOrderDraggableSequence()
{
	if(isset($_POST['seqOrder']))
		{
		
			
			$seqOrder_string = $_POST['seqOrder'];
			
			$seqOrder_list = explode("," , $seqOrder_string);
		
			$index=0;
			$sequence_id;
			foreach($seqOrder_list as $seq_id)
			{
				
				//receive value as 'seq_2', so remove the first 4 char
				$seq_id = substr($seq_id,4);
				$model=$this->loadModel($seq_id);
				$model->rank=++$index;
				
				$sequence_id=$seq_id;
				
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
				else
				{
					
				}
	    		
	    	}
	    	
	    	
	    	$sequence = Sequence::model()->findByPk($sequence_id);
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
	
public function actionShowShotsMosaic($id)
	{
		$model=$this->loadModel($id);
		
		/*
		$this->renderPartial('_poster',array(
			'model'=>$this->loadModel($id),
		));*/
		
		$this->renderPartialWithHisOwnClientScript('sequence_panel',array(
			'shots'=>$model->shots,
			
		), false, true);
		
		
		//echo CHtml::encode(print_r($_POST, true));
		//Yii :: app()->end();
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($id,$film_id)
	{
		$model=new Sequence;
		$user=User::model()->findByPk($id);
		$selected_film=Film::model()->findByPk($film_id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Sequence']))
		{
			$model->attributes=$_POST['Sequence'];
		if($model->save())
			{
				$this->redirect(array('//user/dashboard','id'=>$user->id,'film_id'=>$model->film_id));
				/*$this->render('//user/dashboard',array(
			'model'=>$user,
			'selected_film'=>$model,
		));*/
			
			}
		}
		else
		{

			$this->render('create',array('user'=>$user,'selected_film'=>$selected_film,'model'=>$model),false,true);
			
	
		}
		
		/*
		$model=new Sequence;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Sequence']))
		{
			$model->attributes=$_POST['Sequence'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));*/
	}

	public function actionAddsequence($film_id)
	{
		$model=new Sequence;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Sequence']))
		{
				$max_rank = Yii::app()->db->createCommand()
	    ->select('max(rank) as max')
	    ->from('sequence')
	    ->where('film_id='.$film_id)
	    ->queryScalar();
	    
	    
			$model->attributes=$_POST['Sequence'];
			$model->rank = $max_rank+1;
			$model->film_id = $film_id;
			$model->created_date = date('Y-m-d H:i:s');
			
		
			
			if ($model->validate())
            {
          		 
            	
				if($model->save())
				{
					//we display film poster which shows all sequences
					//$user=User::model()->findByPk(1);
					
					$last_id = Yii::app()->db->getLastInsertID(); 
					//$this->renderPartialWithHisOwnClientScript('film/_poster',array('model'=>$model_film));
					//$this->redirect(array('//user/dashboard','id'=>$user->id,'film_id'=>$film_id));
					$this->redirect(array('//sequence/View/id/1/seq_id/'.$last_id));
					
				}
				else{
					echo "not save";
				}
            }
		}
		else
		{
		$model->film_id=$film_id;
		$this->renderPartial('_form',array(
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

		if(isset($_POST['Sequence']))
		{
			$model->attributes=$_POST['Sequence'];
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
	public function actionDelete($seq_id)
	{
		
			
			$user=User::model()->findByPk(1);
			//$shot=Shot::model()->findByPk($shot_id);
			//$sequence= Sequence::model()->findByPk($seq_id);
			
			$model = $this->loadModel($seq_id);
			$film_id = $model->film_id;
			
			$model->delete();
			
			$this->reorderSequenceRank($film_id);

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			//if(!isset($_GET['ajax']))
			//	$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
			$this->redirect(array('//user/dashboard/id/'.$user->id.'/film_id/'.$film_id));
		
				
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Sequence');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Sequence('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Sequence']))
			$model->attributes=$_GET['Sequence'];

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
		$model=Sequence::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='sequence-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
