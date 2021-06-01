<?php

$servername = "localhost";
$username = "root";
$password = "";
$db="importexportcn";

// Create connection
$conn = new mysqli($servername, $username, $password,$db);

$Fname=$FnameErr=$Lname=$LnameErr=$Nname=$NnameErr=$mail=$mailErr=$pass=$passErr=$type=$typeErr="";
$birth=$_POST["Birthday"];
$company=$_POST["company"];
$vat=$_POST["vat"];
$address=$_POST["address"];
$city=$_POST["city"];
$cap=$_POST["cap"];
$country=$_POST["country"];
$tel=$_POST["mobile"];
$FinalAddress=$address.','.$city.','.$cap;
echo "$FinalAddress";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty($_POST["Fname"])) {
    $FnameErr = "First Name is required";
  } else {
    $Fname = test_input($_POST["Fname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$Fname)) {
      $FnameErr = "Only letters and white space allowed";
    }
  }

  if (empty($_POST["Lname"])) {
    $LnameErr = "Last Name is required";
  } else {
    $Lname = test_input($_POST["Lname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$Lname)) {
      $LnameErr = "Only letters and white space allowed";
    }
  }
  
  if (empty($_POST["Nname"])) {
    $NnameErr = "Nick Name is required";
  } else {
    $Nname = test_input($_POST["Nname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$Nname)) {
      $NnameErr = "Only letters and white space allowed";
    }
  }

  if (empty($_POST["pass"])) {
    $passErr = "Nick Name is required";
  } else {
    $pass = test_input($_POST["pass"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$pass)) {
      $passErr = "Only letters and white space allowed";
    }
  }
  if (empty($_POST["mail"])) {
    $mailErr = "Email is required";
  } else {
    $mail = test_input($_POST["mail"]);
    // check if e-mail address is well-formed
    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
      $mailErr = "Invalid email format";
    }
  }

  if (empty($_POST["type"])) {
    $typeErr = "Type is required";
  } else {
    $type = test_input($_POST["type"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


//Add Utente------------------------------------------------------------------------------------------------------------------

$sql = "INSERT INTO utente (mail,password,nick,type)
VALUES ('$mail','$pass','$Nname','$type')";
if ($conn->query($sql) === TRUE) {
  echo "New record created successfully"."<br>";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}


//ADD Privato o Impresa--------------------------------------------------------------------------------------------
$sql= "SELECT Max(id) as Mid FROM utente WHERE utente.mail='$mail'";
$id=0;
$ris = $conn -> query($sql);
$row = mysqli_fetch_assoc($ris);
$id=$row["Mid"];
echo "$id";

if($type=='Private'){
  $sql = "INSERT INTO privato (nome,cognome,residenza,tel,id)
  VALUES ('$Fname','$Lname','$FinalAddress','$tel','$id')";
}else{
  $sql = "INSERT INTO impresa (VAT,ragione_sociale,sede,nazionalità,recapito,id)
  VALUES ('$vat','$company','$FinalAddress','$country','$tel','$id')";
  
}
if ($conn->query($sql) === TRUE) {
  echo "New record created successfully"."<br>";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

//Update FK utente ------------------------------------------------------------------------------------------------------
$query="SELECT Max(identificativo) as Mide FROM privato WHERE privato.id='$id'";
  $identificativo=0;
  $ris = $conn -> query($query);
  $row = mysqli_fetch_assoc($ris);
  $identificativo=$row["Mide"];
  echo "$identificativo";


if($type=='Private'){
$query= "UPDATE utente SET utente.identificativo='$identificativo' WHERE utente.id='$id'";
}else{
$query= "UPDATE utente SET utente.Piva='$vat' WHERE utente.id='$id'";
}
if($conn->query($query)=== TRUE){
  echo "success update"."<br>";
}else{
  echo "failed: ".$conn->error;
}

session_start();
header("Refresh: 0; url='index.php'");

$conn->close();
?>

