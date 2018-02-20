






<?php 


$angle_list= array($model->angle=>$model->angle,'N/A'=>'N/A','WIDE'=>'WIDE','VERY WIDE'=>'VERY WIDE','EXTREME WIDE SHOT'=>'EXTREME WIDE SHOT',
'MASTER'=>'MASTER','MEDIUM'=>'MEDIUM','CLOSE UP'=>'CLOSE UP','MEDIUM CLOSE UP'=>'MEDIUM CLOSE UP',
'EXTREM CLOSE UP'=>'EXTREM CLOSE UP','CUTAWAY'=>'CUTAWAY','CUT IN'=>'CUT IN','ZOOM IN'=>'ZOOM IN',
'PAN'=>'PAN','TWO SHOTS'=>'TWO SHOTS','OVER THE SHOULDER'=>'OVER THE SHOULDER','POV'=>'POV',
'MONTAGE'=>'MONTAGE','CGI'=>'CGI','WEATHER SHOT'=>'WEATHER SHOT'
);


$form_id= "shot_form_" . $model->id;
$table_id= "shot_table_" . $model->id;
$submit_btn = "sub".$model->id;
$link_id = "shot_link_".$model->id;

$form=$this->beginWidget('CActiveForm', array(
	
	'id'=>$form_id,
	'enableAjaxValidation' => false,
'htmlOptions' => array('enctype' => 'multipart/form-data')

));  
?>
 <div class="FilmModule">  
 <a name=<?php echo $link_id ?>></a>
<table id='<?php echo $table_id?>' >



<?php if(!$model->isNewRecord ):?>
<tr>


<td align="right"> <img class='btn_cube' onclick="deleteShot(<?php echo $model->id ?>)" src=<?php echo Yii::app()->baseUrl.'/images/delete_cross.png'?> alt="Delete film" />
</td>
</tr>
<?php endif;?>
<tr>
<td colspan="4">

<tr>
<td>
	<p style="color:sienna;padding-left:20px" class="note">Fields with <span class="required">*</span> are required.</p>

<?php echo "id is ".$model->id; ?>
	<?php echo $form->errorSummary($model); ?>
	
	<div style="color:sienna;padding-left:20px" class="row">
		<?php echo $form->labelEx($model,'angle'); ?>
			<?php echo $form->dropDownList($model,'angle', $angle_list); ?>
		<?php echo $form->error($model,'angle'); ?>
	</div>

	<div style="color:sienna;padding-left:20px" class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		
		<?php echo $form->textArea($model,'title',array('size'=>100,'maxlength'=>400,'rows'=>3,'cols'=>30)); ?>
	
		<?php echo $form->error($model,'title'); ?>
	</div>
	
</td>
</tr>
<tr>
<td>

	
	
		
		<?php echo "Rank: ".$model->rank ?>;
		<?php echo $form->hiddenField($model,'sequence_id'); ?>
		
		
	
</td>
</tr>
<tr>

</tr>
<tr>
<td>


	
	
	<div style="color:sienna;padding-left:20px" class="row">
		<?php echo $form->labelEx($model,'sketch'); ?>
		<?php $file_name = $form->fileField($model,'sketch', array('class'=>'input-file')) ?>
		<?php echo $file_name?>
		<?php echo $form->error($model,'sketch'); ?>
		

		 
	</div>
	
</td>
</tr>
<tr>
<td>	
	<?php 
		$dbImage = $this->createUrl('shot/displaySavedImage',array('id'=>$model->id)); 
     echo CHtml::image($dbImage,'image',array("width"=>250 , "height"=>200));
	?>
</td>
</tr>
<tr>
<td>
<div style="color:sienna;padding-left:20px" class="row buttons">
		<?php /*echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save');*/ 
		
		      
      echo $form->hiddenField($model,'rank');
      echo $form->hiddenField($model,'id');
      
      if($model->isNewRecord )
      {
      	$model->id = 0;
       	echo "<input type='submit' value='Save' name='".$submit_btn."'>";
    	
		
      }
      else 
      {
      	echo "<input type='submit' value='Edit' name='".$submit_btn."'>";
      	     	
      }		
		
		?>
	</div>
</td>
</tr>
</table>
</div>
<?php $this->endWidget(); ?>

