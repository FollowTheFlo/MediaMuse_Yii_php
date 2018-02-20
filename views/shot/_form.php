
 <div class="FilmModule">  



<table id="my_shot_form_table" >

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'shot-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

<tr>
<td>
	<p style="color:sienna;padding-left:20px" class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div style="color:sienna;padding-left:20px" class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		
			<?php echo $form->textArea($model,'description',array('size'=>100,'maxlength'=>400,'rows'=>3,'cols'=>30)); ?>
	
		<?php echo $form->error($model,'title'); ?>
	</div>
</td>
</tr>
<tr>
<td>

	
	<div style="color:sienna;padding-left:20px" class="row">
		<?php echo $form->labelEx($model,'sequence_id'); ?>
		<?php echo $form->textField($model,'sequence_id'); ?>
		<?php echo $form->error($model,'sequence_id'); ?>
	</div>
</td>
</tr>
<tr>
<td>

	<div style="color:sienna;padding-left:20px" class="row">
		<?php echo $form->labelEx($model,'rank'); ?>
		<?php echo $form->textField($model,'rank'); ?>
		<?php echo $form->error($model,'rank'); ?>
	</div>
</td>
</tr>
<tr>
<td>


	
	
	<div style="color:sienna;padding-left:20px" class="row">
		<?php echo $form->labelEx($model,'sketch'); ?>
		<?php echo $form->activeFileField($model, 'sketch'); /*echo $form->textField($model,'sketch');*/ ?>
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
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>
</td>
</tr>
<?php $this->endWidget(); ?>
</table>



<?php 
		//header("Content-type: image/jpg");
		//echo $model->sketch;
		

	
		//CHtml::link(Yii::app()->request->url,array('displaySavedImage','id'=>$model->id)); ?>


</div><!-- form -->