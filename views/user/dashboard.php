<?php Yii::app()->clientScript->registerCoreScript('jquery.ui'); ?>
<div id="films">

<div class="span-40" id="maincontent">

		<div class="span-10" id="leftcontent">
	<?php $this->renderPartialWithHisOwnClientScript('player',array(
     'film_id'=>$selected_film->id,
    ), false, false); ?>
		
	</div><!-- left banner -->
		<div class="span-20" id="middlecontent">
		
		<div class="super_title">
		<?php 
		 $storyboard_url= Yii::app()->baseUrl."/index.php/user/view/id/".$selected_film->user_id;
    	?>
    	
		<h2><a href=<?php echo $storyboard_url?>>Project : <?php echo $selected_film->title ?></a></h2>
				<h3>Storyboard</h3> 
						<p>Dashboard</p>	
    
				<div id="storyboard_panel">
				</div>
				
				<div id="sequence_form_popup">
				</div>
				
				
				<div id="film_form_popup">
				</div>
	
    	
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
     
    <?php $this->renderPartialWithHisOwnClientScript('_films',array(
      'films'=>$model->films,
    ), false, false); ?>
    </div>
    
</td>
</tr>
<tr>
<td>    

	
    <div id="sequence_list_area">
  
     <?php
     
    // echo $selected_film;
     
     if($selected_film!=null)
     {
	     $this->renderPartialWithHisOwnClientScript('_sequences',array(
	      'film'=>$selected_film,
	    ), false, false); 
     }
    ?>
    
    </div>
    <div id="shot_list_area"><p>shot_list_area</p></div>
 </td>
 </tr>
    
  
</table>		
	</div><!-- left banner -->
		<div class="span-20" id="screen">
	
	   <?php
     
    // echo $selected_film;
     
     if($selected_film!=null)
     {
	     $this->renderPartialWithHisOwnClientScript('//film/_poster',array(
	      'model'=>$selected_film,
	    ),false,false); 
     }
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



