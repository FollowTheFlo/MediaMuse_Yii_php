<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>80)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sketch'); ?>
		<?php echo $form->textField($model,'sketch'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sequence_id'); ?>
		<?php echo $form->textField($model,'sequence_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rank'); ?>
		<?php echo $form->textField($model,'rank'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->