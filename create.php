<?php
session_start();
$user="";
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
  
$user=$_SESSION["username"];
$title=$_POST['Title'];
$msg=$_POST['msg'];
$target_dir = "../bootstrap-shop/themes/images/Forum/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["file"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.<br>";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["file"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.<br>";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
$sql="SELECT utente.id FROM utente WHERE nick='$user'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$id=$row['id'];
$title=$_POST['Title'];
$content=$_POST['msg'];
$date= date("Y-m-d H:i:s");  
$filename=basename($_FILES["file"]["name"]);
echo"$filename<br>";
$query="INSERT INTO post (titolo, data, id, descrizione, views,url) VALUES ('$title','$date','$id','$content','0','$filename')";
if ($conn->query($query) === TRUE) {
  echo "New record created successfully";
  header("Refresh: 0; url='forum.php'");
} else {
  echo "Error: " . $query . "<br>" . $conn->error;
  header("Refresh: 0; url='forum.php'");
  $conn.close();
}
}else{
echo "Must Log in";
header("Refresh: 0; url='login.php'");
}
?>