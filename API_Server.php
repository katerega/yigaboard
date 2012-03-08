<?php
include('server_class.php');

// Section 1: Info retreival
if (isset($HTTP_RAW_POST_DATA)) {
 $request_xml = $HTTP_RAW_POST_DATA;
}
else {
 $request_xml = implode("\r\n", file('php://input'));
}

// Section 2: Create Server
$x = new xml_server();

// Section 3: parse XML
if ($x) {
 $success = $x-&gt;parse_xml($request_xml);
}
else {
 $x-&gt;errno = "200";
}

// Section 4: generate XML response
$results = $x-&gt;generate_xml();

// Section 5: send XML response
print $results;
?>