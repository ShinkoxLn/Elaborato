<?php
$servername = "localhost";
$username = "root";
$password = "";
$db="importexportcn";

// Create connection
$conn = new mysqli($servername, $username, $password,$db);
$mail=$_POST["mail"];
$pass=$_POST["pass"];

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  
  
//Check Exist Utente------------------------------------------------------------------------------------------------------------------
  
  $sql = "SELECT mail,password,nick FROM utente WHERE utente.mail='$mail'AND utente.password='$pass'";
  $ris=$conn->query($sql);
  $row = mysqli_fetch_assoc($ris);
if($row>=1){
  session_start();
    $_SESSION["mail"]=$mail;
    $_SESSION["username"] = $row["nick"];
    $_SESSION["password"] = $pass;
    header("Refresh: 0; url='index.php'");
} else{
    function alert($message){
        echo"<script type='text/javascript'>alert('$message');</script>";
    }
alert("Username/Password Errato");
header("Refresh: 5; url='login.php'");
}
?>
$query
?>