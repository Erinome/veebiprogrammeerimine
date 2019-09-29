<?php
	require("../../../config_vp2019.php");
	require("functions_film.php");
	$userName = "Raner";
	$database = "if19_raner_re_1";

	$title = $zanr = $company = $maker = $pealkiri = "";
	$year = '2019';
	$time = '80';
	//var_dump($_POST);
	//kui on nuppu vajutatud
	if(isset($_POST["submitFilm"])) {
	//salvestame, kui vähemalt pealkiri on olemas
		
		if(!empty($_POST["filmTitle"])){	
			saveFilmInfo($_POST["filmTitle"],$_POST["filmYear"], $_POST["filmDuration"], $_POST["filmGenre"], $_POST["filmCompany"], $_POST["filmDirector"]);
		}
		else {
			
			$year = $_POST["filmYear"];
			$time = $_POST["filmDuration"];
			$zanr = $_POST["filmGenre"];
			$company = $_POST["filmCompany"];
			$maker = $_POST["filmDirector"];
			
			$pealkiri = '<h2 style="color:red;">Palun sisesta pealkiri!</h2>';
		}

	}

	//lisame lehe päise
	//require("header.php");

?>


<body>
  <?php
	echo "<h1>" . $userName . " koolitöö leht</h1>";
  ?>
  <p>See leht on loodud koolis õppetoo raames ja ei sisalda tõsiseltvoetavat sisu!</p>
  <hr>
  <h2>Eesti filmid, lisame uue</h2>
  <p>Täida kõik failid ja lisa film andmebaasi:</p>
  <form method="POST">
	<label>Sisesta pealkiri: </label><input type="text" name="filmTitle" value="<?php echo $title?>">
	<br>
	<label>Filmi tootmisaasta: </label><input type="number" min="1912" max="2019"
	value="<?php echo $year?>" name="filmYear">
	<br>
	<label>Filmi kestus (min): </label><input type="number" min="1" max="300" value="<?php echo $time?>" name="filmDuration">
	<br>
	<label>Filmi žanr: </label><input type="text" name="filmGenre" value="<?php echo $zanr?>">
	<br>
	<label>Filmi tootja: </label><input type="text" name="filmCompany" value="<?php echo $company?>">
	<br>
	<label>Filmi lavastaja: </label><input type="text" name="filmDirector" value="<?php echo $maker?>">
	<br>
	<input type="submit" value="Salvesta film" name="submitFilm">
	<br>
	<?php print $pealkiri; ?>


  </form>
  <?php
    //echo "Server: " .$serverHost .", kasutaja: " .$serverUsername;
	//echo $filmInfoHTML;
  ?>

</body>
</html>