<!DOCTYPE html>
<html lang="en">
<title>Pending Requests</title>
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
    <a href="adminDash.php" class="w3-bar-item w3-button w3-wide">ADMIN PAGE</a>
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
  <h1 class="w3-margin w3-jumbo">Pending Requests</h1>
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
<?php
    include('../conection.php');	
    $query="select * from new_cases";
    echo "<div style='padding-top: 20px'><table align='center' border='1'>";
    echo "<tr>";
    echo "<th align='center'>"; echo "ID"; echo"</th>";
    echo "<th align='center'>"; echo "Name"; echo"</th>";
    echo "<th align='center'>"; echo "Email"; echo"</th>";
    echo "<th align='center'>"; echo "Continent"; echo"</th>";
    echo "<th align='center'>"; echo "Country"; echo"</th>";
    echo "<th align='center'>"; echo "State "; echo"</th>";
    echo "<th align='center'>"; echo "Confirmed"; echo"</th>";
    echo "<th align='center'>"; echo "Recovered"; echo"</th>";
    echo "<th align='center'>"; echo "Deaths"; echo"</th>";
    echo "<th align='center'>"; echo "Date"; echo"</th>";
    echo "<th align='center'>"; echo "Phone Number"; echo"</th>";
    echo "<th align='center'>"; echo "Source"; echo"</th>";
    echo "</tr>";
    $run=mysqli_query($con,$query);
    $row=mysqli_fetch_assoc($run);
    if(mysqli_num_rows($run) > 0)
    {
    while($row=mysqli_fetch_assoc($run))
    {
        echo "<tr>";
        echo "<td>"; echo $row['person_id']; echo "</td>";
        echo "<td>"; echo $row['person_name']; echo "</td>";
        echo "<td>"; echo $row['person_email']; echo "</td>";
        echo "<td>"; echo $row['continents']; echo "</td>"; 
        echo "<td>"; echo $row['country']; echo "</td>";
        echo "<td>"; echo $row['state']; echo "</td>";
        echo "<td>"; echo $row['confirmed']; echo "</td>";
        echo "<td>"; echo $row['recovered']; echo "</td>";
        echo "<td>"; echo $row['deaths']; echo "</td>";
        echo "<td>"; echo $row['date']; echo "</td>";
        echo "<td>"; echo $row['phone_number']; echo "</td>";
        echo "<td>"; echo $row['source']; echo "</td>";
        echo "</tr>";
    }
    echo "</table> </div>";
  }
  echo '<div style="padding-top: 25px;">
  <form method="post" align="center" action="LoadDelete.php">
  	ID:<input type="text" name="person"> <br><br>
  	<label>Status:</label>
  	<select type="text" name="status" align="center" ">
        	<option value="">Select</option>
        	<option value="Accept">Accept</option>
        	<option value="Reject">Reject</option>
    </select><br><br>
    <input type="submit" name="submit" value="submit">
	</form>
    </div>';
?>
</html>