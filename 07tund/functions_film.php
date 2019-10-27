<?php function readAllFilms() {
		
	
	//loeme andmebaasist 
	//loome andmebaasiühenduse (näiteks $conn)
	$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	
	//valmistame ette päringu
	$stmt = $conn->prepare("SELECT pealkiri, aasta, kestus FROM film");
	
	//seome saadava tulemuse muutujaga
	$stmt->bind_result($filmTitle, $filmYear, $filmKestus);
	
	//käivitame SQL päringu
	$stmt->execute();
	$filmInfoHTML = "";
	
	while($stmt->fetch()) {
		$filmInfoHTML .= "<h3>" .$filmTitle . "</h3>";
		$filmInfoHTML .= "<p>Tootmisaasta: " . $filmYear . ". </p>";
		$filmHours = floor($filmKestus / 60);
		$filmMinutes = ($filmKestus % 60);
		
		if ($filmHours > 1 ) {
			$filmInfoHTML .= "<p>Kestus: " . $filmHours . " tundi ja " . $filmMinutes . " minutit.</p>";
		}
		elseif($filmHours < 1) {
			$filmInfoHTML .= "<p>Kestus: " . $filmMinutes . " minutit.</p>";	
		}
		elseif($filmMinutes <= 1) {
			$filmInfoHTML .= "<p>Kestus: " . $filmHours . " tund ja " . $filmMinutes . " minut.</p>";
		}
		elseif ($filmHours == 1) {
			$filmInfoHTML .= "<p>Kestus: " . $filmHours . " tund ja " . $filmMinutes . " minutit.</p>";
		}	
		
		/**
		  *	Film kui võrdub 0, siis näitab minutit. 
		  * Film kui võrdub 1, siis on "tund". Muidu näitab "tundi"
		  * 
		  * Minutid kui võrdub 1, siis on "minut". Muidu näitab "minutit"
		  */
		
		
		
		// Filmhours = 0 ja filmMinutes või filmhour = 1 ja filmminust
		if (($filmHours == 0 OR $filmHours == 1)) {
			if ($filmMinutes == 1) {
				//$filmInfoHTML .= "<p>Kestus: " . $filmHours . " tund ja " . $filmMinutes . " minut.</p>";
			} else {
				//$filmInfoHTML .= "<p>Kestus: " . $filmHours . " tund ja " . $filmMinutes . " minutit.</p>";
			}
		}
		else {
			//$filmInfoHTML .= "<p>Kestus: " . $filmHours . " tundi ja " . $filmMinutes . " minutit.</p>";
		}
		
	}
	
	//sulgeme ühenduse
	$stmt->close();
	$conn->close();
	
	//väljastan väärtuse
	return $filmInfoHTML;
	}
	
	function saveFilmInfo($filmTitle,$filmYear, $filmDuration, $filmDescription){
		$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $conn->prepare("INSERT INTO FILM (Pealkiri, Aasta, Kestus, Lyhikirjeldus, userid) VALUES(?, ? , ?, ?, ?)");
		
		echo $conn->error;
		//s - string, i - integer, d - decimal
		$stmt->bind_param("siisi", $filmTitle, $filmYear, $filmDuration, $filmDescription, $_SESSION["userID"]);
		//$stmt->bind_param("i", $maxYear);
		$stmt->execute();
		
		$stmt->close();
		$conn->close();
		
	}
	
	
	
	?>