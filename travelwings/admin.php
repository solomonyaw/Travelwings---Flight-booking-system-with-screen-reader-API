<?php 
ini_set('display_errors','1'); 
error_reporting(E_ALL);
include_once"index.html";
include"index1.html";

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>AirLine Booking Uganda   | Admin</title>
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
  
  </style>
<!--[if lt IE 9]>
<script type="text/javascript" src="js/html5.js"></script>
<style type="text/css">.main, .tabs ul.nav a, .content, .button1, .box1, .top { behavior:url("../js/PIE.htc")}</style>
<![endif]-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body background="images/dreamliner-airplane_314039.jpg" leftmargin="250px" topmargin="30px" marginwidth="250px" marginheight="30px" id="page4">
  <div class="main">
    <!--header ie Calling for the header page -->
    <?php 
    
    echo '<header>';  
     echo'<a href="index.php"><button href="index.php">Go back to homepage</button></a>';

    include_once 'header.php';
    
    echo '<nav>
    <ul id="menu">
      <li><a href="book.php"><span><span>Book</span></span></a></li>
      <li><a href="history.php"><span><span>History</span></span></a></li>
      <li><a href="profile.php"><span><span>Profile</span></span></a></li>';


      if($user['isadmin'] == 1) {
        echo '<li id="menu_active"><a href="admin.php"><span><span>Admin</span></span></a></li>';
      }
      else {
        echo '
        <script>
          if (confirm("You must be an admin to view this page") == true) {
            window.location = "book.php";
          } else {
            window.location = "book.php";
          }
        </script>';

      }

      echo '<li class="end"><a href="contacts.php"><span><span>Contacts</span></span></a></li>
    </ul>
  </nav>
</header>';

function flight_check($aircraftid, $start_time, $end_time, $mysqli)
{
  $chk= "SELECT flights.starttime AS starttime, flights.endtime AS endtime FROM flights INNER JOIN aircrafts ON flights.aircraftid = aircrafts.id WHERE aircrafts.id =" . $aircraftid;
  $result=$mysqli->query($chk);
      //echo $chk.'<br>';
  while($timeslot = $result->fetch_array())
  {
  //   $times[] = $timeslot;
  // }

  // foreach($times as $timeslot)
  // {
        //echo $row['CountryCode'];
        //}
      //while($timeslot= $times->fetch_array())
      //{
        //echo $timeslot['starttime'] .' ' . $start_time . ' ';
        // $start1 = strtotime($timeslot['starttime']);
        // $endt1 = strtotime($timeslot['endtime']);
        // $start2 = strtotime($start_time);
        // $endt2 = strtotime($end_time);
    $start1 = $timeslot['starttime'];
    $endt1 = $timeslot['endtime'];
    $start2 = $start_time;
    $endt2 = $end_time;
       //echo $start1 .'  ' . $start2 .' ';
        //echo $endt1 .'  ' . $endt2;
    if(((( $start2 < $endt1)&&( $endt2 > $start1)) || (( $start2 < $start1)&&( $endt2 > $endt1)) ))
    {
          //echo 'ganda';
      return false;
    }
    else
    {
          //echo 'acchha';
    }
  }  
      // echo '<br>';
      // echo 'acchha';
  return true;
}

