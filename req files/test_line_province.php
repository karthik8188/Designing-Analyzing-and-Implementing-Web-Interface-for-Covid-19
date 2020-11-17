<!DOCTYPE html>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">  

<?php include "config.php";
?>
<!--input type="text" maxlength="10" name="country" placeholder='Enter country' id='country1'/>
<form id="searchform" action="javascript:runquery()" method="get" name="searchform"-->

<select type="text" name="country" id='country'>
    <?php
    $sql =mysqli_query($con,"select distinct(Country) from virus_agg");
    echo "<option value=''>Select</option>";	
    while ($row=$sql->fetch_assoc()){
        echo "<option value='".$row['Country']."'>".$row['Country']."</option>";
    }
    ?>
    </select>
    <!--input type="button" value="submit" onclick="runquery()" /-->
    <input type="button" value="submit" onclick="runquery('country')"/>


<script>

function runquery(cou){
 google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);
   
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "faired_dates.php", false);
    ajax.send();



    ajax.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            
        }
        return data;
    };

function drawChart() {
      

    var arr1= [
        ["Province", "Count"],
          ];
          var data= ajax.onreadystatechange();

          var arr5 = [];
         // var form = document.getElementById('searchform');
	//	var country = form.elements.country.value;
//          var country = document.getElementById('country').value;
var sel = document.getElementById(cou);
var country = sel.options[sel.selectedIndex].value;
          for(i=0; i<data.length; i++){
              if(data[i][0]==country){
                  arr5.push([data[i][1],Number(data[i][3])]);
              }
          }
          arr5=arr1.concat(arr5);
          //document.write(country.trim().length);

          //document.write(typeof(arr5[0][1]));

          var data = google.visualization.arrayToDataTable(arr5);
      var options = {
        width: 900,
        height: 500,
        hAxis: {
          title: 'Province',
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
<div id="chart_div"></div>
