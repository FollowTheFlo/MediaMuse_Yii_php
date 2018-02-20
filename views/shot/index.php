<?php
$this->breadcrumbs=array(
	'Shots',
);

$this->menu=array(
	array('label'=>'Create Shot', 'url'=>array('create')),
	array('label'=>'Manage Shot', 'url'=>array('admin')),
);
?>

<h1>Shots</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
