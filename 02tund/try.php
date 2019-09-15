<?php
	$userName = "Raner";
	$fullTimeNow = date("d.m.Y H:i:s");
	$hourNow = date("H");
	$minutesNow = date("i");
	$partOfDay = "hägune aeg";
	if($hourNow < 8) {
			$partOfDay = "varane hommik";
	
	}
	if($hourNow == 8 and $minutesNow == 15) {
			$partOfDay = "Tundide algus";
	
	}
	
	if($hourNow == 17 and $minutesNow == 45 ) {
			$partOfDay = "Aeg koju minna";
	
	}
	
	if($hourNow >= 23) {
			$partOfDay = "Peaks vist magama minema";
	
	}
	
	
?>


<!DOCTYPE html>
<html= lang="et">
<head>
  <meta charset="utf-8">
  <title>
	<?php
		echo $userName;
	?>
  progeb veebi</title>
  
</head>
<body>
  <?php
	echo "<h1>" . $userName . " koolitöö leht</h1>";
  ?>
  <p>See leht on loodud koolis oppetoo raames ja ei sisalda tosiseltvoetavat sisu!</p>
  <hr>
  <p>Lehe avamise hetkel oli aeg: <?php echo $fullTimeNow; ?> .</p>
  
  <?php
	echo "<p>Lehe avamise hetkel oli " . $partOfDay . ".</p>";
  ?>
<hr>

</body>
</html>