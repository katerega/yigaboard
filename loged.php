<?php require_once('Connections/conn.php'); ?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form3")) {
  $insertSQL = sprintf("INSERT INTO profile (fname, lname, email, password) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['fname'], "text"),
                       GetSQLValueString($_POST['lname'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['password'], "text"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());

  $insertGoTo = "#";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

    <script type="text/javascript" src="js/jquery-1.6.4.min.js"></script>
	<script type="text/javascript"  src="js/drop.js"></script>
	
	<script type="text/javascript">

$(document).ready(function() {

	//Set Default State of each portfolio piece
	$(".paging").show();
	$(".paging a:first").addClass("active");
		
	//Get size of images, how many there are, then determin the size of the image reel.
	var imageWidth = $(".window").width();
	var imageSum = $(".image_reel img").size();
	var imageReelWidth = imageWidth * imageSum;
	
	//Adjust the image reel to its new size
	$(".image_reel").css({'width' : imageReelWidth});
	
	//Paging + Slider Function
	rotate = function(){	
		var triggerID = $active.attr("rel") - 1; //Get number of times to slide
		var image_reelPosition = triggerID * imageWidth; //Determines the distance the image reel needs to slide

		$(".paging a").removeClass('active'); //Remove all active class
		$active.addClass('active'); //Add active class (the $active is declared in the rotateSwitch function)
		
		//Slider Animation
		$(".image_reel").animate({ 
			left: -image_reelPosition
		}, 500 );
		
	}; 
	
	//Rotation + Timing Event
	rotateSwitch = function(){		
		play = setInterval(function(){ //Set timer - this will repeat itself every 3 seconds
			$active = $('.paging a.active').next();
			if ( $active.length === 0) { //If paging reaches the end...
				$active = $('.paging a:first'); //go back to first
			}
			rotate(); //Trigger the paging and slider function
		}, 7000); //Timer speed in milliseconds (3 seconds)
	};
	
	rotateSwitch(); //Run function on launch
	
	//On Hover
	$(".image_reel a").hover(function() {
		clearInterval(play); //Stop the rotation
	}, function() {
		rotateSwitch(); //Resume rotation
	});	
	
	//On Click
	$(".paging a").click(function() {	
		$active = $(this); //Activate the clicked paging
		//Reset Timer
		clearInterval(play); //Stop the rotation
		rotate(); //Trigger rotation immediately
		rotateSwitch(); // Resume rotation
		return false; //Prevent browser jump to link anchor
	});	
	
});
</script>
    <link href="css/drop.css" rel="stylesheet" type="text/css" />
    <link href="css/dddropdownpanel.css" rel="stylesheet" type="text/css" />



<title>yigaboard</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
#Layer1 {
	position:absolute;
	width:376px;
	height:58px;
	z-index:1;
	left: 616px;
	top: 101px;
}
#Layer2 {
	position:absolute;
	width:200px;
	height:115px;
	z-index:2;
	left: 648px;
	top: 65px;
}
.style3 {
	font-family: Arial, Helvetica, sans-serif;
	color: #FFFFFF;
	font-weight: bold;
	font-size: 12px;
}
.style8 {font-family: Arial, Helvetica, sans-serif}
.style10 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.style12 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
.style13 {font-size: 12px}
.style14 {font-size: 9px}
-->
</style></head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td bgcolor="#921629"><div align="left">
      <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="24%"><img src="img/logo.png" width="200" height="40" /></td>
          <td align="right" width="53%"><form id="form1" name="form1" method="post" action="">
              <label>
              <span class="style3">Username</span>
              <input type="text" name="textfield2" />
              <span class="style3">Password</span> </label>
              <label>
                <input type="text" name="textfield" />
                </label>
              <label>
              <input type="submit" name="Submit" value="LogIn" />
              </label>
            </form>            </td>
          <td width="11%">
		  <div id="menu">
        	<ul>
              <ul id="sddm">
    <li><a href="" 
        onmouseover="mopen('m1')" 
        onmouseout="mclosetime()">Translate:</a>
        <div id="m1" 
            onmouseover="mcancelclosetime()" 
            onmouseout="mclosetime()">
        <a href="consultancy_areas.html">Swahili</a>
        <a href="financial_economic_affairs.html">French</a>
        <a href="legal_governance.html">Luganda</a>
        <a href="reasrch_training.html">Afrikanas</a>		 </div>
    </li>
    </ul>
	 </ul>
            </div>		  </td>
		  <td width="12%">
		    <div id="menu">
        	<ul>
              <ul id="sddm">
    <li><a href="" 
        onmouseover="mopen('m2')" 
		
        onmouseout="mclosetime()">UserProfile:</a>
        <div id="m2" 
            onmouseover="mcancelclosetime()" 
            onmouseout="mclosetime()">
        <a href="consultancy_areas.html">Change Settings</a>
        <a href="financial_economic_affairs.html">Update Profile</a>
        <a href="legal_governance.html">Your Dreams</a>
        <a href="reasrch_training.html">Where you at</a> 
		<a href="reasrch_training.html">SignOut</a>		 </div>
    </li>
    </ul>
	 </ul>
            </div>		  </td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td><table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <th height="590" scope="col"><div  align="left"><img src="img/mainpage.jpg" width="468" height="468" /></div></th>
        <th scope="col"><div align="right"><div id="Layer2">
  <form method="post" name="form3" action="<?php echo $editFormAction; ?>">
    <table align="center">
	
	 <tr valign="baseline">
        <td colspan="2" align="right" nowrap><div align="center"><span class="style8">CREATE NEW ACCOUNT</span></div></td>
        </tr>
	  
      <tr valign="baseline">
        <td nowrap align="right"><div align="left"><span class="style10">Fname:</span></div></td>
        <td><input type="text" name="fname" value="" size="32"></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right"><div align="left"><span class="style12">Lname:</span></div></td>
        <td><input type="text" name="lname" value="" size="32"></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right"><div align="left" class="style13"><span class="style8">Email</span>:</div></td>
        <td><input type="text" name="email" value="" size="32"></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right"><div align="left" class="style13"><span class="style8">Password</span>:</div></td>
        <td><input type="text" name="password" value="" size="32"></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right"><div align="left" class="style13"><span class="style8">Confirm password</span> : </div></td>
        <td><input type="text" name="password2" value="" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right">&nbsp;</td>
        <td><input name="submit" type="submit" value="CREATE ACCOUNT" /></td>
      </tr>
    </table>
    <input type="hidden" name="MM_insert" value="form3">
  </form>
  <p>&nbsp;</p>
</div></div></th>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <th width="10%" class="style14" scope="row"><div align="left">Aboutus</div></th>
        <td width="10%" class="style14">blog</td>
        <td width="10%" class="style14">Help</td>
        <td width="10%" class="style14">Mobile</td>
        <td width="10%" class="style14"><a href="yigaboardterms.php">Terms</a></td>
        <td width="10%" class="style14">Advertisers</td>
        <td width="10%" class="style14">privecy</td>
        <td width="10%" class="style14">developers</td>
        <td width="20%"><div align="right"><span class="style14">&copy;2012 Kelmo Clean Energies Ltd</span> </div></td>
      </tr>
    </table></td>
  </tr>
</table>

</body>
</html>
