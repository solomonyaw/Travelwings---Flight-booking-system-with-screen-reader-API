<?php
include_once"index.html";

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <style>


  </style>
  
  <title>AirLines | Booking Uganda</title>
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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body id="page1">
  <div class="main">
    <!--header -->
    <a href="index.php"><button href="index.php">Go back to homepage</button></a>
    <?php 
    echo '<header>';  
    include_once"index1.html";

    include_once 'header.php';
    
    echo '<nav>
    <ul id="menu">
    <li id="menu_active"><a href="book.php"><span><span>Book</span></span></a></li>
    <li><a href="history.php"><span><span>History</span></span></a></li>
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
    
    
    <!--start here -->
    
    
     
    <section id="content">
      <div class="for_banners">
        <article class="col1">
          <div class="tabs">
            <ul class="nav">
              <li class="selected"><a href="#Flight">Flight</a></li>
            <!--<li><a href="#Hotel">Hotel</a></li>
            <li class="end"><a href="#Rental">Rental</a></li>-->
          </ul>
          <div class="content">
            <div class="tab-content" id="Flight">
              <form id="form_1" action="search.php" method="post">
                <div>
                  <div class="radio">
                    
                    <div class="wrapper">
                    <input type="radio" name="bookingtype" value="oneway" checked>
                      
                      <span class="left">National</span>
                      
                      <input type="radio" name="bookingtype" value="oneway" >
                      <span class="left">International</span> </div>
                    </div>
                     
                    
                    <div class="row">
                      <table>
                        
                        <tr>
                          <td>
                            <span class="left">From:</span>
                          </td>
                          <td>
                            <input type="text" name="startcity" class="input" value="">
                          </td>
                        </tr>
                        
                        <tr>
                          <td>
                            <span class="left">To:</span>
                          </td>
                          <td>
                            <input type="text" name="endcity" class="input" value="">
                          </td>
                        </tr>
                        
                        <tr>
                          <td>
                            <span class="left" style="width: 78px">Departure:</span>
                          </td>
                          <td>
                            <input type="date" class="input" value="" name="startdate" min="<?php echo date('Y-m-d'); /*gives current date*/ ?>" onblur="if(this.value=='') this.value=''" onFocus="if(this.value =='' ) this.value=''">
                          </td>
                        </tr> 
                        
                        <tr>
                          <td rowspan="3">
                            <span class="left">Class:</span>
                          </td>
                          <td>
                            <input type="radio" name="class" value="economy" checked>Economy
                          </td>
                        </tr>
                        
                        <tr>
                          <td>
                            <input type="radio" name="class" value="business">Business
                          </td>
                        </tr>
                        
                        <tr>
                          <td>
                            <input type="radio" name="class" value="first">First
                          </td>
                        </tr>
                        
                      </table>
                    </div>
                    
                    <div class="row"> <span class="left">Adults: </span>
                      <input type="number" min="0" max="10" class="input2" value="2" name="adults" onblur="if(this.value=='') this.value='2'" onFocus="if(this.value =='2' ) this.value=''">
                    </div>
                    <div class="row"> <span class="left">Children:</span>
                      <input type="number" class="input2" value="0" name="children"  min="0" max="10" onblur="if(this.value=='') this.value='0'" onFocus="if(this.value =='0' ) this.value=''">
                      <span class="pad_left1">(0-11 years)</span> </div>
                      
                      
                      <!-- echo '<script> window.alert("No flights are available between the given cities on that day") </script>'; -->
                      
                      <div class="right relative">&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;<button type="submit" value="search" class="button1" name="search_submit" id="loginbtn">Search</button></div> 
                    </form>
                  </div>
                </div>
              </div>
            </article>
            <div id="slider"> <img src="images/banner1.jpg" alt=""> <img src="images/banner2.jpg" alt=""> <img src="images/banner3.jpg" alt=""> </div>
          </div>
          <div class="wrapper pad1">
            <article class="col1">
            
            
            
            
            
            
            
            
            

            
            
            <!-- end here -->
            
            
            
            
            
            
            
              <?php include 'offers.php'; ?>
            </article>
          </div>
        </section>
        <!--content end-->
        <!--footer -->
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
       
       
        
        
        
        
        
<footer>
          <?php include_once('footer.php'); ?>
        </footer>
        <!--footer end-->
      </div>
<script type="text/javascript">Cufon.now();</script>
      <script type="text/javascript">
      $(document).ready(function () {
        tabs.init();
      });
      jQuery(document).ready(function ($) {
        $('#form_1, #form_2, #form_3').jqTransform({
          imgPath: 'jqtransformplugin/img/'
        });
      });
      $(window).load(function () {
        $('#slider').nivoSlider({
        effect: 'fade', //Specify sets like: 'fold,fade,sliceDown, sliceDownLeft, sliceUp, sliceUpLeft, sliceUpDown, sliceUpDownLeft' 
        slices: 15,
        animSpeed: 500,
        pauseTime: 6000,
        startSlide: 0, //Set starting Slide (0 index)
        directionNav: false, //Next & Prev
        directionNavHide: false, //Only show on hover
        controlNav: false, //1,2,3...
        controlNavThumbs: false, //Use thumbnails for Control Nav
        controlNavThumbsFromRel: false, //Use image rel for thumbs
        controlNavThumbsSearch: '.jpg', //Replace this with...
        controlNavThumbsReplace: '_thumb.jpg', //...this in thumb Image src
        keyboardNav: true, //Use left & right arrows
        pauseOnHover: true, //Stop animation while hovering
        manualAdvance: false, //Force manual transitions
        captionOpacity: 1, //Universal caption opacity
        beforeChange: function () {},
        afterChange: function () {},
        slideshowEnd: function () {} //Triggers after all slides have been shown
      });
});
</script>
</body>
</html>
