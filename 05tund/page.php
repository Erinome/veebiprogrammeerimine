<?php
	$userName = "Raner";
	$photoDir = "../photos/";
	$picFileTypes = ["image/jpeg", "image/png"];
	$fullTimeNow = date("d.m.Y H:i:s");
	$partialTime = date("H:i:s");
	$hourNow = date("H");
	$minutesNow = date("i");
	$weekDayToday = date("N");
	$monthToday = date("m");
	$dayToday = date("d");
	$year = date("Y");

	$emailError = null;
  	$passwordError = null;
    $email = null;
	$database = "if19_raner_re_1";
 
	//setlocale(LC_TIME, 'et_EE');
	
	$weekDaysET = ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];
	$monthsET = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
	
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
	
	
	//Info semestri kulgemise kohta
	$semesterStart = new DateTime("2019-9-2");
	$semesterEnd = new DateTime("2019-12-13");
	$semesterDuration = $semesterStart->diff($semesterEnd);
	$today = new DateTime("now");
	$fromSemesterStart = $semesterStart->diff($today);
	//var_dump($fromSemesterStart);
	$semesterInfoHTML = "<p>Siin peaks olema info semestri kulgemise kohta!</p>";
	$elapsedValue = $fromSemesterStart->format("%r%a");
	$durationValue = $semesterDuration->format("%r%a");
	//echo $testValue;
	//<meter min="0" max="155" value="33">Väärtus</meter>
	if($elapsedValue > 0) {
		$semesterInfoHTML = "<p>Semester on täies hoos: ";
		$semesterInfoHTML .= '<meter min="0" max="' .$durationValue .'" ';
		$semesterInfoHTML .= 'value="' .$elapsedValue .'">';
		$semesterInfoHTML .= round($elapsedValue / $durationValue * 100, 1) ."%";
		$semesterInfoHTML .="</meter";
		$semesterInfoHTML .="</p>";
		
	} elseif($elapsedValue < 0) {
			$semesterInfoHTML = "<p>Semester pole veel alganud!";
	} else {
			$semesterInfoHTML = "<p>Semester on läbi saanud!";
	}	
	
	$kuupaev = "<p>Lehe avamise hetkel oli aeg: " .$dayToday. ".". $monthsET[$monthToday-1]." ". $year. " " . $weekDaysET[$weekDayToday-1] ." , kell ". $partialTime . "</p>";
	
	
	//foto lisamine lehele 
	$allPhotos = [];
	$dirContent = array_slice(scandir($photoDir), 2);
	//var_dump($dirContent);
	foreach ($dirContent as $file) {
		$fileInfo = getImagesize($photoDir .$file);
		//var_dump($fileInfo);
		if(in_array($fileInfo["mime"], $picFileTypes) == true) {
			array_push($allPhotos, $file);
		}
	}
	
	
	//var_dump($allPhotos);
	$picCount = count($allPhotos);
	$picNum = mt_rand(0, ($picCount -1));
	//echo $allPhotos[$picNum];
	$photoFile = $photoDir . $allPhotos[$picNum];
	$randomImgHTML = '<img src="' . $photoFile . '" alt="TLÜ Terra õppehonne">';
	
	//lisame lehe päise
	require("header.php");
	
?>

<?php
    if(empty($_POST["email"])){
        $emailError = "Palun sisesta oma email.";
    } else {
        $email = trim($_POST["email"]);
    }
    
  
    if(empty($_POST["password"])){
        $passwordError = "Palun sisesta oma parool.";
    } else {
        $password = trim($_POST["password"]);
    }

    if (empty($emailError . $passwordError)) {
    	$notice = signIn($email, $password);
    }

?>





<body>
  <?php
	echo "<h1>" . $userName . " koolitöö leht</h1>";
  ?>
  <p>See leht on loodud koolis õppetoo raames ja ei sisalda tõsiseltvoetavat sisu!</p>
  <?php
	echo $semesterInfoHTML;
  ?>
  <hr>
  <?php echo $kuupaev; 
  ?> 
  
  <?php
	echo "<p>Lehe avamise hetkel oli " . $partOfDay . ".</p>";
  ?>
<hr>
<?php
	echo $randomImgHTML;
  ?>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Sisselogimine</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Kasutajanimi</label>
                <input type="text" name="username" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $emailError; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($passwordError)) ? 'has-error' : ''; ?>">
                <label>Parool</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $passwordError; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Logi sisse">
            </div>
          </form>
    </div>    
</body>
</html>