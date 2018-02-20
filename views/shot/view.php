<?php
$this->breadcrumbs=array(
	'Shots'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Shot', 'url'=>array('index')),
	array('label'=>'Create Shot', 'url'=>array('create')),
	array('label'=>'Update Shot', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Shot', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Shot', 'url'=>array('admin')),
);
?>

<h1>View Shot #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'sketch',
		'sequence_id',
		'rank',
	),
)); ?>
