<!DOCTYPE html>
<html lang="en">
<title>add new cases</title>
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
  <h1 class="w3-margin w3-jumbo">Adding and Updating New Cases</h1>
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
include '../conection.php';
?>
<div>
<form method="post" action="addNewCases.php">
	<table align="center" border="1" style="width:70%; margin-top:40px;">
		<tr>
			<th>Continent</th>
			<td  align="left">
			<select type="text" name="Continents" align="center" required">
        	<option value="">Select</option>
        	<option value="Asia">Asia</option>
        	<option value="Africa">Africa</option>
        	<option value="Europe">Europe</option>
        	<option value="North_America">North_America</option>
        	<option value="South_America">South_America</option>
        	<option value="Australia">Australia</option>
        	<option value="Others">Others</option>
        	</select>
            </td>
		</tr>
		<tr>
			<th>Country</th>
			<td  align="left">
			<select name="Country" required>
			<?php
			$sql =mysqli_query($con,"select distinct(Country) from virus_agg");
			echo "<option value=''>Select</option>";	
			while ($row=$sql->fetch_assoc()){
				echo "<option value=' ".$row['Country']." '>".$row['Country']."</option>";
			}
			?>
			</select>
			</td>
		</tr>
		<tr>
			<th>State</th>
			<td  align="left">
			<select name="State" required>
			<?php
			$sql =mysqli_query($con,"select distinct(State) from virus_agg");
			echo "<option value=''>Select</option>";
			while ($row=$sql->fetch_assoc()){
				echo "$row";
				echo "<option value=' ".$row['State']." '>".$row['State']."</option>";
			}
			?>
			</select>
			</td>
		</tr>
		<tr>
			<th>Confirmed Cases</th>
			<td><input type="text" name="Confirmed" placeholder="Enter confirmed cases " required></td>
		</tr>
		<tr>
			<th>Recovered Cases</th>
			<td><input type="text" name="Recovered" placeholder="Enter Recovered cases" required></td>
		</tr>
		<tr>
			<th>Deaths</th>
			<td><input type="text" name="Deaths" placeholder="Enter deaths" required></td>
		</tr>
		<tr>
			<th>Date</th>
			<?php date_default_timezone_set("America/New_York");?>
			<td><input type="date" name="Date" value=<?php echo date('Y-m-d');?> readonly></td>
		</tr>
			<td colspan="2" align="center"><input type="submit" name="submit" value="Submit"></td>
		</tr>
    </table>
</form>
</body>
</html>
<?php
   if(isset($_POST['submit']))
   {
   	include('../conection.php');
   	$continents=$_POST['Continents'];	
   	$country=$_POST['Country'];
   	$state=$_POST['State'];
   	$confirmed=$_POST['Confirmed'];
   	$recovered=$_POST['Recovered'];
   	$deaths=$_POST['Deaths'];
   	$date=$_POST['Date'];


   	$query_sel_agg="select * from virus_agg where Date<=TRIM('$date') and Country=TRIM('$country') and State=TRIM('$state') and Continents=TRIM('$continents') order by Date desc limit 1";  //selecting the data with lastest updated info
	$run_sel_agg=mysqli_query($con,$query_sel_agg);
	$row_sel_agg=$run_sel_agg->fetch_assoc();

	$date_agg=$row_sel_agg['Date'];
	$confirmed_agg=$confirmed+$row_sel_agg['Confirmed'];
	$recovered_agg=$recovered+$row_sel_agg['Recovered'];
	$deaths_agg=$deaths+$row_sel_agg['Deaths'];

	if($date==$date_agg){	//if condition for updating if already data exists for current day

    		$query_update="update virus_agg set Confirmed='$confirmed_agg', Recovered='$recovered_agg', Deaths='$deaths_agg' where Date=trim('$date') and Country=trim('$country') and State=trim('$state') and Continents=trim('$continents')";
    		if(mysqli_query($con, $query_update)){

    			?>
   			<script>
   				alert('Data entered successfully');  			
   			</script>	
   			<?php
    		}
    		
    	}
    	else{


    		$query_ins="INSERT INTO virus_agg (Country,State,Date,Confirmed,Recovered,Deaths,Continents) VALUES (trim('$country'),trim('$state'),trim('$date'),'$confirmed_agg','$recovered_agg','$deaths_agg',trim('$continents'))";
    		if(mysqli_query($con,$query_ins)){
    			?>
   			<script>
   				alert('Data entered successfully');  			
   			</script>	
   		<?php
    	}
    	}
   }
?>
