<script type="text/javascript">

///////////////////Add sequence////////

$(document).ready(function(){
	  
	  
	 // $('#Slider_flo li').css({ 'width': '300px'});
	  
	  $.fx.speeds._default = 1000;
		$(function() {
			$( "#dialog_seq_form" ).dialog({
				width: "400px",
				autoOpen: true,
				show: "blind",
				title: "Add sequence",
				
				
				
				
				
			});
			
			

		});

});
</script>


<div id="dialog_seq_form">
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	
	'id'=>'sequence-form',
	/*'enableAjaxValidation' => true,*/
'clientOptions' => array(
'validateOnSubmit' => true,
),
'htmlOptions' => array('hideErrorMessage' => true)
)); 

?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	


	<div class="row">
		<?php 
		$model_film=Film::model()->findByPk($model->film_id);
		echo "New sequence of film : ".$model_film->title; 
		?>
		
		
		</div>

	<div class="row">
		
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'title'); ?>
		
		
		<?php 
		$model->id = 0;
		echo $form->hiddenField($model,'id'); ?>
	</div>

		
	
	


	      <?php       
       echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); 
      /*
      if(!$model->isNewRecord )
      {
                              
      echo CHtml::ajaxSubmitButton(
	'Edit',
	array('sequence/Editsequence'),
	array(
		'update'=>'#screen',
	)
		
);


      }
      else 
      {
      	 echo CHtml::ajaxSubmitButton(
	'Save',
	array('sequence/Addsequence'),
	array(
		'update'=>'#screen',
	));
      	
      	
      	
      }
      */
 
 
 ?>
                    
  
		


<?php $this->endWidget(); ?>
  </div>
  </div>