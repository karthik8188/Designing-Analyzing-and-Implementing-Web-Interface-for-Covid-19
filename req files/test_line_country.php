<!DOCTYPE html>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">  
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">  

<?php include "config.php";
?>
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
<br>
<div id="chart_div"  class="container-fluid" style="align-items: center;padding-left:170px; "></div>
