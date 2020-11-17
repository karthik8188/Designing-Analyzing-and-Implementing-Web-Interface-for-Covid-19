<!DOCTYPE html>
<html lang="en">
<title>New Cases</title>
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
  <div class="w3-bar w3-red w3-card w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="front.php" class="w3-bar-item w3-button w3-padding-large w3-white">Home</a>
  </div>
</div>
<header class="w3-container w3-red w3-center" style="padding:30px 16px">
  <h1 class="w3-margin w3-jumbo">Report New Cases</h1>
</header>
<?php
include 'conection.php';
?>
<div>
<form method="post" action="newCases.php" enctype="multipart/form-data">
	<table align="center" border="1" style="width:70%; margin-top:40px;">
		<tr>
			<th>Name</th>
			<td><input type="INTEGER" name="person_name" placeholder="Enter Name" required></td>
		</tr>
		<tr>
			<th>Email</th>
			<td><input type="text" name="person_email" placeholder="Enter Email" required></td>
		</tr>
		<tr>
			<th>Continent</th>
			<td  align="left">
			<select type="text" name="continents" align="center" required">
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
			<select name="country" required>
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
			<select name="state" required>
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
			<td><input type="text" name="confirmed" placeholder="Enter confirmed cases " required></td>
		</tr>
		<tr>
			<th>Recovered Cases</th>
			<td><input type="text" name="recovered" placeholder="Enter Recovered cases" required></td>
		</tr>
		<tr>
			<th>Deaths</th>
			<td><input type="text" name="deaths" placeholder="Enter deaths" required></td>
		</tr>
		<tr>
			<th>Date</th>
			<?php date_default_timezone_set("America/New_York");?>
			<td><input type="date" name="date" value=<?php echo date('Y-m-d');?> readonly></td>
		</tr>
		<tr>
			<th>Phone Number</th>
			<td><input type="text" name="phone_number" placeholder="Enter phone number"></td>
		</tr>
		<tr>
			<th>Source</th>
			<td><input type="text" name="source" placeholder="source" required></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><input type="submit" name="submit" value="Submit"></td>
		</tr>
    </table>
</form>
</body>
</html>
<?php
   if(isset($_POST['submit']) && !empty($_POST['person_name']))
   {
   	include('conection.php');
   	$person_name=$_POST['person_name'];
   	$person_email=$_POST['person_email'];
   	$continents=$_POST['continents'];	
   	$country=$_POST['country'];
   	$state=$_POST['state'];
   	$confirmed=$_POST['confirmed'];
   	$recovered=$_POST['recovered'];
   	$deaths=$_POST['deaths'];
   	$date=$_POST['date'];
   	$phone_number=$_POST['phone_number'];
   	$source=$_POST['source'];
   	$query="INSERT INTO new_cases (person_name,person_email,continents,country,state,confirmed,recovered,deaths,date,phone_number,source) VALUES ('$person_name','$person_email','$continents','$country','$state','$confirmed','$recovered','$deaths','$date','$phone_number','$source')";
   	$run=mysqli_query($con,$query);
   	
   	if($run==true)
   	{
   		?>
   		<script>
   			alert('Data entered successfully');  			
   		</script>	
   	<?php
   	}
   }
?>
</div>