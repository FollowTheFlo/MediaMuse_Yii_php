 
<?php /* CHtml::ajaxLink('My films',array('Refreshfilms','id'=>2),array('update' => '#film_list'))*/;

//Yii::app()->clientScript->scriptMap['*.js'] = false;
//Yii::app()->clientScript->registerCoreScript('jquery');


/*

Yii::app()->clientScript->registerScriptFile(
    Yii::app()->baseUrl.'/js/cube_script.js'
);
*/
//fiddle used for accordion menu
Yii::app()->clientScript->registerScriptFile(
    Yii::app()->baseUrl.'/js/fiddle_film.js');
    
    
echo "<div class='celtx_menu'> ";
?>
<?php 

	
     $acc_menu= "<div id='film_accordion'>";
    
    $film_ul= "<select width='100px' name='film_box_list' size='8' id='film_box_list' multiple='multiple'>";
    
    foreach($films as $film)
    {
    	
    	$movies[]=array('id'=>$film->id,'label'=>$film->title,'url' => '#');
    	
    	$acc_menu = $acc_menu . "<h3><a id='".$film->id."' href='#'>".$film->title."</a></h3><div>".get_SubMenu($film)."</div>";
    
    	
    	$film_ul = $film_ul . "<option ondblclick='clickFilmView()' value='".$film->id."'> ".$film->title."</option>";
    	
    
    }
    $film_ul = $film_ul . "</select>";
     $acc_menu = $acc_menu . "</div>";
    
   //print_r($movies);
   
 
    ?>
    
    
 
<table id="my_film_table" >
<tr>
<td colspan="3">
<h2>Projects </h2>
</td>

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
echo $acc_menu;
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

<?php 

function get_SubMenu($film_entity)
{

	$submenu_li="";
    
    $storyboard_url= Yii::app()->baseUrl."/index.php/user/dashboard/id/1/film_id/".$film_entity->id;	
    $submenu_li = $submenu_li. "<p><a href=".$storyboard_url."><div class='left_menu'><img  src=".Yii::app()->baseUrl."/images/storyboard.png  height='15' width='15' alt='Storyboard' />";
	$submenu_li = $submenu_li. "&nbsp Storyboard</div></a></p>";
	
	$catalogue_url="catalogue_".$film_entity->id;	
	$submenu_li = $submenu_li. "<p><a href=".$catalogue_url."><div class='left_menu'><img  src=".Yii::app()->baseUrl."/images/book_open.png  height='15' width='15' alt='Catalogue' />";
	$submenu_li = $submenu_li. "&nbsp Catalogue</div></a></p>";
	
	$schedule_url="schedule_".$film_entity->id;	
	$submenu_li = $submenu_li. "<p><a href=".$schedule_url."><div class='left_menu'><img  src=".Yii::app()->baseUrl."/images/calendar.png  height='15' width='15' alt='Schedule' />";
	$submenu_li = $submenu_li. "&nbsp Schedule</div></a></p>";
    
	
    	
return $submenu_li;

}

?>




