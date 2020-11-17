<!DOCTYPE html>
<html>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}

body, html {
  height: 100%;
  line-height: 1.8;
}

/* Full height image header */
.bgimg-1 {
  background-position: center;
  background-size: cover;
  background-image: url("images/mac.jpg");
  min-height: 100%;
}

.w3-bar .w3-button {
  padding: 16px;
}
</style>
<body>

<!-- Navbar (sit on top) -->
<div class="w3-top">
  <div class="w3-bar w3-white w3-card" id="myNavbar">
    <a href="../front.php" class="w3-bar-item w3-button w3-wide">HOME</a>
    

    <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="w3_open()">
      <i class="fa fa-bars"></i>
    </a>
  </div>
</div>
<header class="w3-container w3-red w3-center" style="padding: 10px 16px">
  <h1 class="w3-margin w3-jumbo">Admin Login</h1>
</header>

<body>

<div style="padding-top: 20px">
	
	<form action="adminLogin.php" method="post">
		<table align='center'>
			<tr>
				<td>Username/Mail</td><td><input type="text" name="user_name" required></td>
			</tr>
			<tr>
				<td>Password</td><td><input type="password" name="password" required></td>
			</tr>
			<tr>
			<td></td>	<td align="center" style="padding-top: 10px"><input type="submit" name="Login" value="Login"></td>
                              
			</tr>
              
			

		</table>
	</form>
</div>
</body>
</html>
<?php
include '../conection.php';
if(isset($_POST['Login']))
{
	$uname=$_POST['user_name'];
	$pword=$_POST['password'];
	$query="SELECT * from admin where (user_name='$uname' or mail='$uname')  and password='$pword' limit 1" or die("Failed to query database ".mysql_error());
	$run=mysqli_query($con,$query);
	$row=mysqli_num_rows($run);
	if($row<1)
	{
		?>
		<script>
			alert('username and password not match');
			window.open('adminLogin.php','_self');
		</script>_
		<?php
	}
	else
	{
		$data=mysqli_fetch_assoc($run);
		session_start();
        $_SESSION['Uid']=$uname;
        header('location:adminDash.php');
	}
}
?>