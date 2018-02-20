 <?php 
 /*
 Yii::app()->clientScript->registerScriptFile(
    Yii::app()->baseUrl.'/js/cube_script.js'
);
*/
?> 
  
     <div class="celtx_menu">
     
  
 
<style>
#sortable_shot_left { list-style-type: none; margin: 0; padding: 0; }
#sortable_shot_left li { margin: 3px 3px 3px 0; padding: 1px; float: left; width: 40px; height: 10px; font-size: 1em; text-align: center; }

</style>
<script>
$(function() {
	
	$( "#sortable_shot_left" ).sortable();
	$( "#sortable_shot_left" ).disableSelection();
});
</script>
            

<?php $test = array(
        array('label'=>'Home', 'url'=>'#'),
        array('label'=>'Profile', 'url'=>'#'),
        array('label'=>'Messages', 'url'=>'#'),
    );
    
   
     $sequences=$film->sequences(array('order'=>'rank ASC'));
 
     Yii::app()->clientScript->registerScriptFile(
    Yii::app()->baseUrl.'/js/fiddle.js'
);



     
    $acc_menu= "<div id='sequence_accordion'>";
    $sequence_ul= "<select name='sequence_box_list' size='5' id='sequence_box_list' multiple='multiple'>";
    $seqs=array();
    foreach($sequences as $sequence)
    {
  //  		$dbImage = $this->createUrl('shot/displaySavedImage',array('id'=>$shot->id)); 
   //  $im = CHtml::image($dbImage,'image',array("width"=>300 , "height"=>300));
     
   // 	 $shot_li = $shot_li. "<li class='ui-state-default'><p>".$shot->title."</p>".$im."</li>";
    	

    	$seq[] = array('text'=>$sequence->title);
    	
    	$acc_menu = $acc_menu . "<h3><a id='".$sequence->id."' href='#'>".$sequence->title."</a></h3><div>".get_shots_Menu($sequence)."</div>";
    	$sequence_ul = $sequence_ul . "<option ondblclick='clickSequenceView()' value='".$sequence->id."'> ".$sequence->title."</option>";
    	
    	
    	//array_merge($seqs,$seq);
    }
    
     //print_r($seq);
   // print_r($seqs);
    $acc_menu = $acc_menu . "</div>";	
    $sequence_ul = $sequence_ul . "</select>";
    
   
    
    
   
    
   
?>
   <div class="left_menu">
<table id="my_sequence_table" >
<tr>
<td colspan="3">
<h2>Sequences</h2>
<p>of: <?php echo $film->title ?></p>

</tr>

<tr>
<td colspan="4">



<?php
/*
$this->widget('bootstrap.widgets.BootMenu', array(
    'type'=>'list', // '', 'tabs', 'pills' (or 'list')
    'stacked'=>false, // whether this is a stacked menu
    'items'=>$movies,
)); 



*/
//echo $sequence_ul;
echo $acc_menu;

 //print_r($dataTree1);
 
 
	    

?>


</td>
</tr>


</table>

</div>
</div>

<?php 
function get_shots_Menu($sequence_entity)
{
	
	
	
	
	//$sql='SELECT * FROM {{user}}';
	//$users=$connection->createCommand($sql)->queryAll();
	

    
    // ->where('sequence_id=:target_id', array(':target_id'=>$seq_id))
    
	//get them in order
  $shot_list = $sequence_entity->shots(array('order'=>'rank ASC'));
    $shot_li="";
    
    foreach($shot_list as $shot)
    {
    	
    	//get image from DB
    
    $shot_url="#shot_link_".$shot->id;	
	$shot_li = $shot_li. "<p><a href=".$shot_url.">".$shot->rank.".".substr($shot->title,0,20)."</a></p>";
    
    	
    }
	
    
$my_text= $shot_li;

return $my_text;

}


?>





