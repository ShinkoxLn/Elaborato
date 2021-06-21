<?php
session_start();
$username="";
if(isset($_SESSION["username"])){
    $servername = "localhost";
	$username = "root";
	$password = "";
	$db="importexportcn";
	
	// Create connection
	$conn = new mysqli($servername, $username, $password,$db);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	  }

$username=$_SESSION["username"];
$Qty=$_POST['Qty'];
$query="SELECT * FROM utente WHERE utente.nick='$username'";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$idUtente=$row['id'];
$id=$_GET["id"];
echo $id;
$query="SELECT * FROM prodotto WHERE prodotto.CodiceProdotto='$id'";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$prezzo=$row['prezzo']*$Qty;
$sql="INSERT INTO `carrello`( `quantità`, `prezzo`, `id`, `CodiceProdotto`) VALUES ('$Qty','$prezzo','$idUtente','$id')";
$result = $conn->query($sql);
echo"done";
header("Refresh: 0; url='product_summary.php'");
}else{
    header("Refresh: 0; url='login.php'");
}

?>