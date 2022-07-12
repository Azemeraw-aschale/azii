<?php 
// database Connection
include("connection.php");
?>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
	<h1>Select Image to Upload</h1>
	<form method='post' action='' enctype='multipart/form-data'>
	<div class="form-group">
	 <input type="file" name="image" id="file" multiple>
	</div> 
	<div class="form-group"> 
	 <input type='submit' name='submit'class="btn btn-primary">
	</div> 
	</form>
<?php
//session_start();
//if(!isset($_SESSION["username"])){
header("location:login.php");}
$account=$_SESSION['account'];
$sql="select *from registration where accountNo=$account";
$result=mysqli_query($conn,$sql);
if($row=mysqli_fetch_assoc($result)){
$firstname=$row['firstname'];
$lastname=$row['lastname'];
$proffession=$row['proffession'];
$account=$row['accountNo'];
if(isset($_POST['submit'])){
	$filename = $_FILES["image"]["name"];
	$file=$_FILES["image"]["tmp_name"];
	$cur="imgfolder/$filename";
	move_uploaded_file($file,$cur);
	//echo "<img src='$currentdir' height='100' width='100'/>"
		// Image db insert sql
		$update = "update registration set image='$cur' where accountNo=$account";
		if(mysqli_query($conn, $update)){
		 header('location:users-profile.php');
		}}
	else 
	echo "thier is no file";}
?>
