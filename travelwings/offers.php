<?php
include_once 'db_connect.php';

$startcities = $mysqli->query('SELECT startcity, starttime FROM flights GROUP BY startcity HAVING DATE(starttime) >= DATE(NOW())');


//echo 'SELECT startcity, starttime FROM flights GROUP BY startcity HAVING DATE(starttime) >= DATE(NOW())';
echo '<div class="box1">
          <h2 class="top">Hot Offers of the Week</h2>
          <div class="pad">';
          
          while($start = $startcities->fetch_array()) {
            
            echo '<strong>' . $start['startcity'] . '</strong><br>
            <ul class="pad_bot1 list1">';
            
              $endcities = $mysqli->query(sprintf('SELECT endcity, econfare, starttime FROM flights WHERE startcity = \'%s\' ', $start['startcity']));
              //echo sprintf('SELECT endcity, econfare, starttime FROM flights WHERE startcity = \'%s\' HAVING DATE(starttime) > NOW()', $start['startcity']);
              
              //echo sprintf('SELECT endcity, econfare, starttime FROM flights WHERE startcity = \'%s\' HAVING DATE(starttime) > NOW()', $start['startcity']);
              
              while($end = $endcities->fetch_array()) {
              echo '<li><span class="right color1">from INR ' . $end['econfare'] . '</span><a href="book2.html">' . $end['endcity'] . '</a></li>';
            }
              
            echo '</ul>';
          
          }
          echo '</div>
        </div>';           
?>
