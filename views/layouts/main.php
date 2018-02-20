<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/fileuploader.css" />
	<link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>favicon.ico" type="images/favicon.ico" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>


<div class="container">
<div id="page">

	<div class="span-40" >
	
	<div class="span-10" id="big_button_menu">
	
<div class="celtx_menu">	
<table id="big_buttons">

<?php 
 $wall_url= Yii::app()->baseUrl."/index.php/film/wall/";
 $project_url= Yii::app()->baseUrl."/index.php/user/1/";
    	
?>

<tr>
<td  ><a href=<?php echo $wall_url?>><img class='btn_player' src=<?php echo Yii::app()->baseUrl.'/images/big_icons/movie_folder.png'?> height="80" width="80" alt="Create film" /></a></td>
<td  ><a href=<?php echo $project_url?>><img class='btn_player' src=<?php echo Yii::app()->baseUrl.'/images/big_icons/cinema_director.png'?> height="80" width="80" alt="Delete film" /></a></td>
</tr>
</table>
</div>
	

	
	</div>
	
	<div class="span-20" id="nice_title">
	<h1>ONLINE STUDIO</h1>
	</div>
	
	<div class="span-10-last" id="login_menu">
	
	<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'inlineForm',
    'type'=>'inline',
    'htmlOptions'=>array('class'=>'well'),
)); ?>
 

<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'icon'=>'arrow-right', 'label'=>'Log in')); ?>
 
<?php $this->endWidget(); ?>

</div>
    
		
	</div><!-- header -->

	<div class="span-40" id="mainmenu">

	
	<?php echo $content; ?>
		
	

	<div class="span-40" id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by F.Letendre, NUIG.<br/>
		Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

	</div><!-- page -->
</div>
</div>

</body>
</html>
