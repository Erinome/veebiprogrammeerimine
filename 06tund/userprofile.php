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

  if(isset($_SESSION['bgcolor'])) {
    $mybgcolor = $_SESSION['bgcolor'];
  }

  if(isset($_SESSION['txtcolor'])) {
    $mytxtcolor = $_SESSION['txtcolor'];
  }
  $userid = 0;
  if(isset($_SESSION["userID"]) AND !empty($_SESSION["userID"])) {
    $userid = $_SESSION["userID"];
  }

  $mydescription = NULL;
  $mybgcolor = NULL;
  $mytxtcolor = NULL;
  $info = NULL;

  $username = $_SESSION["userFirstname"] ." " .$_SESSION["userLastname"];

  if(isset($_POST["submitProfile"])) {

    if(isset($_POST["description"]) AND !empty($_POST["description"])) {
      $mydescription = $_POST["description"];
    }

    if(isset($_POST["bgcolor"]) AND !empty($_POST["bgcolor"])) {
      $mybgcolor = $_POST["bgcolor"]; ## Siin võtame postist ja panema muutujasse mybgcolor
      $_SESSION['bgcolor'] = $mybgcolor;
    }

    if(isset($_POST["txtcolor"]) AND !empty($_POST["txtcolor"])) {
      $mytxtcolor = $_POST["txtcolor"];
      $_SESSION['txtcolor'] = $mytxtcolor;
    }

    $info = addProfile($userid, $mydescription, $mybgcolor, $mytxtcolor);

  }

  #$vöö = checkProfilebyID($userid);

  require("header.php");

?>

<style>
  body{
    background-color: <?php $mybgcolor ?>; 
    color: #000000;
  } 
</style>

<body>
  <?php echo $mybgcolor ?>
  <?php echo $mytxtcolor ?>
 
  <?php echo $info; ?>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label>Minu kirjeldus</label><br>
    <textarea rows="10" cols="80" name="description"><?php echo $mydescription; ?></textarea>
    <br>
    <label>Minu valitud taustavärv: </label><input name="bgcolor" type="color" value="<?php echo $mybgcolor; ?>"><br>
    <label>Minu valitud tekstivärv: </label><input name="txtcolor" type="color" value="<?php echo $mytxtcolor; ?>"><br>
    <input name="submitProfile" type="submit" value="Salvesta profiil">
  </form>


</body>
</html>