<div class="film_ribbon">
<?php 



 foreach($films as $film)
 {
 	$model = new Post;
 	$play_url= Yii::app()->baseUrl."/index.php/user/dashboard/id/".$user->id."/film_id/".$film->id;
    $user_info = Yii::app()->baseUrl;
    	
    echo "<table>";
    echo "<tr><td colspan='1'><h1>".$film->title."</h1></td></tr>";
    echo "<tr><td colspan='1'>by <h2>".$user->username."</h2></td></tr>";
    echo "<tr><td> <a href=".$user_info."><img  class='btn_cube' src=".Yii::app()->baseUrl."/images/info_black.png  height='40' width='40' alt='Info' /></a>";
    echo "<img onclick='clickWallFilmPlay(".$film->id.")' class='btn_cube' src=".Yii::app()->baseUrl."/images/player/button_black_play.png  height='40' width='40' alt='Play' />";
	
	echo "<input style='align:right' onclick=seeCommentForm(".$film->id.") type='button' value='comments'/><td>";
    echo "<h4>view:".$film->view."<h4>";
	echo "</tr>";
    
    //echo "<div id='post_form".$film->id."'>";
    echo "<tr id='post_form".$film->id."' style='visibility:collapse;' >
    <td  colspan='2' style='align-text:center;border: 3px solid #5C8DAD;'>";
 
    
    echo"<h3>name: <input id='post_author".$film->id."' type='text' value='' style='width:150px;align-text:center;' /></h3>";
    echo"<h3>comment: <input id='post_comment".$film->id."' type='text' value='' style='width:350px;align-text:center;'/></h3>";
     echo"<input id='post_btn".$film->id."' type='button' onclick=clickAddPost(".$film->id.") value='Post' />";
     
    echo "</td></tr>";
   // echo "</div>";
    echo "</table>";
   
    	
    }
    
    
    ?>
    
</div>