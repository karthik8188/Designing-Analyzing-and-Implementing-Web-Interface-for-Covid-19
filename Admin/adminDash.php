<!DOCTYPE html>
<html lang="en">
<title>Admin Dash</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
.w3-bar,h1,button {font-family: "Montserrat", sans-serif}
.fa-anchor,.fa-coffee {font-size:200px}
</style>
<div class="w3-top">
  <div class="w3-bar w3-white w3-card" id="myNavbar">
    <a href="../front.php" class="w3-bar-item w3-button w3-wide">HOME</a>
    <!-- Right-sided navbar links -->
    <div class="w3-right w3-hide-small">
      <a href="logout.php" class="w3-bar-item w3-button">LOGOUT</a>
    </div>
    <!-- Hide right-floated links on small screens and replace them with a menu icon -->

    <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="w3_open()">
      <i class="fa fa-bars"></i>
    </a>
  </div>
</div>
<header class="w3-container w3-red w3-center" style="padding:30px 16px">
  <h1 class="w3-margin w3-jumbo">Admin Board</h1>
</header>
<?php
session_start();
if(isset($_SESSION['Uid']))
{
	echo "";
}
else
{
	header('location:adminLogin.php');
}
?>

<div class="dashboard" align="center">
<a href="pending_request.php" style="font-size: 25px; text-decoration: none;"> 
<img src="../images/img02.JPEG" width="450" height="500" >Pending requests</a>
<a href="addNewCases.php" style="font-size: 25px; text-decoration: none;">
<img src="../images/img01.JPEG" width="450" height="500">Add and update new cases</a>
	   	  
	</div>

