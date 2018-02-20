<div class="mozaic">



<?php 
 Yii::app()->clientScript->registerScriptFile(
    Yii::app()->baseUrl.'/js/cube_script.js'
);


	$form_seq=$this->beginWidget('CActiveForm', array(
	
	'id'=>'seq_form_'.$selected_seq->id,
	'enableAjaxValidation' => false,

));  
?>
<div class="row">

<table>
<tr>
<td>

<h4 style='float:left'>
Add Project <img class='btn_cube' onclick="clickFilmAdd()" src=<?php echo Yii::app()->baseUrl.'/images/add_cross.png'?> height="20" width="20" alt="Add shot" />
  
 &nbsp; Add Sequence <img class='btn_cube' onclick="clickSequenceAdd(<?php echo $selected_seq->film_id ?>)" src=<?php echo Yii::app()->baseUrl.'/images/add_cross.png'?> height="20" width="20" alt="Add shot" />


 &nbsp; Add Shot <img class='btn_cube' onclick="showNewShot()" src=<?php echo Yii::app()->baseUrl.'/images/add_cross.png'?> height="20" width="20" alt="Add shot" />
 </h4>
</td>


</tr>
<tr>
<td>
<?php 

echo $form_seq->textField($selected_seq,'title', array('style'=>'width:400px'));
?>
</td>

<td>

<img class='btn_cube' onclick="clickAddShot()" src=<?php echo Yii::app()->baseUrl.'/images/edit_pen.png'?> alt="Save sequence" />
</td>
<td>
 <img class='btn_cube' onclick="deleteSequence(<?php echo $selected_seq->id ?>)" src=<?php echo Yii::app()->baseUrl.'/images/delete_cross.png'?> alt="Delete sequence" />
</td>

</tr>
</table>

</div>


<?php
$this->endWidget(); 
?>

 
<?php
//	display_sequence_form($selected_seq);

	  //display_new_shot($selected_seq->id);
    
    ///display a hidden nes shot. make it visible when pressing add.
    
    $empty_shot = new shot;
	
    	echo "<div id='new_shot'>";
    	 echo "<table>";
		echo "<tr>";
		echo "<td>";
    	//echo "test";
    	
     $this->renderPartial('//sequence/_single_shot',array(
      'model'=>$empty_shot,
     'seq_id'=>$selected_seq->id,	 
    	
    ));
    	
    	echo "</td>";
    	echo "</tr>";
    	echo "</table>";
    	echo "</div>";
    	
    //end of hidden noew shot
    
	
	$shot_li="";
    $shot_ul= "<select name='shot_box_list' size='5' id='shot_box_list' multiple='multiple'>";
    echo "<table id='mozaic'>";
    $i=0;
    $shots= $selected_seq->shots(array('order'=>'rank ASC'));
    
  
    	
    echo "<tr>";
    
    foreach($shots as $shot)
    {
    	$dbImage = $this->createUrl('shot/displaySavedImage',array('id'=>$shot->id)); 
     $im = CHtml::image($dbImage,'image',array("width"=>300 , "height"=>300));
     
    	    	$shot_li = $shot_li. "<li class='ui-state-default'><p>".$shot->title."</p>".$im."</li>";
    	    	//$shot_li = $shot_li. "<li class='ui-state-default'><p>". $this->renderPartial('_single_shot',array(
   //   'model'=>$shot,
  //  ))."</li>";
    	
    	
    	if($i>=2)
    	{
    		//new line
    		echo "</tr><tr>";
    		$i=0;
    	}
    	$i++;
    	echo "<td>";
    	//echo "test";
    	 $this->renderPartial('//sequence/_single_shot',array(
      'model'=>$shot,
     'seq_id'=>$selected_seq->id,	 
    	
    ));
    	echo "</td>";
    	
    	
    	
    	
    	//$shot_ul = $shot_ul . "<option ondblclick='clickShotView()' value='".$shot->id."'> ".$shot->title."</option>";
    	
    
    }
  
   
     echo "</tr><table>";
     
    ?> 

     
  
    
    
<style>
#sortable { list-style-type: none; margin: 0; padding: 0; }
#sortable li { margin: 3px 3px 3px 0; padding: 1px; float: left; width: 300px; height: 300px; font-size: 1em; text-align: center; }
</style>
<script>
$(function() {
	$( "#sortable" ).sortable();
	$( "#sortable" ).disableSelection();
});
</script>



 </div>

<?php 
function display_sequence_form($selected_seq)
{



$form_seq=$this->beginWidget('CActiveForm', array(
	
	'id'=>'seq_form_'.$selected_seq->id,
	'enableAjaxValidation' => false,

));  

echo $form_seq->textField($selected_seq,'title', array('style'=>'width:350px'));

$this->endWidget(); 


}



?>

