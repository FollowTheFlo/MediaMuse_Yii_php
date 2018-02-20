<?php
$this->breadcrumbs=array(
	'Films'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Film', 'url'=>array('index')),
	array('label'=>'Create Film', 'url'=>array('create')),
	array('label'=>'Update Film', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Film', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Film', 'url'=>array('admin')),
);
?>

<h1>View Film #<?php echo $model->title; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'description',
		'user_id',
	),
)); ?>
