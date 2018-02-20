<?php Yii::app()->clientScript->registerCoreScript('jquery.ui'); 

	Yii::app()->clientScript->registerScriptFile(
    Yii::app()->baseUrl.'/js/cube_script.js'
);

?>


<div class="span-40" id="maincontent">
	<div class="span-10" id="leftcontent">
	
	<div class="story_player">
	<table id="new_proj" >
	<tr>
	
	<td ><h2>Create<br />Project</h2></td>
	<td align="center"  onclick="clickFilmAdd()">  <img class='btn_cube' onclick="clickFilmAdd()" src=<?php echo Yii::app()->baseUrl.'/images/list_add.png'?> height="50" width="50" alt="Add shot" /></td>


</tr>
</table>	
		</div>
	</div><!-- left banner -->
   


		
	
		<div class="span-20" id="middlecontent">
		
		<div class="super_title">
		
		<h2>Studio of <?php echo $user->username ?></h2>
		<h3>Home</h3> 
				
    
		<?php $films = $user->films ?>	
				
				
				<div id="film_form_popup">
				</div>
	
    	
		</div>
		
	
		
	</div><!-- middle banner -->
	
	<div class="span-10-last" id="rightcontent">
	<?php echo("right content");?>
	
		
	</div><!-- right content -->
	
	

<div class="span-40" id="banner">
<div class="span-10" id="leftbanner">

<table>

<tr>
<td>
		
	 
    <div id="film_list">
     
    <?php $this->renderPartialWithHisOwnClientScript('_films',array(
      'films'=>$films,
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
	
	 <h1 style="margin-bottom:20px;">Make and share your storyboards</h1>
     
  <?php $this->renderPartialWithHisOwnClientScript('//film/_ribbon',array(
     'films'=>$films,
  	 'user_id'=>$user->id,
    ), false, false);
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



</div>>

