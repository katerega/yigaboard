<?php
$request = "&lt;?xml version="1.0"?&gt;
&lt;myXML&gt;
&lt;function>order&lt;/function&gt;
&lt;values&gt;
&lt;orderID&gt;12345&lt;/orderID&gt;
&lt;reference&gt;ref&lt;/reference&gt;
&lt;/values&gt;
&lt;/myXML&gt;
";

$url = "http://www.mydomain.com/my_server.php";  
// fake - obviosly!

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POSTFIELDS, $request); 
// what to post
curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$result = curl_exec($ch);
curl_close($ch);

print $result;
?>