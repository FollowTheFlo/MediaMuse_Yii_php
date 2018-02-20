<?php
$this->breadcrumbs=array(
	'Shots'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Shot', 'url'=>array('index')),
	array('label'=>'Create Shot', 'url'=>array('create')),
	array('label'=>'View Shot', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Shot', 'url'=>array('admin')),
);
?>

<h1>Update Shot <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>