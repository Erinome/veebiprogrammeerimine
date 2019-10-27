<?php
  require("../../../config_vp2019.php");
  require("functions_main.php"); 
  require("functions_user.php"); 
  $database = "if19_raner_re_1";

  //kui pole sisseloginud
  if(!isset($_SESSION["userID"])){
    //siis jõuga sisselogimise lehele
    header("Location: page.php");
    exit();
  }
  
  //väljalogimine
  if(isset($_GET["logout"])){
    session_destroy();
    header("Location: page.php");
    exit();
  }
  
  $userName = $_SESSION["userFirstname"] ." " .$_SESSION["userLastname"];
  
  $notice = null;
  $myDescription = null;
  
  if(isset($_POST["submitProfile"])){
  $notice = storeUserProfile($_POST["description"], $_POST["bgcolor"], $_POST["txtcolor"]);
  if(!empty($_POST["description"])){
    $myDescription = $_POST["description"];
  }
  $_SESSION["bgColor"] = $_POST["bgcolor"];
  $_SESSION["txtColor"] = $_POST["txtcolor"];
  } else {
  $myProfileDesc = showMyDesc();
  if(!empty($myProfileDesc)){
    $myDescription = $myProfileDesc;
    }
  }

  # teed kontrolli
  # võtad postist väärtused ja annad need funktsiooni kaasa, mis teeb kontrolli ja lisab andmabaasi
  $oldPassword = NULL;
  $errorTeade = '';
  if (isset($_POST["updatePassFrom"])){

    if(isset($_POST["oldPassword"]) and !empty($_POST["oldPassword"]) and strlen($_POST["oldPassword"]) > 8) { 

     
      if (isset($_POST["oldPassword"])) {
        $oldPassword = $_POST["oldPassword"];
        $teade = oldPassCheck($oldPassword);

        if ($teade) {

          if(isset($_POST["newPassWord"]) and !empty($_POST["newPassWord"]) and strlen($_POST["newPassWord"]) > 8) { 

            if ($_POST["newPassWord"] == $_POST["confirmPassword"]) {
                
              $newPassword = $_POST["newPassWord"];

              updatePassword($newPassword);

            }

          } 

        } else {
            $errorTeade = 'midagi on valest, ei ole õige parool.';
        }

      }

    }

  }


echo $_SESSION["userID"];


  
  require("header.php");
?>


<body>
  <?php
    echo "<h1>" .$userName ." koolitöö leht</h1>";
    echo $errorTeade;
  ?>
  <p>See leht on loodud koolis õppetöö raames
  ja ei sisalda tõsiseltvõetavat sisu!</p>
  <hr>
  <p><a href="?logout=1">Logi välja!</a> | <a href="userprofile.php">Kasutajaprofiil</a></p>
  <p>Tagasi <a href="home.php">avalehele</a></p>
  
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label>Minu kirjeldus</label><br>
    <textarea rows="10" cols="80" name="description" placeholder="Lisa siia oma tutvustus ..."><?php echo $myDescription; ?></textarea>
    <br>
    <label>Minu valitud taustavärv: </label><input name="bgcolor" type="color" value="<?php echo $_SESSION["bgColor"]; ?>"><br>
    <label>Minu valitud tekstivärv: </label><input name="txtcolor" type="color" value="<?php echo $_SESSION["txtColor"]; ?>"><br>
    <input name="submitProfile" type="submit" value="Salvesta profiil"><span><?php echo $notice; ?></span>
  </form>

    <hr>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label>Sisesta vana parool:</label><br>
    <input name="oldPassword" type="text" value="<?php echo $oldPassword; ?>"><br>
    
    <label>Uus salasõna:</label><br>
    <input name="newPassWord" type="text"><br>

    <label>Uus salasõna uuesti:</label><br>
    <input name="confirmPassword" type="text"><br>
    
    <input name="updatePassFrom" type="submit" value="Uuenda parool">
  </form>
  <hr>
  
</body>
</html>