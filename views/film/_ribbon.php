

<div class="film_ribbon">
<?php 



 foreach($films as $film)
    {
    	 $storyboard_url= Yii::app()->baseUrl."/index.php/user/dashboard/id/".$user_id."/film_id/".$film->id;
    	
    	echo "<table>";
    	echo "<tr><td colspan='3'><h1>".$film->title."</h1></td></tr>";
    	echo "<tr><td colspan='3'><h2>".$film->description."</h2></td></tr>";
    	echo "<tr><td><h3>Storyboard<h3></td>";
    	echo "<td><h3>Catalogue</h3></td>";
    	echo "<td><h3>Schedule</h3></td>";
    	echo "<tr><td> <a href=".$storyboard_url."><img  class='btn_cube' src=".Yii::app()->baseUrl."/images/storyboard.png  height='40' width='40' alt='Storyboard' /></a></td>";
    	echo "<td><img class='btn_cube' src=".Yii::app()->baseUrl."/images/book_open.png  height='40' width='40' alt='Catalogue' /></td>";
    	echo "<td><img class='btn_cube' src=".Yii::app()->baseUrl."/images/calendar.png  height='40' width='40' alt='Schedule' /></td>";
    	echo "</tr>";
    	echo "</table>";
    	
    	
    	
    }
    
    
    ?>
    
</div>