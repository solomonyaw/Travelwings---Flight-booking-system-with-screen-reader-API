<?php
include_once"index1.html";
include_once"index.html";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>AirLines | Booking Uganda User Profile</title>
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
<script>
function myFunction() {
    var x = document.createElement("INPUT");
    x.setAttribute("type", "password");
    x.setAttribute("value", "pswtext");
    document.body.appendChild(x);
}
</script>
</head>
<body id="page3">
<div class="main">
  <!--header -->
  <a href="index.php"><button href="index.php">Go back to homepage</button></a>
  <?php 
  echo '<header>';  

  include_once 'header.php';
  
echo '<nav>
<ul id="menu">
<li><a href="book.php"><span><span>Book</span></span></a></li>
<li><a href="history.php"><span><span>History</span></span></a></li>
<li id="menu_active"><a href="profile.php"><span><span>Profile</span></span></a></li>';


if($user['isadmin'] == 1) {
  echo '<li><a href="admin.php"><span><span>Admin</span></span></a></li>';
}


echo '<li class="end"><a href="contacts.php"><span><span>Contacts</span></span></a></li>
</ul>
</nav>
</header>';
?>

<?php
if(isset($_POST['change_pw_submit'])) {
  if($_POST['current_password'] == $user['password']) {
    
    $query = 'UPDATE users SET password = "' . $_POST['new_password'] . '" WHERE id = ' . $user['id'];
    
    //echo $query;
    $mysqli->query($query);
    
    echo '<script> alert("Password changed successfully!"); </script>';
  }
  else {
    echo '<script> alert("Wrong password!"); </script>';
  }
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
        <div class="tabs2">
          <ul class="nav">
            <li class="selected"><a href="#Flight">User Details</a></li>
            <!--<li><a href="#Hotel">Hotel</a></li>
            <li class="end"><a href="#Rental">Rental</a></li>-->
          </ul>
          <div class="content" align="center">
          <table style="margin-left: 20px; margin-right: 20px;">
          <br>
            <tr>
              <td style="padding-left:20px;padding-right:20px;">Name:</td>
              <td style="padding-left:20px;padding-right:20px;"><?php echo $user['first_name'].' '.$user['last_name']; ?></td>
            </tr>
            <tr>
              <td style="padding-left:20px;padding-right:20px;">Email id:</td>
              <td style="padding-left:20px;padding-right:20px;"><?php echo $user['email']; ?></td>
            </tr>
            <tr>
              <td style="padding-left:20px;padding-right:20px;">Phone:</td>
              <td style="padding-left:20px;padding-right:20px;"><?php echo $user['phone']; ?></td>
            </tr>
            <tr>
              <td style="padding-left:20px;padding-right:20px;">Address:</td>
              <td style="padding-left:20px;padding-right:20px;"><?php echo $user['address']; ?></td>
            </tr>
            <tr>
              <td style="padding-left:20px;padding-right:20px;">Account balance:</td>
              <td style="padding-left:20px;padding-right:20px;"><?php echo $user['balance']; ?></td>
            </tr>
            <tr>
              <td style="padding-left:20px;padding-right:20px;"><strong>Change Password:</strong></td>
              <td style="padding-left:20px;padding-right:20px;"></td>
            </tr>
            <tr>
              <td style="padding-left:20px;padding-right:20px;">Enter Current Password:</td>
              <td style="padding-left:20px;padding-right:20px;">
                <div class="wrapper">
                <form id="form_1" method="post">
                <div class="row">
                <input type="password" name="current_password" placeholder="password" required></div>
                
                </div>
              </td>
            </tr>
            <tr>
              <td style="padding-left:20px;padding-right:20px;">Enter New Password:</td>
              <td style="padding-left:20px;padding-right:20px;">
                <div class="wrapper">
                
                <div class="row">
                <input type="password" name="new_password" placeholder="password" required></div>
                <button name="change_pw_submit" type="add_flight_submit" class="button1" id="loginbtn">Submit</button>
                </form>
                </div>
              </td>
            </tr>
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
    $('.form_5').jqTransform({
        imgPath: 'jqtransformplugin/img/'
    });
});
$(document).ready(function () {
    tabs2.init();
});
</script>
</body>
</html>