$register_error = "";
if (isset($_POST['add_flight_submit'],
  $_POST['start_city'],
  $_POST['end_city'],
  $_POST['start_time'],
  $_POST['end_time']))
{
  $start_city=$_POST['start_city'];
  $end_city=$_POST['end_city'];
  $start_time=$_POST['start_time'];
  $end_time=$_POST['end_time'];
  $aircraftid = $_POST['aircraft_id']; 
  $f_fare=$_POST['f_fare'];
  $e_fare=$_POST['e_fare'];
  $b_fare=$_POST['b_fare'];

  $start = substr($start_time, 0, 10);
  $end = substr($start_time, -5, 5);
  $start_time = $start . ' ' . $end . ':00';

  $start = substr($end_time, 0, 10);
  $end = substr($end_time, -5, 5);
  $end_time = $start . ' ' . $end . ':00';

  if(flight_check($aircraftid, $start_time, $end_time, $mysqli)) //timings dont clash
  {
    $capacityquery = "SELECT types.bizcap AS bizcap, types.firstcap AS firstcap, types.econcap AS econcap FROM types INNER JOIN aircrafts ON types.id = aircrafts.typeid WHERE aircrafts.id =" . $aircraftid;
      //$getcap=$mysqli->prepare($cap);
    $capacities = $mysqli->query($capacityquery);

    $capacity = $capacities->fetch_array();
      //$capacity['firstcap'];


    $flightquery= "INSERT INTO flights (id, aircraftid, startcity, endcity, starttime, endtime,bizavl,firstavl,econavl,firstfare,bizfare,econfare) VALUES (NULL,?, ?, ?, ?, ?,?,?,?,?,?,?)";

    if($stmt=$mysqli->prepare($flightquery))
    {
      $stmt->bind_param('issssiiiiii', $aircraftid, $start_city, $end_city, $start_time, $end_time, $capacity['bizcap'], $capacity['firstcap'],$capacity['econcap'],$f_fare,$b_fare,$e_fare);
    }

        // $typeidcraft1 = "SELECT typeid FROM aircrafts WHERE id =" . $aircraftid;
        // $typeidcraft2 = $mysqli->query($typeidcraft1);
        // $type= $typeidcraft2->fetch_array();


        // $capacityquery = "SELECT firstcap, bizcap, econcap FROM types WHERE id=" .$type['typeid'];
        // $capacities = $mysqli->query($capacityquery);
        // $capacity = $capacities->fetch_array();


    if (! $stmt->execute() ) {
                //header('Location: ../error.php?err=Registration failure: INSERT');
      echo 'Error, could not insert new user';
      
    }
    else { 


      $stmt = $mysqli->prepare("SELECT id
        FROM flights
        WHERE startcity = ? AND
        endcity = ? AND
        starttime = ? AND
        endtime = ? AND
        aircraftid = ?
        LIMIT 1");
    // Using prepared statements means that SQL injection is not possible. 
      if ($stmt) {
        $stmt->bind_param('ssssi', $start_city, $end_city, $start_time, $end_time, $aircraftid); 
          $stmt->execute();    // Execute the prepared query.
          $stmt->store_result();

          // get variables from result.
          $stmt->bind_result($flight_id);
          $stmt->fetch();

          for($i=1; $i<= $capacity['firstcap']+$capacity['bizcap']+$capacity['econcap']; $i++)
          {
            $seatquery="INSERT INTO seats (seatno, flightid, class, isbooked) VALUES (?,?,?,?)";

            if($stmt = $mysqli->prepare($seatquery))
            {
              if($i <= $capacity['firstcap']) {
                $class = 'first';
              }
              else if ($i <= $capacity['firstcap'] + $capacity['bizcap']) {
                $class = 'business';
              }
              else {
                $class = 'economy';
              }
              $zero = 0;
              
              $stmt->bind_param('iisi', $i, $flight_id, $class, $zero);
              
              if (! $stmt->execute() ) {
                //header('Location: ../error.php?err=Registration failure: INSERT');
          echo 'Error, could not insert new flight';
          echo $mysqli->error;
        }
            }
          }
        }
        
          
          echo '<script>
          window.alert("A new flight has been created!");
        </script>';
    }

  }
  else
  {
    echo 
    '<script>
    window.alert("The selected aircraft is unavailable during the selected time slot. Please use a difference aircraft or change schedule");
  </script>';
  }
}



if(isset($_POST['add_type_submit']))
{
  $type_name=$_POST['type_name'];
  $f_cap=$_POST['f_cap'];
  $b_cap=$_POST['b_cap'];
  $e_cap=$_POST['e_cap'];
  $cost=$_POST['cost'];
  $f_cost=$_POST['f_cost'];

  if(empty($register_error))
  {

    $prep="INSERT INTO types (id, name, firstcap, bizcap, econcap, rateperkm, fixedcost) VALUES (NULL, ?, ?, ?, ?, ?, ?)";
    if($stmt=$mysqli->prepare($prep))
    {
      $stmt->bind_param('siiiii', $type_name, $f_cap,$b_cap,$e_cap,$cost,$f_cost);
    }
    if (! $stmt->execute()) {
                //header('Location: ../error.php?err=Registration failure: INSERT');
      echo 'Error, could not insert new user';
      echo $mysqli->error;
    }
  }
}
if(isset($_POST['add_craft_submit']))
{
  $type_id=$_POST['type_id'];
  if(empty($register_error))
  {
    $prep = "INSERT INTO aircrafts(id, typeid) VALUES (NULL, ?)";
    if($stmt=$mysqli->prepare($prep))
    {
      $stmt->bind_param('i',$type_id);
      if(! $stmt->execute())
      {
        echo 'Error, could not insert new user';
        echo $mysqli->error;
      }
    }
  }
}
?>
<!-- / header -->
<!--content -->
<section id="content">
  <div class="wrapper pad1">
    <article class="col1">
      <div class="box1">
        <h2 class="top">Add Flight</h2>
        <div class="pad" style="padding: 0px;">
          <form name="form_h" method="post" accept-charset="utf-8">
            <table style="margin-left: 0px; margin-right: 20px;">
              <tr>
                <td style="padding-left:20px;padding-right:20px;"><strong>Start City</strong>
                </td>
              </tr>
              <tr>
                <td style="padding-left:20px;padding-right:20px;">
                  <div class="row">
                    <input type="text" name="start_city" required>
                  </div>
                </td>
              </tr>
              <tr>
                <td style="padding-left:20px;padding-right:20px;"><strong>End City</strong>
                </td>
              </tr>
              <tr>
                <td style="padding-left:20px;padding-right:20px;">
                  <div class="row">
                    <input type="text" name="end_city" required>
                  </div>
                </td>
              </tr>
              <tr>
                <td style="padding-left:20px;padding-right:20px;"><strong>Start Time</strong>
                </td>
              </tr>
              <tr>
                <td style="padding-left:20px;padding-right:20px;">
                  <div class="row">
                    <input type="datetime-local" name="start_time" required placeholder="y-m-d-time">
                  </div>
                </td>
              </tr>
              <tr>
                <td style="padding-left:20px;padding-right:20px;"><strong>End Time</strong>
                </td>
              </tr>
              <tr>
                <td style="padding-left:20px;padding-right:20px;">
                  <div class="row">
                    <input type="datetime-local" name="end_time" required placeholder="y-m-d-time">
                  </div>
                </td>
              </tr>
              <tr>
                <td style="padding-left:20px;padding-right:20px;"><strong>First Class Fare</strong>
                </td>
              </tr>
              <tr>
                <td style="padding-left:20px;padding-right:20px;">
                  <div class="row">
                    <input type="number" min="0" name="f_fare" required>
                  </div>
                </td>
              </tr>
              <tr>
                <td style="padding-left:20px;padding-right:20px;"><strong>Business Class Fare</strong>
                </td>
              </tr>
              <tr>
                <td style="padding-left:20px;padding-right:20px;">
                  <div class="row">
                    <input type="number" min="0" name="b_fare" required>
                  </div>
                </td>
              </tr>
              <tr>
                <td style="padding-left:20px;padding-right:20px;"><strong>Economy Class Fare</strong>
                </td>
              </tr>
              <tr>
                <td style="padding-left:20px;padding-right:20px;">
                  <div class="row">
                    <input type="number" min="0" name="e_fare" required>
                  </div>
                </td>
              </tr>
              <tr>
                <td style="padding-left:20px;padding-right:20px;"><strong>Aircraft ID</strong>
                </td>
              </tr>
              <tr>
                <td style="padding-left:20px;padding-right:20px;">
                  <div class="row">
                    <select name="aircraft_id">
                      <?php

                      $aircrafts = $mysqli->query('SELECT aircrafts.id AS aircraftid, types.name AS typename FROM aircrafts INNER JOIN types ON aircrafts.typeid = types.id');
                      while($aircraft = $aircrafts->fetch_array()) {
                        echo '<option value="' . $aircraft['aircraftid'] . '">'. $aircraft['aircraftid'] . ' - ' .$aircraft['typename'] . '</option>';
                      }
                      ?>
                    </select>
                  </div>
                </td>
              </tr>
            </table>
            <br>
            <div class="right relative" style="margin-bottom: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button name="add_flight_submit" type="add_flight_submit" value="Add" class="button1" id="loginbtn">Add Flight</button></div>
            <br>
          </form>
        </div>

      </div>
      <br>
      <br>

      <div class="box1">

        <h2 class="top">Add Aircraft</h2>
        <div class="pad"  style="padding: 0px;"> 
          <form name="form_h" method="post" accept-charset="utf-8">
            <table style="margin-left: 0px; margin-right: 20px;">
              <tr>
                <td style="padding-left:20px;padding-right:20px;"><strong>Air Craft Type</strong>
                </td>
              </tr>
              <tr>
                <td style="padding-left:20px;padding-right:20px;">
                  <div class="row">
                    <select name="type_id">
                      <?php

                      $types = $mysqli->query('SELECT id, name FROM types');
                      while($type = $types->fetch_array()) {
                       echo '<option value="' . $type['id'] . '">'. $type['name'] . '</option>';
                     }
                     ?>
                   </select>
                 </div>
               </td>
             </tr>
           </table>
           <br>
           <div class="right relative">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button name="add_craft_submit" type="add_craft_submit" value="Add" class="button1" id="loginbtn">Add Aircraft</button></div> 
           <br>
         </form>
       </div>
     </div>

     <br>
     <br>

     <div class="box1">
      <h2 class="top">Add Aircraft Type</h2>
      <div class="pad" style="padding: 0px;"> 
        <form name="form_h" method="post" accept-charset="utf-8">
          <table style="margin-left: 0px; margin-right: 20px;">
            <tr>
              <td style="padding-left:20px;padding-right:20px;"><strong>Name</strong>
              </td>
            </tr>
            <tr>
              <td style="padding-left:20px;padding-right:20px;">
                <div class="row">
                  <input type="text" class="inp" name="type_name" required>
                </div>
              </td>
            </tr>
            <tr>
              <td style="padding-left:20px;padding-right:20px;"><strong>First Class Capacity</strong>
              </td>
            </tr>
            <tr>
              <td style="padding-left:20px;padding-right:20px;">
                <div class="row">
                  <input type="number" min="0" class="inp" name="f_cap" required>
                </div>
              </td>
            </tr>
            <tr>
              <td style="padding-left:20px;padding-right:20px;"><strong>Business Class Capacity</strong>
              </td>
            </tr>
            <tr>
              <td style="padding-left:20px;padding-right:20px;">
                <div class="row">
                  <input type="number" min="0" class="inp" name="b_cap" required>
                </div>
              </td>
            </tr>
            <tr>
              <td style="padding-left:20px;padding-right:20px;"><strong>Economy Class Capacity</strong>
              </td>
            </tr>
            <tr>
              <td style="padding-left:20px;padding-right:20px;">
                <div class="row">
                  <input type="number" min="0" class="inp" name="e_cap" required>
                </div>
              </td>
            </tr>
            <tr>
              <td style="padding-left:20px;padding-right:20px;"><strong>Cost Per KM</strong>
              </td>
            </tr>
            <tr>
              <td style="padding-left:20px;padding-right:20px;">
                <div class="row">
                  <input type="number" min="0" class="inp" name="cost" required>
                </div>
              </td>
            </tr>
            <tr>
              <td style="padding-left:20px;padding-right:20px;"><strong>Fixed Cost</strong>
              </td>
            </tr>
            <tr>
              <td style="padding-left:20px;padding-right:20px;">
                <div class="row">
                  <input type="number" min="0" class="inp" name="f_cost" required>
                </div>
              </td>
            </tr>
          </table>
          <br>
          <div class="right relative" style="margin-bottom: 20px;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button name="add_type_submit" type="submit" value="Add" class="button1" id="loginbtn">Add Type</button></div>
          <br>
        </form>
      </div>
    </div>
  </article>
  <article class="col2">

  <?php
    if(isset($_POST['occupancy_submit']))
    {
      $from_occ=$_POST['from_occ'];
      $to_occ=$_POST['to_occ'];
      $occ = "SELECT id FROM flights WHERE startcity = '$from_occ' AND endcity = '$to_occ'";
      $stmt=$mysqli->query($occ);
      $booked=0;
      $total_seat=0;
      while($ids= $stmt->fetch_array())
      {
        $seat = "SELECT isbooked FROM seats WHERE flightid = " .$ids['id'];
        $seat_info = $mysqli->query($seat);
        while($tot_seat = $seat_info->fetch_array())
        {
          $total_seat=$total_seat+1;
          $booked = $booked + $tot_seat['isbooked'];
        }
      }
      // if(! $stmt->execute())
      // {
      //   echo 'Error, could not insert new flight';
      //     echo $mysqli->error;
      // }
      // else{   
          echo '<script>
          window.alert("Occupancy rate for the route is ' .($booked/$total_seat) .'");
        </script>';
      
    }
    
    if(isset($_POST['profit_submit']))
    {
      $from_time=$_POST['from_time'];
      $to_time=$_POST['to_time'];
      $from_time= $from_time. ' 00:00:00';
      $to_time= $to_time. ' 00:00:00';
      $time = "SELECT id, aircraftid, startcity, endcity from flights WHERE starttime >= '" . $from_time . "' AND starttime <= '" . $to_time . "' ";
      
        
      $stmt=$mysqli->query($time);

      $totalcost=0;
      $totalincome = 0;
      while($ids = $stmt->fetch_array())
      {
        
        $cost_info = "SELECT types.rateperkm AS rateperkm, types.fixedcost AS fixedcost FROM aircrafts INNER JOIN types ON aircrafts.typeid =types.id WHERE aircrafts.id = " . $ids['aircraftid'];
          
        
        $cost= $mysqli->query($cost_info);
        $cost_value = $cost->fetch_array();

        $totalcost+= (strlen($ids['startcity']) + strlen($ids['endcity']))*$cost_value['rateperkm']*100 + $cost_value['fixedcost'];

        $income_info = "SELECT amount FROM bookings WHERE flightid = '". $ids['id'] . "'";
        $income = $mysqli->query($income_info); 
        $income_value = $income->fetch_array();

        $totalincome += $income_value['amount'];
        
        
      }

      echo '<script>
          window.alert("Profit in the time period is '. ($totalincome - $totalcost ) . '");
        </script>';
    }

    if(isset($_POST['delete_craft_submit']))
    {
      $craft_id=$_POST['craft_id'];
      $del_craft="DELETE FROM aircrafts WHERE id = '$craft_id'";
      //echo $del_craft;
      $del_flight="DELETE FROM flights WHERE aircraftid = '$craft_id'";
      //  echo $del_flight;
      if(($mysqli->query($del_flight) == TRUE) && ($mysqli->query($del_craft) == TRUE))
      //if($mysqli->query($del_craft) == TRUE)
      {
        echo '<script>
        window.alert("Aircraft has been successfully delted. All flights using that aircraft have been deleted too.");
        </script>';
      }
      else
      {
        echo'<script>
        window.alert("Aircraft could not be deleted.");
        </script>';
      }
    }
    if(isset($_POST['cancel_flight_submit']))
    {
      $flight_id = $_POST['flight_id'];
      $del_flight="DELETE FROM flights WHERE id = ". $flight_id;
      //echo $del_flight;
      
      $del_bookings="DELETE FROM bookings WHERE flightid = '$flight_id'";
      if($mysqli->query($del_flight) == TRUE)
      {
        echo '<script>
        window.alert("Flight has been successfully cancelled. All bookings of that flights have been cancelled too.");
        </script>';
      }
      else
      {
        echo'<script>
        window.alert("Flight could not be cancelled.");
        </script>';
      }
    }
  ?>

   
    <div class="box1">

        <h2 class="top">Delete Aircraft</h2>
        <div class="pad"> 
          <form name="form_h" method="post" accept-charset="utf-8">
            <table style="margin-left: 0px; margin-right: 20px;">
              <tr>
                <td style="padding-left:20px;padding-right:20px;"><strong>Craft Type</strong>
                </td>
              </tr>
              <tr>
                <td style="padding-left:20px;padding-right:20px;">
                  <div class="row">
                    <select name="craft_id">
                      <?php
                      $aircrafts = $mysqli->query('SELECT aircrafts.id AS aircraftid, types.name AS typename FROM aircrafts INNER JOIN types ON aircrafts.typeid = types.id');
                      while($aircraft = $aircrafts->fetch_array()) {
                        echo '<option value="' . $aircraft['aircraftid'] . '">'. $aircraft['aircraftid'] . ' - ' .$aircraft['typename'] . '</option>';
                      }
                     ?>
                   </select>
                 </div>
               </td>
             </tr>
           </table>
           <br>
           <div class="right relative">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button name="delete_craft_submit" type="delete_craft_submit" value="Add" class="button1" id="loginbtn">Delete Aircraft</button></div> 
           <br>
         </form>
       </div>
     </div>

     <br>
     <br>
    <div class="box1">
      <h2 class="top">Cancel Flight</h2>
      <div class="pad">
        <form name="form_h" method="post" accept-charset="utf-8">
          <table style="margin-left: 0px; margin-right: 20px;">
            <tr>
              <td style="padding-left:20px;padding-right:20px;"><strong>Choose Flight</strong>
              </td>
            </tr>
            <tr>
              <td style="padding-left:20px;padding-right:20px;">
                <div class="row">
                  <select name="flight_id">
                    <?php
                    $flights = $mysqli->query('SELECT flights.id AS flightid, flights.startcity AS startcity, flights.endcity AS endcity, flights.starttime AS starttime, aircrafts.typeid AS typeid FROM flights INNER JOIN aircrafts ON flights.aircraftid = aircrafts.id');
                    while($flight = $flights->fetch_array()) {
                      echo '<option value="' . $flight['flightid'] . '">'. $flight['startcity'] . ' - ' .$flight['endcity'] . '  :  '. $flight['starttime'] . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </td>
            </tr>
          </table>
          <br>
          <div class="right relative" style="margin-bottom: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button name="cancel_flight_submit" type="submit" value="Add" class="button1" id="loginbtn">Cancel Flight</button></div>
          <br>
        </form>
      </div>
    </div>
    <br>
    <br>
    <div class="box1">
      <h2 class="top">Occupancy Rate</h2>
      <div class="pad">
        <form name="form_h" method="post" accept-charset="utf-8">
          <table style="margin-left: 0px; margin-right: 20px;">
            <tr>
              <td style="padding-left:20px;padding-right:20px;"><strong>From</strong>
              </td>
            </tr>
            <tr>
              <td style="padding-left:20px;padding-right:20px;">
                <div class="row">
                  <input type="text" class="inp" name="from_occ" required>
                </div>
              </td>
            </tr>
            <tr>
              <td style="padding-left:20px;padding-right:20px;"><strong>To</strong>
              </td>
            </tr>
            <tr>
              <td style="padding-left:20px;padding-right:20px;">
                <div class="row">
                  <input type="text" class="inp" name="to_occ" required>
                </div>
              </td>
            </tr>
          </table>
          <br>
          <div class="right relative" style="margin-bottom: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button name="occupancy_submit" type="submit" value="Add" class="button1" id="loginbtn">Get Occupancy</button></div>
          <br>
        </form>
      </div>
    </div>
    <br>
    <br>
    
    <div class="box1">
      <h2 class="top">Profit</h2>
      <div class="pad">
        <form name="form_h" method="post" accept-charset="utf-8">
          <table style="margin-left: 0px; margin-right: 20px;">
            <tr>
              <td style="padding-left:20px;padding-right:20px;"><strong>Start Time</strong>
              </td>
            </tr>
            <tr>
              <td style="padding-left:20px;padding-right:20px;">
                <div class="row">
                  <input type="date" class="inp" name="from_time" required>
                </div>
              </td>
            </tr>
            <tr>
              <td style="padding-left:20px;padding-right:20px;"><strong>End Time</strong>
              </td>
            </tr>
            <tr>
              <td style="padding-left:20px;padding-right:20px;">
                <div class="row">
                  <input type="date" class="inp" name="to_time" required>
                </div>
              </td>
            </tr>
          </table>
          <br>
          <div class="right relative" style="margin-bottom: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button name="profit_submit" type="submit" value="Add" class="button1" id="loginbtn">Get Profit</button></div>
          <br>
        </form>
      </div>
    </div>
    
    <br>
    <br> 
    
   <!--  
    <?php include 'offers.php'; ?> -->

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
