 <div class="FilmModule">  
<?php /* CHtml::ajaxLink('My shots',array('Refreshshots','id'=>2),array('update' => '#shot_list'))*/;


//Yii::app()->clientScript->registerCoreScript('jquery');

//Yii::app()->clientScript->registerScriptFile(
//    Yii::app()->baseUrl.'/js/cube_script.js'
//);
?>
<?php 

    $shot_ul= "<select name='shot_box_list' size='5' id='shot_box_list' multiple='multiple'>";
    $shots_arr=array();
    $shot_li="";
    $i=0;
    
    
     
    foreach($shots as $shot)
    {
    	$dbImage = $this->createUrl('shot/displaySavedImage',array('id'=>$shot->id)); 
     $im = CHtml::image($dbImage,'image',array("width"=>100 , "height"=>100));
    	//$shots_arr[]=  array('id'.$i =>$shot->get_sketch_link());
    	
    	$shot_ul = $shot_ul . "<option ondblclick='clickShotView()' value='".$shot->id."'> ".$shot->title."</option>";
    	$shot_li = $shot_li. "<li class='ui-state-default'>.$im.</li>";
    
    }
    $shot_ul = $shot_ul . "</select>";
    
    $items = CHtml::listData($shots, 'id', 'title');
    
  // print_r($movies);
  
   // $dbImage = $this->createUrl('shot/displaySavedImage',array('id'=>$model->id)); 
   //  echo CHtml::image($dbImage,'image',array("width"=>250 , "height"=>200));
     
  
    //$dataProvider=new CArrayDataProvider($shots, array(
    //'id'=>CHtml::image($this->createUrl('shot/displaySavedImage',array('id'=>id)),'image',array("width"=>250 , "height"=>200)),
    
//));


    ?>
    
    

<table id="my_shot_table" >
<tr>
<td colspan="4">
<h2>Shots</h2>
<h3>for sequence: <?php echo $sequence->title ?></h3>
</td>
</tr>
<tr>
<td class='btn_cube' onclick="clickShotView()"><h2><img src=<?php echo Yii::app()->baseUrl.'/images/view_eye.png'?> alt="View" /></h2></td>
<td class='btn_cube'  onclick="clickShotEdit()"><h2><img  id="test_id" src=<?php echo Yii::app()->baseUrl.'/images/edit_pen.png'?> alt="View" /></h2></td>
<td class='btn_cube' ><h2><img src=<?php echo Yii::app()->baseUrl.'/images/delete_cross.png'?> alt="View" /></h2></td>
<td class='btn_cube' onclick="clickShotAdd()"><h2><img src=<?php echo Yii::app()->baseUrl.'/images/add_cross.png'?> alt="View" /></h2></td>
</tr>
<tr>
<td colspan="4">

<?php


$test=array(
	                'id1'=>'Item 1',
	                'id2'=>'Item 2',
	                'id3'=>'Item 3',
	                'id4'=>'Item 4',
	                'id5'=>'Item 5',
        );
//print_r($shots_arr);
//print_r($shot_li);

$this->widget('zii.widgets.jui.CJuiSortable', array(
    'items'=>$items,
	'itemTemplate' => '<li class="FilmCenter">{content}</li>',

    // additional javascript options for the accordion plugin
    'htmlOptions'=>array(
        
    	'id'=>'flo10',
    ),
));
    

    
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
 $this->widget('zii.widgets.jui.CJuiSortable', array(
    'items'=>array(
        'id1'=>'Item 1',
        'id2'=>'Item 2',
        'id3'=>'Item 3',
    ),
    // additional javascript options for the accordion plugin
    'options'=>array(
        'delay'=>'300',
    ),
));

?>



