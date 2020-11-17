<!DOCTYPE html>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">  
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">  
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
    <a href="table.php" class="w3-bar-item w3-button w3-wide">STATS</a>

    <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="w3_open()">
      <i class="fa fa-bars"></i>
    </a>
  </div>
</div>
<?php include "../conection.php";
?>
<br>
<div  class="container-fluid" style="align-items: center;padding-left:170px;"  >
    <br>
<select type="text" class="ui-selectmenu-button ui-selectmenu-button-closed ui-corner-all ui-button ui-widget" name="country" id='country' autofocus>
    <?php
    $sql =mysqli_query($con,"select distinct(Country) from virus_agg");
    echo "<option value=''>Select</option>";	
    while ($row=$sql->fetch_assoc()){
        if($row['Country']!='US' && $row['Country']!='China' && $row['Country']!='Austria' && $row['Country']!='Australia' && $row['Country']!='Canada' && $row['Country']!='France' && $row['Country']!='Taiwan'){
            echo "<option value='".$row['Country']."'>".$row['Country']."</option>";

        }
    }
    ?>
    </select>
    <!--input type="button" value="submit" onclick="runquery()" /-->
    <input type="button" class="ui-button ui-corner-all ui-widget" value="Generate" onclick="runquery('country')"/>

</div>
<script>

function runquery(cou){
 google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);
   
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "all_data.php", false);
    ajax.send();



    ajax.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            
        }
        return data;
    };

function drawChart() {
      

    var arr1= [
        ["Date", "Count"],
          ];
          var data= ajax.onreadystatechange();

          var arr5 = [];
        
var sel = document.getElementById(cou);
var country = sel.options[sel.selectedIndex].value;
          for(i=0; i<data.length; i++){
              if(data[i].Country==country){
                  arr5.push([data[i].Date,Number(data[i].Confirmed)]);
              }
          }
          arr5=arr1.concat(arr5);
          //document.write(data[0].Continents);

          //document.write(typeof(arr5[0][1]));

          var data = google.visualization.arrayToDataTable(arr5);
      var options = {
        title: 'Confirmed Cases in '.concat(country),

        width: 900,
        height: 500,
        hAxis: {
          title: 'Date',
          titleTextStyle: {
                            bold: true,
                            italic: false }
        },
        vAxis: {
          title: 'Count',
          titleTextStyle: {
                            bold: true,
                            italic: false }
        },
        backgroundColor: '#f1f8e9'
      };

      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }}
</script>
<br>
<div id="chart_div"  class="container-fluid" style="align-items: center;padding-left:170px; "></div>
</html>
