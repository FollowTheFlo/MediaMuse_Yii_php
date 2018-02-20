<script type="text/javascript">

///////////////////Add sequence////////

$(document).ready(function(){
	  
	  
	 // $('#Slider_flo li').css({ 'width': '300px'});
	  
	  $.fx.speeds._default = 500;
		$(function() {
			$( "#dialog_film_form" ).dialog({
				width: "600px",
				autoOpen: true,
				show: "blind",
				title: "Add project",
				
				
				
				
				
			});
			
			

		});

});
</script>

<div id="dialog_film_form">
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	
	'id'=>'flo-form',
	/*'enableAjaxValidation' => true,*/
'clientOptions' => array(
'validateOnSubmit' => true,
),
'htmlOptions' => array('hideErrorMessage' => true)
)); 

?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>



	<div class="row">
		<?php $model->scope='public';?>
		<?php echo $form->radioButtonList($model,'scope',array('public'=>'public','private'=>'private')); ?>
		<?php echo $form->error($model,'scope'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>100,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('size'=>100,'maxlength'=>400,'rows'=>3,'cols'=>30)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>


	<div class="row buttons">
	
        
      <?php       
     	 $model->id = 0;
		echo $form->hiddenField($model,'id'); ?>
		
     <?php   echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); 
      
      /*
      if(!$model->isNewRecord )
      {
                              
      echo CHtml::ajaxSubmitButton(
	'Edit',
	array('film/Editfilm'),
	array(
		'update'=>'#screen',
	)
		
);


      }
      else 
      {
      	 echo CHtml::ajaxSubmitButton(
	'Save',
	array('film/Addfilm'),
	array(
		'update'=>'#screen',
	));
      	
      	
      	
      }
 
 */
 ?>
                    
    </div>
		
	</div>
	</div>

<?php $this->endWidget(); ?>





