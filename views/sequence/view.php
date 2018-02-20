
	<?php 
	
    
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
	
<div id="films">

<div class="span-40" id="maincontent">

		<div class="span-10" id="leftcontent">
	<?php 
	$selected_film= Film::model()->findByPk($selected_seq->film_id);
	
	Yii::app()->clientScript->registerCoreScript('jquery');
	$this->renderPartialWithHisOwnClientScript('//user/player',array(
    'film_id'=>$selected_seq->film_id,
    ), false, false); ?>
		
	</div><!-- left banner -->
		<div class="span-20" id="middlecontent">
		
		
	
		
		<div class="super_title">
		
				<?php   $dashboard_url= Yii::app()->baseUrl."/index.php/user/dashboard/id/1/film_id/".$selected_film->id;	
 ?>
				
				<?php 
		 $storyboard_url= Yii::app()->baseUrl."/index.php/user/view/id/".$selected_film->user_id;
    	?>
    	
		<h2><a href=<?php echo $storyboard_url?>>Project : <?php echo $selected_film->title ?></a></h2>
					<h3><a href='<?php echo $dashboard_url ?>'>Storyboard</a></h3> 
						<p>Sequence : <?php echo $selected_seq->title ?> </p>
		
		
				<div id="storyboard_panel">
				</div>
				
				<div id="sequence_form_popup">
				</div>
				
				
				<div id="film_form_popup">
				</div>
		
		</div>
		
	
		
	</div><!-- middle banner -->
	
	<div class="span-10-last" id="rightcontent">
	
	
		
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
    //$selected_film= Film::model()->findByPk($selected_seq->film_id);
    
     if($selected_film!=null)
     {
	     $this->renderPartialWithHisOwnClientScript('//user/_sequences',array(
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
    
	  $this->renderPartialWithHisOwnClientScript('//sequence/sequence_panel', array('selected_seq'=>$selected_seq),false,false);
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
	
	
	
	
	</div>


</div><!-- film -->



