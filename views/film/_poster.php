

<div class="content">
<h4 style='float:left'>
Add Project <img class='btn_cube' onclick="clickFilmAdd()" src=<?php echo Yii::app()->baseUrl.'/images/add_cross.png'?> height="20" width="20" alt="Add shot" />
  &nbsp; &nbsp;Add Sequence <img class='btn_cube' onclick="clickSequenceAdd(<?php echo $model->id ?>)" src=<?php echo Yii::app()->baseUrl.'/images/add_cross.png'?> height="20" width="20" alt="Add shot" />
  </h4>
 <br />
 <br />
 	<?php 
 	
    
 	Yii::app()->clientScript->registerScriptFile(
    Yii::app()->baseUrl.'/js/cube_script.js'
);

Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerCoreScript('jquery.ui');

 Yii::app()->clientScript->registerScriptFile(
    Yii::app()->baseUrl.'/js/storyboard.js');
?>
 	
 	<h1><?php echo $model->title ?></h1>
    <p><?php echo $model->description ?></p>
    
   
    <?php  
    $sequence_ul= "<select name='sequence_box_list' size='5' id='sequence_box_list' multiple='multiple'>";
    $seqs=array();
    $seq_list = $model->sequences(array('order'=>'rank ASC'));
    $seq_li="";
    
    $index_seq=0;
    $seq_height= 250;
    
    
    
    $seq_numb=0;
    
    foreach($seq_list as $sequence)
    {
    	$seq_numb++;
		$seq_li = $seq_li. "<li ".get_sequence_box_style($sequence)." class='ui-state-default' id='seq_".$sequence->id."' ondblclick='SeeSequenceView(".$sequence->id.")'><h1 >".$sequence->title."</h1>
		".get_shots_SortMenu($sequence,$seq_numb)."</li>";
    
    	
    }
    
    $script_drag_shots = build_drag_shot_javascript($seq_numb);
    $css_drag_shots = build_drag_shot_css($seq_numb);
    
    
    
?>

</div><!-- comment -->

<style>
#sortable_seq { list-style-type: none; margin: 0; padding: 0; }
#sortable_seq li { margin: 3px 3px 3px 0; padding: 1px; float: left; width: 700px; height: 250px; font-size: 1em; text-align: center; }
#sortable_shot_1 { list-style-type: none; margin: 0; padding: 0; }
#sortable_shot_1 li { margin: 3px 3px 3px 0; padding: 1px; float: left; width: 210px; height: 160px; font-size: 1em; text-align: center; }
#sortable_shot_2 { list-style-type: none; margin: 0; padding: 0; }
#sortable_shot_2 li { margin: 3px 3px 3px 0; padding: 1px; float: left; width: 210px; height: 160px; font-size: 1em; text-align: center; }

#sortable_shot_3 { list-style-type: none; margin: 0; padding: 0; }
#sortable_shot_4 li { margin: 3px 3px 3px 0; padding: 1px; float: left; width: 210px; height: 160px; font-size: 1em; text-align: center; }

</style>


<div class="demo">

<ul id="sortable_seq">
<?php echo $seq_li?>
</ul>

</div><!-- End demo -->
<?php Yii::app()->clientScript->registerCoreScript('jquery.ui'); ?>
<?php echo $css_drag_shots?>
<?php echo $script_drag_shots?>

<?php 

function get_shots_SortMenu($sequence_entity,$seq_numb)
{
	$seq_id= $sequence_entity->id;
	
	//$sql='SELECT * FROM {{user}}';
	//$users=$connection->createCommand($sql)->queryAll();
/*	
	$shot_list_test = Yii::app()->db->createCommand()
    ->select('*')
    ->from('shot')
    ->queryAll();
    */
    
    // ->where('sequence_id=:target_id', array(':target_id'=>$seq_id))
    
	//print($shot_list_test);
  $shot_list = $sequence_entity->shots(array('order'=>'rank ASC'));
    $shot_li="";
    
    foreach($shot_list as $shot)
    {
    	
    	//get image from DB
    	$dbImage = Yii::app()->createUrl('shot/displaySavedImage',array('id'=>$shot->id)); 
     $image_shot = CHtml::image($dbImage,'image',array("width"=>120 , "height"=>110, "hspace=>0"));
    	
	$shot_li = $shot_li. "<li class='ui-state-default' id='shot_".$shot->id."' ><div class='drag_shot'><p>".$shot->rank.".".substr($shot->title,0,50)."</p>".$image_shot."</div></li>";
    
    	
    }
	
    
$my_text= "<div class='FilmModule'><ul id='sortable_shot_".$seq_numb."'>".$shot_li."</ul></div>";

return $my_text;

}

function get_sequence_box_style($sequence_entity)
{
	$shot_list = $sequence_entity->shots;
    $shot_li="";
    $j=0;
    $k=0;
    $seq_height=210;
    $seq_bottom_margin= 3;
    $seq_add=100;
    
    foreach($shot_list as $shot)
    {
    $j++;
    	
    }
    
    $k= $j/3;
    $k= floor($k);
    	if($k>=1)
    	{
    		$seq_height = $k * $seq_height;
    		$seq_height = $seq_height + $seq_add;
    		//$seq_height= $seq_height + ($k* $seq_add);
    		//$seq_height=400;
    		
    	}
    	
    $style_string = "style='height:".strval(floor($seq_height))."px;margin:3px 3px 3px 0;'";
    // $style_string = "style='height:".strval(floor($seq_height))."px;margin:3px 3px ".strval(floor($seq_bottom_margin))."px 0;'";
	
	return $style_string;
}



function build_drag_shot_javascript($seq_numb)
{
	$js="";
	
	for($i=1;$i<$seq_numb+1;$i++)
	{
	$js= $js."$('#sortable_shot_".$i."').sortable(".
			"{".
				"update: function(event, ui) {".
					
					"var shotOrder = $('ul#sortable_shot_".$i."').sortable('toArray').toString();".
					"var url=root_path+'shot/UpdateOrderDraggableShot';".
					"$.post(url, {shotOrder:shotOrder},".
							   "function(data){".
					     	      "$('#my_sequence_table').replaceWith(data);".

					   "});".
					
				"}".
			"}".
		");  ";

	}
	
	
	
	
	return "<script type='text/javascript'>  ".$js."  </script>";
}

function build_drag_shot_css($seq_numb)
{
	$css="";
	for($i=1;$i<$seq_numb+1;$i++)
	{
			
	$css=$css.
	"#sortable_shot_".$i." { list-style-type: none; margin: 0; padding: 0; }".
	"#sortable_shot_".$i." li { margin: 3px 3px 3px 0; padding: 1px; float: left; width: 210px; height: 160px; font-size: 1em; text-align: center; }";
		
	
	}
	return "<style>".$css."</style>";
}


?>





