<?php /*
$this->breadcrumbs=array(
	'Films'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Film', 'url'=>array('index')),
	array('label'=>'Manage Film', 'url'=>array('admin')),
);
*/
?>

<h1>Create Film</h1>



<?php /* echo $this->renderPartial('_form', array('model'=>$model)); */ ?>








<div id="films">

<div class="span-40" id="maincontent">

		<div class="span-10" id="leftcontent">
	<?php $this->renderPartialWithHisOwnClientScript('//user/player',array(
    
    ), false, false); ?>
		
	</div><!-- left banner -->
		<div class="span-20" id="middlecontent">
		
		<div class="super_title">
		<?php echo "<h1>Welcome ".$user->username."</h1>";?>
		</div>
		
	
		
	</div><!-- middle banner -->
	
	<div class="span-10-last" id="rightcontent">
	<?php echo("right content");?>
	
		
	</div><!-- right content -->
	
	</div><!-- maincontent -->

<div class="span-40" id="banner">
<div class="span-10" id="leftbanner">

<table>

<tr>
<td>
		
	 
    <div id="film_list">
     
    <?php $this->renderPartialWithHisOwnClientScript('//user/_films',array(
      'films'=>$user->films,
    ), false, false); ?>
    </div>
    
</td>
</tr>
<tr>
<td>    

	
    <div id="sequence_list_area">
  
     <?php
     
    // echo $selected_film;
    /* 
     if($selected_film!=null)
     {
	     $this->renderPartialWithHisOwnClientScript('_sequences',array(
	      'film'=>$selected_film,
	    ), false, false); 
     }
     */
    ?>
    
    </div>
    <div id="shot_list_area"><p>shot_list_area</p></div>
 </td>
 </tr>
    
  
</table>		
	</div><!-- left banner -->
		<div class="span-20" id="screen">
	
	
	  <?php echo "Test new Dashboard" ?>
	   <?php
     
    // echo $selected_film;
    
	  $this->renderPartial('//film/_form', array('model'=>$model));
     /*
     if($selected_film!=null)
     {
	     $this->renderPartialWithHisOwnClientScript('_poster',array(
	      'model'=>$selected_film,
	    ),false,false); 
     }
     */
    ?>
	  
		
	</div><!-- middle banner -->
	
	<div class="span-10-last" id="rightbanner">
	
		
	
    
    
    	
	</div><!-- right banner -->
	
	
	
	
</div>
	

	<div class="clear"></div>
	
	<div class="span-40" id="storybanner">
	
	<?php echo("storyboard carousel");
	$this->widget('zii.widgets.jui.CJuiSortable', array(
    'items'=>array(
        'id1'=>'',
      
    ),
    // additional javascript options for the accordion plugin
    'options'=>array(
        'delay'=>'300',
    ),
));
	?>
	
	
	</div>


</div><!-- film -->



