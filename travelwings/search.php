<!DOCTYPE html>
<html lang="en">
<head>
<title>AirLines | Services</title>
<meta charset="utf-8">
<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
<link rel="stylesheet" href="css/layout.css" type="text/css" media="all">
<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
<script type="text/javascript" src="js/jquery-1.5.2.js" ></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/cufon-replace.js"></script>
<script type="text/javascript" src="js/Cabin_400.font.js"></script>
<script type="text/javascript" src="js/tabs.js"></script>
<script type="text/javascript" src="js/jquery.jqtransform.js" ></script>
<script type="text/javascript" src="js/jquery.nivo.slider.pack.js"></script>
<script type="text/javascript" src="js/atooltip.jquery.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<style type="text/css">
#loginbtn:hover {
  color: blue;
}
</style>
<!--[if lt IE 9]>
<script type="text/javascript" src="js/html5.js"></script>
<style type="text/css">.main, .tabs ul.nav a, .content, .button1, .box1, .top { behavior:url("../js/PIE.htc")}</style>
<![endif]-->
</head>
<body id="page4">
<div class="main">
  <!--header -->


<?php 
  echo '<header>'; 
  include"index.html    ";
  include "index1.html"; 

  include_once 'header.php';
  
echo '<nav>
<ul id="menu">
<li><a href="book.php"><span><span>Book</span></span></a></li>
<li><a href="history.php"><span><span>History</span></span></a></li>
<li><a href="profile.php"><span><span>Profile</span></span></a></li>';


if($user['isadmin'] == 1) {
  echo '<li><a href="admin.php"><span><span>Admin</span></span></a></li>';
}


echo '<li class="end"><a href="contacts.php"><span><span>Contacts</span></span></a></li>
</ul>
</nav>
</header>';



if(isset($_POST['book_submit'])) {
  
  
  $flightid =  $_POST['book_submit'];
 
 
$quantity = $_POST['quantity'];
$class = $_POST['class'];

$flights = $mysqli->query('SELECT * FROM flights WHERE id = "' . $flightid . '"');
$flight = $flights->fetch_array();



if($class = 'economy') {
  $fare = $_POST['econfare'];
  
  
 for($cnt = 0; $cnt < $quantity; ++$cnt) {
  $key = 'econseat' . $cnt;
  $seatno = $_POST[$key];
  
  $mysqli->query(sprintf('UPDATE seats SET userid = %d, isbooked = 1 WHERE seatno = %d AND flightid = %d', $user['id'], $seatno, $flightid));
  
  
  
  
 }
  
} else if($class = 'first') {
  $fare = $_POST['firstfare'];
  
   
 for($cnt = 0; $cnt < $quantity; ++$cnt) {
  $key = 'firstseat' . $cnt;
  $seatno = $_POST[$key];
  
  $mysqli->query(sprintf('UPDATE seats SET userid = %d, isbooked = 1 WHERE seatno = %d AND flightid = %d', $user['id'], $seatno, $flightid));
  
  
 }
  
  
} else {
  $fare = $_POST['bizfare'];
  
   
 for($cnt = 0; $cnt < $quantity; ++$cnt) {
  $key = 'bizseat' . $cnt;
  $seatno = $_POST[$key];
  
  $mysqli->query(sprintf('UPDATE seats SET userid = %d, isbooked = 1 WHERE seatno = %d AND flightid = %d', $user['id'], $seatno, $flightid));
  
  
 }
  
  
}  
  
$amount = $fare * $quantity;

echo $user['id'] . $flightid . $amount . $class . $quantity;

$prep_stmt = "INSERT INTO bookings (id, userid, flightid, amount, class, quantity) VALUES (NULL, ?, ?, ?, ?, ?)";
        if ($insert_stmt = $mysqli->prepare($prep_stmt)) {
            $insert_stmt->bind_param('iiisi', $user['id'], $flightid, $amount, $class, $quantity);
            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                //header('Location: ../error.php?err=Registration failure: INSERT');
                echo 'SQL Error, could not book ticket';
            }
            else { 
            
              
                echo 'works!'; 
                
            }
}
        

$balance = $user['balance'] - $amount;

