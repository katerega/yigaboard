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



if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

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

?>