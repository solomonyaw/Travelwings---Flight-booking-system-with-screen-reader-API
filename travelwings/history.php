<?php
include_once"index.html";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>AirLines | History</title>
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

<!--[if lt IE 9]>
<script type="text/javascript" src="js/html5.js"></script>
<style type="text/css">.main, .tabs ul.nav a, .content, .button1, .box1, .top { behavior:url("../js/PIE.htc")}</style>
<![endif]-->
<style>

</style>
</head>

<body id="page2">
  <div class="main">
  
    <!--header -->
 <a href="index.php"><button href="index.php">Go back to homepage</button></a>
    <?php 
  echo '<header>';  
include_once"index1.html";
  include_once 'header.php';
   
echo '<nav>
<ul id="menu">
<li><a href="book.php"><span><span>Book</span></span></a></li>
<li id="menu_active"><a href="history.php"><span><span>History</span></span></a></li>
<li><a href="profile.php"><span><span>Profile</span></span></a></li>';


if($user['isadmin'] == 1) {
  echo '<li><a href="admin.php"><span><span>Admin</span></span></a></li>';
}


echo '<li class="end"><a href="contacts.php"><span><span>Contacts</span></span></a></li>
</ul>
</nav>
</header>';
 ?>
    <!-- / header -->
    <!--content -->
    <section id="content">
      <div class="wrapper pad1">
        <article class="col1">
          <?php include 'offers.php'; ?>
        </article>
        <article class="col2">
          <h3 class="pad_top1">Booked History</h3>
          <div class="tabs">
            <div class="content" style="padding-bottom: 5px;">
              <table style="width: 100%;">
                <tr style="border-bottom: 1px solid #d0d0d0; margin-bottom:5px;">
                  <th style="padding-left:10px;padding-right:10px;"><strong>From</strong></td>
                  <th style="padding-left:10px;padding-right:10px;"><strong>Destination</strong></td>
                  <th style="padding-left:10px;padding-right:10px;"><strong>Departure</strong></td>
                  <th style="padding-left:10px;padding-right:10px;"><strong>Seats</strong></td>
                  <th style="padding-left:10px;padding-right:10px;"><strong>Class</strong></td>
                  <th style="padding-left:10px;padding-right:10px;"><strong>Amount</strong></td>
                </tr>
              <!-- for each entry-->
              <?php
              $bookres = $mysqli->query(sprintf('SELECT flights.startcity AS startcity, flights.endcity AS endcity, flights.starttime AS starttime, bookings.quantity AS quantity, bookings.class AS class, bookings.amount AS amount, bookings.id AS id FROM flights INNER JOIN bookings ON bookings.flightid = flights.id WHERE bookings.userid = %d', $user['id']));
              
              //echo sprintf('SELECT flights.startcity AS startcity, flights.endcity AS endcity, flights.starttime AS starttime, bookings.quantity AS quantity, bookings.class AS class, bookings.amount AS amount, bookings.id AS id FROM flights INNER JOIN bookings ON bookings.flightid = flights.id WHERE bookings.userid = %d', $user['id']);
              
              
              $count = 0;
              
              while($booking = $bookres->fetch_array()) {
                //$flightres = $mysqli->query(sprintf('SELECT * FROM flights WHERE id = %d', $booking['flightid']));
                //$flight = $flightres->fetch_array();
                ++$count;
                
                echo '<tr  style="margin: 15px;">
                    <td style="padding-left:10px;padding-right:10px;position:relative;">'.$booking['startcity'].'</td>
                    <td style="padding-left:10px;padding-right:10px;position:relative;">'.$booking['endcity'].'</td>
                    <td style="padding-left:10px;padding-right:10px;position:relative;">'.$booking['starttime'].'</td>
                    <td style="padding-left:10px;padding-right:10px;position:relative;">'.$booking['quantity'].'</td>
                    <td style="padding-left:10px;padding-right:10px;position:relative;">'.$booking['class'].'</td>
                    <td style="padding-left:10px;padding-right:10px;position:relative;">'.$booking['amount'].'</td>
                  </tr>
                  <script>
                  function myFunction() {
                    var x;
                    if (confirm("Extra charges of Rs. 1000/- The balance will be credited to your AirLine account. Please book another flight") == true) {                    
                      window.location = "modify.php?bookingid='.$booking['id'].'";
                    }
                  }
                  function myFun() {
                    var x;
                    if (confirm("Extra charges of Rs. 1000/- The balance will be credited to your AirLine account.") == true) {                    
                      window.location = "cancel.php?bookingid='.$booking['id'].'"
                    }
                  }
                  </script>
                  <tr style="margin-bottom:10px;">
                    <td colspan="3" style="padding-left:10px;padding-right:10px;position:relative;"><div class="button1"  onclick="myFunction()"><strong>Modify Booking</strong></div></td>
                    <td colspan="3" style="padding-left:10px;padding-right:10px;position:relative;float:right;"><div class="button1"  onclick="myFun()"><strong>Cancel Booking</strong></div></td>
                  </tr>';
              }
              
              if($count == 0) {
                echo '<tr><td colspan="3"> No flights in booked history </td></tr>';
              }
              ?>
              <!-- Till here -->
              
                </table>
                
            </div>
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
    <script type="text/javascript">
    jQuery(document).ready(function ($) {
      $('#form_4').jqTransform({
        imgPath: 'jqtransformplugin/img/'
      });
    });
    </script>
  </body>
  </html>