$mysqli->query(sprintf('UPDATE users SET balance = %d where id = %d', $balance, $user['id']));

  header('Location: history.php');

}
  
  

?>
 
 
 
 
  <!-- / header -->
  <!--content -->
  <section id="content">
    <div class="wrapper pad1">
      <article class="col1">
        <?php include 'offers.php'; ?>
      </article>
      <article class="col2">
        <h3 class="pad_top1">Search Query</h3>
        <div class="content" align="center">
          <table style="margin-left: 20px; margin-right: 20px;">
          <br>
            <tr>
              <td style="padding-left:20px;padding-right:20px;"><strong>Start:</strong></td>
              <td style="padding-left:20px;padding-right:20px;"><?php echo $_POST['startcity']; ?></td>
            </tr>
            <tr>
              <td style="padding-left:20px;padding-right:20px;"><strong>Destination:</strong></td>
              <td style="padding-left:20px;padding-right:20px;"><?php echo $_POST['endcity']; ?></td>
            </tr>
            <tr>
              <td style="padding-left:20px;padding-right:20px;"><strong>Departure:</strong></td>
              <td style="padding-left:20px;padding-right:20px;"><?php echo $_POST['startdate']; ?></td>
            </tr>
            <?php if(!empty($_POST['enddate'])) {
            echo '<tr>
              <td style="padding-left:20px;padding-right:20px;"><strong>Return:</strong></td>
              <td style="padding-left:20px;padding-right:20px;">' . $_POST['enddate'] .' </td>
            </tr>';
          }
            ?>
            <tr>
              <td style="padding-left:20px;padding-right:20px;"><strong>Class:</strong></td>
              <td style="padding-left:20px;padding-right:20px;"><?php echo $_POST['class']; ?></td>
            </tr>
            <tr>
              <td style="padding-left:20px;padding-right:20px;"><strong>Adults:</strong></td>
              <td style="padding-left:20px;padding-right:20px;"><?php echo $_POST['adults']; ?></td>
            </tr>
            <tr>
              <td style="padding-left:20px;padding-right:20px;"><strong>Children:</strong></td>
              <td style="padding-left:20px;padding-right:20px;"><?php echo $_POST['children']; ?></td>
            </tr>
          </table>            
          </div>
        
        <h3 class="pad_top1">Search Results</h3>
        <div class="tabs">
              <?php
                            
              $flightres = $mysqli->query("SELECT * FROM flights WHERE startcity = '" . $_POST['startcity'] . "' AND endcity = '" . $_POST['endcity'] . "' AND starttime LIKE '" . $_POST['startdate'] . "%' ORDER BY starttime ASC");
              //echo "SELECT * FROM flights WHERE startcity = '" . $_POST['startcity'] . "' AND endcity = '" . $_POST['endcity'] . "' AND starttime LIKE '" . $_POST['startdate'] . "%' ORDER BY starttime ASC";
                
                //echo "SELECT * FROM flights WHERE startcity = '" . $_POST['startcity'] . "' AND endcity = '" . $_POST['endcity'] . "' AND starttime LIKE '" . $_POST['startdate'] . "%' ORDER BY starttime ASC";
                
                $quantity = $_POST['adults'] + $_POST['children'];
                $count = 0;
                
              
              while($flight = $flightres->fetch_array()) {
                
                ++$count;
                
                echo '<div class="box1">
                
                <form name="form_1" action="search.php" method="post" accept-charset="utf-8">
                
                <input type="hidden" name="quantity" value="'. $quantity . '"></input>
                <input type="hidden" name="class" value="'. $_POST['class'] . '"></input>
                
                <table style="width: 100%; margin-bottom: 10px;margin-top: 10px;">';
                
                //<!-- for each entry-->
                
                $flight['starttime'] = substr($flight['starttime'], -8, 8); //we wanna show only the time since user selected the date
                $flight['endtime'] = substr($flight['endtime'], -8, 8);
                
                echo '
                <tr style="border-bottom: 1px solid #d0d0d0;">

                <th style="padding-left:10px;padding-right:10px;"><strong>Timing</strong></th>
                <th style="padding-left:10px;padding-right:10px;"><strong>Class</strong></th>
                <th style="padding-left:10px;padding-right:10px;"><strong>Availability</strong></th>
                <th style="padding-left:10px;padding-right:10px;"><strong>Seats</strong></th>
                <th style="padding-left:10px;padding-right:10px;"><strong>Fare</strong></th>
                
              </tr>';
              
              echo '<tr>';
                echo '<td><strong>Departure: </strong>' . $flight['starttime'] . '</td>';
                echo '<td><input style="position:relative;" type="radio" name="class" value="economy" checked>Economy</input></td>';
                
                echo '<td align="center">' . $flight['econavl'];
                
                echo '<td align="center">';
                
                for($cnt = 0; $cnt < $quantity; ++$cnt) {
                $econseats = $mysqli->query('SELECT seatno FROM seats WHERE flightid = "' . $flight['id'] . '" AND class = "economy" AND isbooked = "0"');
                
                echo '<select name="econseat' . $cnt . '">';
                        while($seat= $econseats->fetch_array()) {
                         echo '<option value="' . $seat['seatno'] . '">'. $seat['seatno'] . '</option>';
                       }
                       
                echo '</select>';
                
                }
                echo '</td>';
                
                echo '<td align="right">' . $flight['econfare'] . '</td>';
                echo '<input type="hidden" name="econfare" value="'. $flight['econfare'] . '"></input>';
              
              echo '</tr>';
              
              echo '<tr>';
                echo '<td><strong>Arrival: </strong>' . $flight['endtime'] . '</td>';
                echo '<td><input style="position:relative;" type="radio" name="class" value="business" checked>Business</input></td>';
                
                echo '<td align="center">' . $flight['bizavl'];
                
                echo '<td align="center">';
                for($cnt = 0; $cnt < $quantity; ++$cnt) {
                $bizseats = $mysqli->query('SELECT seatno FROM seats WHERE flightid = "' . $flight['id'] . '" AND class = "business" AND isbooked = "0"');
                
                echo '<select name="bizseat' . $cnt . '">';
                        while($seat= $bizseats->fetch_array()) {
                         echo '<option value="' . $seat['seatno'] . '">'. $seat['seatno'] . '</option>';
                       }
                       
                echo '</select>';
                
                }
                echo '</td>';
                
                echo '<td align="right">' . $flight['bizfare'] . '</td>';
                echo '<input type="hidden" name="bizfare" value="'. $flight['bizfare'] . '"></input>';
                
              echo '</tr>';
              
              
              
              echo '<tr>';
                echo '<td></td>';
                echo '<td><input style="position:relative;" type="radio" name="class" value="first" checked>First</input></td>';
                
                echo '<td align="center">' . $flight['firstavl'];
                
                echo '<td align="center">';
                for($cnt = 0; $cnt < $quantity; ++$cnt) {
                $firstseats = $mysqli->query('SELECT seatno FROM seats WHERE flightid = "' . $flight['id'] . '" AND class = "first" AND isbooked = "0"');
                
                echo '<select name="firstseat' . $cnt . '">';
                        while($seat= $firstseats->fetch_array()) {
                         echo '<option value="' . $seat['seatno'] . '">'. $seat['seatno'] . '</option>';
                       }
                       
                echo '</select>';
                
                }
                echo '</td>';
                
                echo '<td align="right">' . $flight['firstfare'] . '</td>';
                echo '<input type="hidden" name="bizfare" value="'. $flight['bizfare'] . '"></input>';
              
              echo '</tr>';
                
              
                  
                  echo '</table>';
                  echo '<div class="right relative"><button type="submit" name="book_submit" value="' . $flight['id'] . '" class="button1" id="loginbtn">Book</button></div>';
                  echo '</form>';
                  
                  
                  
                  echo '</div><br><br><br>';
              }
              
              if($count == 0) {
                
              echo '<script>
                  alert("No flights are available between the given cities on that day");         
                  window.location = "book.php";
                  </script>';               
                
              }
              
              ?>
        </div>
      </article>
    </div>
  </section>
  <!--content end-->
  <!--footer -->
  <footer>
    <?php include_once('footer.php'); ?>
  </footer>
  <!--footer end-->
</div>
<script type="text/javascript">Cufon.now();</script>
</body>
</html>
