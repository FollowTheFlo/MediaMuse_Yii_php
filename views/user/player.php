
 <?php 
    /*
      Yii::app()->clientScript->registerScriptFile(
    Yii::app()->baseUrl.'/js/storyboard.js');
    */
    
     Yii::app()->clientScript->registerScriptFile(
    Yii::app()->baseUrl.'/js/jquery.bxSlider.min.js');
    
    ?>

<div class="story_player">
<table id="player" >
<tr>

<td><h1>Play</h1></td>
<td   onclick="clickFilmPlay(<?php echo $film_id ?>)"> <img class='btn_player'  id="test_id" src=<?php echo Yii::app()->baseUrl.'/images/player/button_black_play.png'?> height="80" width="80" alt="Play storyboard" /></td>


</tr>
</table>
</div>