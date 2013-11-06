<html>
<head>
</head>
<body>
<?php

$cfgServer    = "81.96.128.200";
$cfgPort    = 6000;
$cfgTimeOut    = 100;

// open a socket
if(!$cfgTimeOut)
    // without timeout
    $fp = fsockopen($cfgServer, $cfgPort);
else
    // with timeout
    $fp = fsockopen($cfgServer, $cfgPort, &$errno, &$errstr, $cfgTimeOut);

if(!$fp) {
    echo "Connection failed\n";
    exit();
}    
else {
    echo "<pre>";
    echo "Connected...\n";
    $tmp = fgets($fp, 1024);
    echo "$tmp\n";
    print "$tmp\n";
    fputs( $fp, "client test2 eloe/ppVRTdKk\nsay hello gaylords\n" ); 
   
     while( !feof( $fp ) ){
      $str = '';
      $str = fgets( $fp, 255 );
      echo "$str\n";
      flush();
      }
}

?>

</body>
</html>

