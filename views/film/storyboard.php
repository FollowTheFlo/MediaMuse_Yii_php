
<?php 
    
     
    
     Yii::app()->clientScript->registerScriptFile(
    Yii::app()->baseUrl.'/js/jquery.bxSlider.min.js');
    
    
     Yii::app()->clientScript->registerScriptFile(
    Yii::app()->baseUrl.'/js/storyboard.js');
    
    
   
    ?>
    
	
<div id="dialog_flo">	

	
  <?php  
   	
$sequences = $film->sequences(array('order'=>'rank ASC'));


echo "<ul id='Slider_flo'>";

 foreach($sequences as $sequence)
 {
 

	 $shots = $sequence->shots(array('order'=>'rank ASC'));
	 
	 foreach($shots as $shot)
	 {
	 	$dbImage = Yii::app()->createUrl('shot/displaySavedImage',array('id'=>$shot->id)); 
	     $image_shot = CHtml::image($dbImage,'image',array("width"=>300 , "height"=>200, "hspace=>0"));
	     
	 	
	 	echo "<li>";
	 	echo "<h3>".$sequence->title."</h3>";
	 	echo "<h4>".$shot->rank.": ". $shot->title."</h4>";
	 	echo "<p>".$shot->angle."</p>";
	 	echo "<p>".$image_shot."</p>";
	 	
	 	echo "</li>";
	 	 	
	 }
 
 
 }
echo "</ul>"; 



?>

<center>
<img id='go-prev' class='btn_player' src=<?php echo Yii::app()->baseUrl.'/images/player/arrow_left.png'?> height="50" width="50"  alt="Next" />
<img id='go-next'  class='btn_player' id="test_id" src=<?php echo Yii::app()->baseUrl.'/images/player/arrow_right.png'?> height="50" width="50" alt="Previous" />
</center>	


</div>






