<?php
  require("../../../config_vp2019.php");
  require("functions_main.php"); 
  require("functions_user.php"); 
  $database = "if19_raner_re_1";

  //kui pole sisseloginud
  if(!isset($_SESSION["userID"])) {
      //siis jõuga sisselogimise lehele
    header("Location: page.php");
    exit();
  }

  //väljalogimine
  if (isset($_GET["logout"])) {
    session_destroy();
    header("Location: page.php");
    exit();
  }

  $username = $_SESSION["userFirstname"] ." " .$_SESSION["userLastname"];

  require("header.php");

?>

<body>
  <?php
  echo "<h1>" . $username . " koolitöö leht</h1>";
  ?>
  <p>See leht on loodud koolis õppetöö raames ja ei sisalda tõsiseltvõetavat sisu</p>
  <hr>
  <p><a href="?logout=1">Logi välja!</a> | <a href="userprofile.php">Kasutajaprofiil</a></p>
  <a href="messages.php">Sõnumid</a></p>


</body>
</html>