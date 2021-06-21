<?php
session_start();
$user="";
if(isset($_SESSION["username"])){
$user=$_SESSION["username"];
$servername = "localhost";
$username = "root";
$password = "";
$db="importexportcn";
			
// Create connection
$conn = new mysqli($servername, $username, $password,$db);
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
	}
    $idPost=$_GET['id'];
    $sql="SELECT utente.id FROM utente WHERE nick='$user'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $idUtente=$row['id'];
    $content=$_POST['reply'];
    $date= date("Y-m-d H:i:s");  
    $query="INSERT INTO messaggio(data, contenuto, idPost, id) VALUES ('$date','$content','$idPost','$idUtente')";
    if ($conn->query($query) === TRUE) {
        echo "New record created successfully";
        header("Refresh: 0; url='post_details.php?id=$idPost'");
      } else {
        echo "Error: " . $query . "<br>" . $conn->error;
        header("Refresh: 0; url='forum.php?id=$idPost'");
      }
      $conn->close();
      }else{
      echo "Must be Logged in";
      header("Refresh: 0; url='login.php'");
      }
?>