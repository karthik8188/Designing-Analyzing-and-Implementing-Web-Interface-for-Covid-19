<?php
include "../conection.php";

$continentData = mysqli_query($con,"select * from virus_agg ORDER BY Country");



while($row = mysqli_fetch_assoc($continentData)){

    $response[] = $row;
}
echo json_encode($response);

exit;

?>