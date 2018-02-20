     <div class="celtx_menu">
     
 

            

<?php $test = array(
        array('label'=>'Home', 'url'=>'#'),
        array('label'=>'Profile', 'url'=>'#'),
        array('label'=>'Messages', 'url'=>'#'),
    );
    
   
     $sequences=$film->sequences;
     
    $acc_menu= "<div id='accordion'>";
    $sequence_ul= "<select name='sequence_box_list' size='5' id='sequence_box_list' multiple='multiple'>";
    $seqs=array();
    foreach($sequences as $sequence)
    {
  //  		$dbImage = $this->createUrl('shot/displaySavedImage',array('id'=>$shot->id)); 
   //  $im = CHtml::image($dbImage,'image',array("width"=>300 , "height"=>300));
     
   // 	 $shot_li = $shot_li. "<li class='ui-state-default'><p>".$shot->title."</p>".$im."</li>";
    	

    	$seq[] = array('text'=>$sequence->title);
    	
    	$acc_menu = $acc_menu . "<h3><a id='".$sequence->id."' href='#'>".$sequence->title."</a></h3><div><p>blablabalaa</p></div>";
    	$sequence_ul = $sequence_ul . "<option ondblclick='clickSequenceView()' value='".$sequence->id."'> ".$sequence->title."</option>";
    	
    	
    	//array_merge($seqs,$seq);
    }
    
     //print_r($seq);
   // print_r($seqs);
    $acc_menu = $acc_menu . "</div>";	
    $sequence_ul = $sequence_ul . "</select>";
    
   
    
    
   
    
   
?>

<table id="my_sequence_table" >
<tr>
<td colspan="4">
<h2>Sequence</h2>
<p>of: <?php echo $film->title ?></p>
</td>
</tr>
<tr>
<td class='btn_cube' onclick="clickSequenceView()"><img src=<?php echo Yii::app()->baseUrl.'/images/view_eye.png'?> alt="View sequence details" /></td>
<td class='btn_cube'  onclick="clickSequenceEdit()"><img  id="test_id" src=<?php echo Yii::app()->baseUrl.'/images/edit_pen.png'?> alt="Edit sequence" /></td>
<td class='btn_cube' ><img src=<?php echo Yii::app()->baseUrl.'/images/delete_cross.png'?> alt="Delete sequence" /></td>
<td class='btn_cube' onclick="clickSequenceAdd()"><img src=<?php echo Yii::app()->baseUrl.'/images/add_cross.png'?> alt="Create sequence" /></td>
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
<!--
<select name="List_0" size="5" id="List_0" multiple="multiple">
        <option value="1 ">Komal </option>
        <option value="2">Ranjeet</option>
        <option value="3 ">Vishal </option>
        <option value="4">Gaurav</option>
        <option value="5">Dhanpat</option>
    </select>)
-->

</td>
</tr>


</table>

</div>

<?php 


?>




