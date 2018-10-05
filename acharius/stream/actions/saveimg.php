<?php

$ch = curl_init('http://80.218.58.46:666/out.jpg');
$fp = fopen('img.png', 'wb');
curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_exec($ch);
curl_close($ch);
fclose($fp);


 ?>
