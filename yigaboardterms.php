<?php require_once('Connections/conn.php'); ?>
<?php
$email = $_POST['email'];
$pass = $_POST['password'];
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



if (($email && $pass != NULL) && (isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

mysql_select_db($database_conn, $conn);
$query_log = "SELECT profile.email, profile.password FROM profile";
$log = mysql_query($query_log, $conn) or die(mysql_error());
$row_log = mysql_fetch_assoc($log);
$totalRows_log = mysql_num_rows($log);


   do { ?>
   
                
                  <?php $mail = $row_log['email']; 
				  echo $row_log['email'];
				  ?>
                  <?php $pwd = $row_log['password']; 
				  echo $row_log['password'];
				  ?>
                
                <?php
				 if(($pass == $pwd) && ($email == $mail) ){
header("Location: loged.php");
}
 
} while ($row_log = mysql_fetch_assoc($log)); 
         
mysql_free_result($log);
 
header("Location: index.php");
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
          <td align="right" width="400"><form id="form1" name="form1" method="post" action="">
              <label>
              <span class="style3">e-mail:</span>
              <input name="email" type="text" id="email" />
              <span class="style3">Password</span> </label>
              <label>
                <input name="password" type="password" id="password" />
                </label>
              <label>
              <input type="submit" name="Submit" value="LogIn" />
              </label>
			  <div align="right">
			    <input type="hidden" name="MM_insert" value="form1">
			      </div>
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
		  </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td><table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <th height="590" scope="col"><div> This agreement was written in English (US). To the extent any   translated version of this agreement conflicts with the English version,   the English version controls.&nbsp; Please note that Section 16   contains certain changes to the general terms for users outside the   United States.</div>
          <div> Date of Last Revision: April 26, 2011.<br />
              <br />
            <strong>Statement of Rights and Responsibilities</strong><br />
            <br />
            This Statement of Rights and Responsibilities (Statement) derives from the <a href="http://www.yigaboard.com/principles.php">yigaboard Principles</a>,   and governs our relationship with users and others who interact with   yigaboard. By using or accessing yigaboard, you agree to this Statement.</div>
          <ol>
            <li><strong>Privacy</strong><br />
                <br />
              Your privacy is very important to us. We designed our <a href="http://www.yigaboard.com/policy.php">Privacy Policy</a> to make important disclosures about how you can use yigaboard to share   with others and how we collect and can use your content and   information.&nbsp; We encourage you to read the Privacy Policy, and to   use it to help make informed decisions.<br />
              &nbsp;</li>
            <li><strong>Sharing Your Content and Information</strong><br />
                <br />
              You own all of the content and information you post on yigaboard, and you can control how it is shared through your <a href="http://www.yigaboard.com/privacy/">privacy</a> and <a href="http://www.yigaboard.com/editapps.php">application settings</a>. In addition:
              <ol>
                <li> For content that is covered by intellectual property rights, like   photos and videos (IP content), you specifically give us the following   permission, subject to your <a href="http://www.yigaboard.com/privacy/">privacy</a> and <a href="http://www.yigaboard.com/editapps.php">application settings</a>:   you grant us a non-exclusive, transferable, sub-licensable,   royalty-free, worldwide license to use any IP content that you post on   or in connection with yigaboard (IP License). This IP License ends when   you delete your IP content or your account unless your content has been   shared with others, and they have not deleted it.</li>
                <li> When you   delete IP content, it is deleted in a manner similar to emptying the   recycle bin on a computer. However, you understand that removed content   may persist in backup copies for a reasonable period of time (but will   not be available to others).</li>
                <li> When you use an application, your   content and information is shared with the application.&nbsp; We require   applications to respect your privacy, and your agreement with that   application will control how the application can use, store, and   transfer that content and information.&nbsp; (To learn more about   Platform, read our <a href="http://www.yigaboard.com/policy.php">Privacy Policy</a> and <a href="http://developers.yigaboard.com/docs/">Platform Page</a>.)</li>
                <li> When you publish content or information using the Public setting, it   means that you are allowing everyone, including people off of yigaboard,   to access and use that information, and to associate it with you (i.e.,   your name and profile picture).</li>
                <li> We always appreciate your   feedback or other suggestions about yigaboard, but you understand that we   may use them without any obligation to compensate you for them (just as   you have no obligation to offer them).<br />
                  &nbsp;</li>
              </ol>
            </li>
            <li><strong>Safety</strong><br />
                <br />
              We do our best to keep yigaboard safe, but we cannot guarantee it. We   need your help to do that, which includes the following commitments:
              <ol>
                <li> You will not send or otherwise post unauthorized commercial communications (such as spam) on yigaboard.</li>
                <li> You will not collect users' content or information, or otherwise access   yigaboard, using automated means (such as harvesting bots, robots,   spiders, or scrapers) without our permission.</li>
                <li> You will not engage in unlawful multi-level marketing, such as a pyramid scheme, on yigaboard.</li>
                <li> You will not upload viruses or other malicious code.</li>
                <li> You will not solicit login information or access an account belonging to someone else.</li>
                <li> You will not bully, intimidate, or harass any user.</li>
                <li> You will not post content that: is hateful, threatening, or   pornographic; incites violence; or contains nudity or graphic or   gratuitous violence.</li>
                <li> You will not develop or operate a   third-party application containing alcohol-related or other mature   content (including advertisements) without appropriate age-based   restrictions.</li>
                <li> You will follow our <a href="https://www.yigaboard.com/page_guidelines.php#promotionsguidelines">Promotions Guidelines</a> and all applicable laws if you publicize or offer any contest, giveaway, or sweepstakes (&ldquo;promotion&rdquo;) on yigaboard.</li>
                <li> You will not use yigaboard to do anything unlawful, misleading, malicious, or discriminatory.</li>
                <li> You will not do anything that could disable, overburden, or impair the   proper working of yigaboard, such as a denial of service attack.</li>
                <li> You will not facilitate or encourage any violations of this Statement.<br />
                  &nbsp;</li>
              </ol>
            </li>
            <li><strong>Registration and Account Security</strong><br />
                <br />
              yigaboard users provide their real names and information, and we need   your help to keep it that way. Here are some commitments you make to us   relating to registering and maintaining the security of your account:
              <ol>
                <li> You will not provide any false personal information on yigaboard, or   create an account for anyone other than yourself without permission.</li>
                <li> You will not create more than one personal profile.</li>
                <li> If we disable your account, you will not create another one without our permission.</li>
                <li> You will not use your personal profile for your own commercial gain (such as selling your status update to an advertiser).</li>
                <li> You will not use yigaboard if you are under 13.</li>
                <li> You will not use yigaboard if you are a convicted sex offender.</li>
                <li> You will keep your contact information accurate and up-to-date.</li>
                <li> You will not share your password, (or in the case of developers, your   secret key), let anyone else access your account, or do anything else   that might jeopardize the security of your account.</li>
                <li> You will   not transfer your account (including any page or application you   administer) to anyone without first getting our written permission.</li>
                <li> If you select a username for your account we reserve the right to   remove or reclaim it if we believe appropriate (such as when a trademark   owner complains about a username that does not closely relate to a   user's actual name).<br />
                  &nbsp;</li>
              </ol>
            </li>
            <li><strong>Protecting Other People's Rights</strong><br />
                <br />
              We respect other people's rights, and expect you to do the same.
              <ol>
                <li> You will not post content or take any action on yigaboard that infringes   or violates someone else's rights or otherwise violates the law.</li>
                <li> We can remove any content or information you post on yigaboard if we believe that it violates this Statement.</li>
                <li> We will provide you with tools to help you protect your intellectual property rights. To learn more, visit our <a href="http://www.yigaboard.com/legal/copyright.php?howto_report">How to Report Claims of Intellectual Property Infringement</a> page.</li>
                <li> If we remove your content for infringing someone else's copyright, and   you believe we removed it by mistake, we will provide you with an   opportunity to appeal.</li>
                <li> If you repeatedly infringe other people's intellectual property rights, we will disable your account when appropriate.</li>
                <li> You will not use our copyrights or trademarks (including yigaboard, the   yigaboard and F Logos, FB, Face, Poke, Wall and 32665), or any   confusingly similar marks, without our written permission.</li>
                <li> If   you collect information from users, you will: obtain their consent, make   it clear you (and not yigaboard) are the one collecting their   information, and post a privacy policy explaining what information you   collect and how you will use it.</li>
                <li> You will not post anyone's identification documents or sensitive financial information on yigaboard.</li>
                <li> You will not tag users or send email invitations to non-users without their consent.<br />
                  &nbsp;</li>
              </ol>
            </li>
            <li><strong>Mobile</strong><br />
                <br />
              <ol>
                <li> We currently provide our mobile services for free, but please be aware   that your carrier's normal rates and fees, such as text messaging fees,   will still apply.</li>
                <li> In the event you change or deactivate your   mobile telephone number, you will update your account information on   yigaboard within 48 hours to ensure that your messages are not sent to   the person who acquires your old number.</li>
                <li> You provide all rights   necessary to enable users to sync (including through an application)   their contact lists with any basic information and contact information   that is visible to them on yigaboard, as well as your name and profile   picture.<br />
                  &nbsp;</li>
              </ol>
            </li>
            <li><strong>Payments and Deals</strong><br />
                <br />
              <ol>
                <li> If you make a payment on yigaboard or use yigaboard Credits, you agree to our <a href="http://www.yigaboard.com/termsofsale.php">Payments Terms</a>.</li>
                <li> If purchase a Deal, you agree to our <a href="http://www.yigaboard.com/user_deals_terms.php">Deals Terms</a>.</li>
                <li> If you provide a Deal or partner with us to provide a Deal, you agree to the <a href="https://www.yigaboard.com/merchant_deals_terms.php">Merchant Deal Terms</a> in addition to any other agreements you may have with us.<br />
                  &nbsp;</li>
              </ol>
            </li>
            <li><strong>Special Provisions Applicable to Share Links </strong><br />
                <br />
              If you include our Share Link button on your website, the following additional terms apply to you:
              <ol>
                <li> We give you permission to use yigaboard's Share Link button so that   users can post links or content from your website on yigaboard.</li>
                <li> You give us permission to use and allow others to use such links and content on yigaboard.</li>
                <li> You will not place a Share Link button on any page containing content that would violate this Statement if posted on yigaboard.<br />
                  &nbsp;</li>
              </ol>
            </li>
            <li><strong>Special Provisions Applicable to Developers/Operators of Applications and Websites </strong><br />
                <br />
              If you are a developer or operator of a Platform application or website, the following additional terms apply to you:
              <ol>
                <li> You are responsible for your application and its content and all uses   you make of Platform. This includes ensuring your application or use of   Platform meets our <a href="http://developers.yigaboard.com/policy/">yigaboard Platform Policies</a> and our <a href="http://www.yigaboard.com/ad_guidelines.php">Advertising Guidelines</a>.</li>
                <li> Your access to and use of data you receive from yigaboard, will be limited as follows:
                  <ol>
                    <li> You will only request data you need to operate your application.</li>
                    <li> You will have a privacy policy that tells users what user data you are   going to use and how you will use, display, share, or transfer that data   and you will include your privacy policy URL in the <a href="http://www.yigaboard.com/developers/">Developer Application</a>.</li>
                    <li> You will not use, display, share, or transfer a user&rsquo;s data in a manner inconsistent with your privacy policy.</li>
                    <li> You will delete all data you receive from us concerning a user if the   user asks you to do so, and will provide a mechanism for users to make   such a request.</li>
                    <li> You will not include data you receive from us concerning a user in any advertising creative.</li>
                    <li> You will not directly or indirectly transfer any data you receive from   us to (or use such data in connection with) any ad network, ad exchange,   data broker, or other advertising related toolset, even if a user   consents to that transfer or use.</li>
                    <li> You will not sell user   data.&nbsp; If you are acquired by or merge with a third party, you can   continue to use user data within your application, but you cannot   transfer user data outside of your application.&nbsp;</li>
                    <li> We can require you to delete user data if you use it in a way that we determine is inconsistent with users&rsquo; expectations.</li>
                    <li> We can limit your access to data.</li>
                    <li> You will comply with all other restrictions contained in our <a href="http://developers.yigaboard.com/policy/">yigaboard Platform Policies</a>.</li>
                  </ol>
                </li>
                <li> You will not give us information that you independently collect from a user or a user's content without that user's consent.</li>
                <li> You will make it easy for users to remove or disconnect from your application.</li>
                <li> You will make it easy for users to contact you. We can also share your   email address with users and others claiming that you have infringed or   otherwise violated their rights.</li>
                <li> You will provide customer support for your application.</li>
                <li> You will not show third party ads or web search boxes on yigaboard.</li>
                <li> We give you all rights necessary to use the code, APIs, data, and tools you receive from us.</li>
                <li> You will not sell, transfer, or sublicense our code, APIs, or tools to anyone.</li>
                <li> You will not misrepresent your relationship with yigaboard to others.</li>
                <li> You may use the logos we make available to developers or issue a press   release or other public statement so long as you follow our <a href="http://developers.yigaboard.com/policy/">yigaboard Platform Policies</a>.</li>
                <li> We can issue a press release describing our relationship with you.</li>
                <li> You will comply with all applicable laws. In particular you will (if applicable):
                  <ol>
                    <li> have a policy for removing infringing content and terminating repeat   infringers that complies with the Digital Millennium Copyright Act.</li>
                    <li> comply with the Video Privacy Protection Act (VPPA), and obtain any   opt-in consent necessary from users so that user data subject to the   VPPA may be shared on yigaboard.&nbsp; You represent that any disclosure   to us will not be incidental to the ordinary course of your business.</li>
                  </ol>
                </li>
                <li> We do not guarantee that Platform will always be free.</li>
                <li> You give us all rights necessary to enable your application to work   with yigaboard, including the right to incorporate content and   information you provide to us into streams, profiles, and user action   stories.</li>
                <li> You give us the right to link to or frame your application, and place content, including ads, around your application.</li>
                <li> We can analyze your application, content, and data for any purpose,   including commercial (such as for targeting the delivery of   advertisements and indexing content for search).</li>
                <li> To ensure your application is safe for users, we can audit it.</li>
                <li> We can create applications that offer similar features and services to, or otherwise compete with, your application.<br />
                  &nbsp;</li>
              </ol>
            </li>
            <li>
              <div><strong>About Advertisements and Other Commercial Content Served or Enhanced by yigaboard</strong><br />
                  <br />
                Our goal is to deliver ads that are not only valuable to advertisers,   but also valuable to you. In order to do that, you agree to the   following:
                <ol>
                  <li> You can use your <a href="https://www.yigaboard.com/settings?tab=ads">privacy settings</a> to limit how your name and profile picture may be associated with   commercial, sponsored, or related content (such as a brand you like)   served or enhanced by us. You give us permission to use your name and   profile picture in connection with that content, subject to the limits   you place.</li>
                  <li> We do not give your content or information to advertisers without your consent.</li>
                  <li> You understand that we may not always identify paid services and communications as such.<br />
                    &nbsp;</li>
                </ol>
              </div>
            </li>
            <li><strong>Special Provisions Applicable to Advertisers </strong><br />
                <br />
              You can target your specific audience by buying ads on yigaboard or our   publisher network. The following additional terms apply to you if you   place an order through our online advertising portal (Order):
              <ol>
                <li> When you place an Order, you will tell us the type of advertising you   want to buy, the amount you want to spend, and your bid. If we accept   your Order, we will deliver your ads as inventory becomes available.   When serving your ad, we do our best to deliver the ads to the audience   you specify, although we cannot guarantee in every instance that your ad   will reach its intended target.</li>
                <li> In instances where we believe   doing so will enhance the effectiveness of your advertising campaign, we   may broaden the targeting criteria you specify.</li>
                <li> You will pay for your Orders in accordance with our <a href="http://www.yigaboard.com/termsofsale.php">Payments Terms</a>. The amount you owe will be calculated based on our tracking mechanisms.</li>
                <li> Your ads will comply with our <a href="http://www.yigaboard.com/ad_guidelines.php">Advertising Guidelines</a>.</li>
                <li> We will determine the size, placement, and positioning of your ads.</li>
                <li> We do not guarantee the activity that your ads will receive, such as the number of clicks you will get.</li>
                <li> We cannot control how people interact with your ads, and are not   responsible for click fraud or other improper actions that affect the   cost of running ads.&nbsp; We do, however, have systems to detect and   filter certain suspicious activity, learn more <a href="http://www.yigaboard.com/help.php?page=926">here</a>.</li>
                <li> You can cancel your Order at any time through our online portal, but it   may take up to 24 hours before the ad stops running.&nbsp; You are   responsible for paying for those ads.</li>
                <li> Our license to run your   ad will end when we have completed your Order. You understand, however,   that if users have interacted with your ad, your ad may remain until the   users delete it.</li>
                <li> We can use your ads and related content and information for marketing or promotional purposes.</li>
                <li> You will not issue any press release or make public statements about   your relationship with yigaboard without written permission.</li>
                <li> We may reject or remove any ad for any reason.</li>
                <li> If you are placing ads on someone else's behalf, we need to make sure   you have permission to place those ads, including the following:
                  <ol>
                    <li> You warrant that you have the legal authority to bind the advertiser to this Statement.</li>
                    <li> You agree that if the advertiser you represent violates this Statement, we may hold you responsible for that violation.<br />
                      &nbsp;</li>
                  </ol>
                </li>
              </ol>
            </li>
            <li><strong>Special Provisions Applicable to Pages</strong><br />
                <br />
              If you create or administer a Page on yigaboard, you agree to our <a href="http://www.yigaboard.com/terms_pages.php">Pages Terms</a>.<br />
              &nbsp;</li>
            <li><strong>Amendments</strong><br />
                <br />
              <ol>
                <li> We can change this Statement if we provide you notice (by posting the change on the <a href="http://www.yigaboard.com/fbsitegovernance">yigaboard Site Governance Page</a>) and an opportunity to comment.&nbsp; To get notice of any future changes to this Statement, visit our <a href="http://www.yigaboard.com/fbsitegovernance">yigaboard Site Governance Page</a> and become a fan.</li>
                <li> For changes to sections 7, 8, 9, and 11 (sections relating to payments,   application developers, website operators, and advertisers), we will   give you a minimum of three days notice. For all other changes we will   give you a minimum of seven days notice. All such comments must be made   on the <a href="http://www.yigaboard.com/fbsitegovernance">yigaboard Site Governance Page</a>.</li>
                <li> If more than 7,000 users comment on the proposed change, we will also   give you the opportunity to participate in a vote in which you will be   provided alternatives. The vote shall be binding on us if more than 30%   of all active registered users as of the date of the notice vote.</li>
                <li> We can make changes for legal or administrative reasons, or to correct   an inaccurate statement, upon notice without opportunity to comment.<br />
                  &nbsp;</li>
              </ol>
            </li>
            <li><strong>Termination</strong><br />
                <br />
              If you violate the letter or spirit of this Statement, or otherwise   create risk or possible legal exposure for us, we can stop providing all   or part of yigaboard to you. We will notify you by email or at the next   time you attempt to access your account. You may also delete your   account or disable your application at any time. In all such cases, this   Statement shall terminate, but the following provisions will still   apply: 2.2, 2.4, 3-5, 8.2, 9.1-9.3, 9.9, 9.10, 9.13, 9.15, 9.18, 10.3,   11.2, 11.5, 11.6, 11.9, 11.12, 11.13, and 14-18.<br />
              &nbsp;</li>
            <li><strong>Disputes</strong><br />
                <br />
              <ol>
                <li> You will resolve any claim, cause of action or dispute (claim) you have   with us arising out of or relating to this Statement or yigaboard   exclusively in a state or federal court located in Santa Clara County.   The laws of the State of California will govern this Statement, as well   as any claim that might arise between you and us, without regard to   conflict of law provisions. You agree to submit to the personal   jurisdiction of the courts located in Santa Clara County, California for   the purpose of litigating all such claims.</li>
                <li> If anyone brings a   claim against us related to your actions, content or information on   yigaboard, you will indemnify and hold us harmless from and against all   damages, losses, and expenses of any kind (including reasonable legal   fees and costs) related to such claim.</li>
                <li> WE TRY TO KEEP yigaboard   UP, BUG-FREE, AND SAFE, BUT YOU USE IT AT YOUR OWN RISK. WE ARE   PROVIDING yigaboard AS IS WITHOUT ANY EXPRESS OR IMPLIED WARRANTIES   INCLUDING, BUT NOT LIMITED TO, IMPLIED WARRANTIES OF MERCHANTABILITY,   FITNESS FOR A PARTICULAR PURPOSE, AND NON-INFRINGEMENT. WE DO NOT   GUARANTEE THAT yigaboard WILL BE SAFE OR SECURE. yigaboard IS NOT   RESPONSIBLE FOR THE ACTIONS, CONTENT, INFORMATION, OR DATA OF THIRD   PARTIES, AND YOU RELEASE US, OUR DIRECTORS, OFFICERS, EMPLOYEES, AND   AGENTS FROM ANY CLAIMS AND DAMAGES, KNOWN AND UNKNOWN, ARISING OUT OF OR   IN ANY WAY CONNECTED WITH ANY CLAIM YOU HAVE AGAINST ANY SUCH THIRD   PARTIES. IF YOU ARE A CALIFORNIA RESIDENT, YOU WAIVE CALIFORNIA CIVIL   CODE &sect;1542, WHICH SAYS: A GENERAL RELEASE DOES NOT EXTEND TO CLAIMS   WHICH THE CREDITOR DOES NOT KNOW OR SUSPECT TO EXIST IN HIS FAVOR AT THE   TIME OF EXECUTING THE RELEASE, WHICH IF KNOWN BY HIM MUST HAVE   MATERIALLY AFFECTED HIS SETTLEMENT WITH THE DEBTOR. WE WILL NOT BE   LIABLE TO YOU FOR ANY LOST PROFITS OR OTHER CONSEQUENTIAL, SPECIAL,   INDIRECT, OR INCIDENTAL DAMAGES ARISING OUT OF OR IN CONNECTION WITH   THIS STATEMENT OR yigaboard, EVEN IF WE HAVE BEEN ADVISED OF THE   POSSIBILITY OF SUCH DAMAGES. OUR AGGREGATE LIABILITY ARISING OUT OF THIS   STATEMENT OR yigaboard WILL NOT EXCEED THE GREATER OF ONE HUNDRED   DOLLARS ($100) OR THE AMOUNT YOU HAVE PAID US IN THE PAST TWELVE MONTHS.   APPLICABLE LAW MAY NOT ALLOW THE LIMITATION OR EXCLUSION OF LIABILITY   OR INCIDENTAL OR CONSEQUENTIAL DAMAGES, SO THE ABOVE LIMITATION OR   EXCLUSION MAY NOT APPLY TO YOU. IN SUCH CASES, yigaboard'S LIABILITY WILL   BE LIMITED TO THE FULLEST EXTENT PERMITTED BY APPLICABLE LAW.<br />
                  &nbsp;</li>
              </ol>
            </li>
            <li><strong>Special Provisions Applicable to Users Outside the United States</strong><br />
                <br />
              We strive to create a global community with consistent standards for   everyone, but we also strive to respect local laws. The following   provisions apply to users outside the United States:
              <ol>
                <li> You consent to having your personal data transferred to and processed in the United States.</li>
                <li> If you are located in a country embargoed by the United States, or are   on the U.S. Treasury Department's list of Specially Designated Nationals   you will not engage in commercial activities on yigaboard (such as   advertising or payments) or operate a Platform application or website.</li>
                <li> Certain specific terms that apply only for German users are available <a href="http://www.yigaboard.com/terms/provisions/german/index.php">here</a>.<br />
                  &nbsp;</li>
              </ol>
            </li>
            <li><strong>Definitions</strong><br />
                <br />
              <ol>
                <li> By yigaboard we mean the features and services we make available, including through (a) our website at <a href="http://www.yigaboard.com/">www.yigaboard.com</a> and any other yigaboard branded or co-branded websites (including   sub-domains, international versions, widgets, and mobile versions); (b)   our Platform; (c) social plugins such as the like button, the share   button and other similar offerings and (d) other media, software (such   as a toolbar), devices, or networks now existing or later developed.</li>
                <li> By Platform we mean a set of APIs and services that enable others,   including application developers and website operators, to retrieve data   from yigaboard or provide data to us.</li>
                <li> By information we mean facts and other information about you, including actions you take.</li>
                <li> By content we mean anything you post on yigaboard that would not be included in the definition of information.</li>
                <li> By data we mean content and information that third parties can retrieve from yigaboard or provide to yigaboard through Platform.</li>
                <li> By post we mean post on yigaboard or otherwise make available to us (such as by using an application).</li>
                <li> By use we mean use, copy, publicly perform or display, distribute, modify, translate, and create derivative works of.</li>
                <li> By active registered user we mean a user who has logged into yigaboard at least once in the previous 30 days.</li>
                <li> By application we mean any application or website that uses or accesses   Platform, as well as anything else that receives or has received data   from us.&nbsp; If you no longer access Platform but have not deleted all   data from us, the term application will apply until you delete the   data.<br />
                  &nbsp;</li>
              </ol>
            </li>
            <li><strong>Other</strong><br />
                <br />
              <ol>
                <li> If you are a resident of or have your principal place of business in   the US or Canada, this Statement is an agreement between you and   yigaboard, Inc.&nbsp; Otherwise, this Statement is an agreement between   you and yigaboard Ireland Limited.&nbsp; References to &ldquo;us,&rdquo; &ldquo;we,&rdquo; and   &ldquo;our&rdquo; mean either yigaboard, Inc. or yigaboard Ireland Limited, as   appropriate.</li>
                <li> This Statement makes up the entire agreement between the parties regarding yigaboard, and supersedes any prior agreements.</li>
                <li> If any portion of this Statement is found to be unenforceable, the remaining portion will remain in full force and effect.</li>
                <li> If we fail to enforce any of this Statement, it will not be considered a waiver.</li>
                <li> Any amendment to or waiver of this Statement must be made in writing and signed by us.</li>
                <li> You will not transfer any of your rights or obligations under this Statement to anyone else without our consent.</li>
                <li> All of our rights and obligations under this Statement are freely   assignable by us in connection with a merger, acquisition, or sale of   assets, or by operation of law or otherwise.</li>
                <li> Nothing in this Statement shall prevent us from complying with the law.</li>
                <li> This Statement does not confer any third party beneficiary rights.</li>
                <li> You will comply with all applicable laws when using or accessing yigaboard</li>
              </ol>
            </li>
          </ol>
          </th>
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
        <td width="10%" class="style14">Terms</td>
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
<?php
?>
