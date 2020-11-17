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

   if(isset($_POST['submit']))
   {
   	include('../conection.php');
   	$per_id=$_POST['person'];
   	$stat=$_POST['status'];
    if($stat=='Reject')
    {
        $query_del="delete from new_cases where person_id='$per_id'";
        $run_del=mysqli_query($con,$query_del);
        header('location:pending_request.php');
    }
    else
    {
    	$query_sel="select * from new_cases where person_id='$per_id'";
    	$run_sel=mysqli_query($con,$query_sel);
    	$row=$run_sel->fetch_assoc();
    	$country=$row['country'];
    	$cont=$row['continents'];
    	$state=$row['state'];
    	$confirmed=$row['confirmed'];
    	$recovered=$row['recovered'];
    	$deaths=$row['deaths'];
    	$date=$row['date'];
        //echo "$country,$cont,$state,$date";
    	$query_sel_agg="select * from virus_agg where Date<=TRIM('$date') and Country=TRIM('$country') and State=TRIM('$state') and Continents=TRIM('$cont') order by Date desc limit 1";  //selecting the data with lastest updated info
    	$run_sel_agg=mysqli_query($con,$query_sel_agg);
    	$row_sel_agg=$run_sel_agg->fetch_assoc();
    	#echo "$row_sel_aggg['Confirmed']";
    	$date_agg=$row_sel_agg['Date'];
    	$confirmed_agg=$confirmed+$row_sel_agg['Confirmed'];
    	$recovered_agg=$recovered+$row_sel_agg['Recovered'];
    	$deaths_agg=$deaths+$row_sel_agg['Deaths'];
    	//echo "$confirmed_agg,$recovered_agg,$deaths_agg";

    	if($date==$date_agg){	//if condition for updating if already data exists for current day

    		$query_update="update virus_agg set Confirmed='$confirmed_agg', Recovered='$recovered_agg', Deaths='$deaths_agg' where Date=trim('$date') and Country=trim('$country') and State=trim('$state') and Continents=trim('$cont')";
    		if(mysqli_query($con, $query_update)){

    			$query_del="delete from new_cases where person_id='$per_id'";
        		$run_del=mysqli_query($con,$query_del);
    			header('location:pending_request.php');
    		}
    		
    	}
    	else{


    		$query_ins="INSERT INTO virus_agg (Country,State,Date,Confirmed,Recovered,Deaths,Continents) VALUES (trim('$country'),trim('$state'),trim('$date'),'$confirmed_agg','$recovered_agg','$deaths_agg',trim('$cont'))";
    		if(mysqli_query($con,$query_ins)){
    		$query_del="delete from new_cases where person_id='$per_id'";
        	$run_del=mysqli_query($con,$query_del);
        	header('location:pending_request.php');
    	}
    	}
    	
    }
   }
?>