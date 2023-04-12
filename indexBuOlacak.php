<?php
  $phone = preg_replace("/[^0-9]/", "", $_GET['tel']); 
  $phone = substr($phone, 0, 2) == "90" ? "+".$phone : "+90".substr($phone, -10); 
  $echoTel = '+90 ' . substr($phone, 3, 3) . ' ' . substr($phone, 6, 3) . ' ' . substr($phone, 9, 2) . ' ' . substr($phone, 11, 2);
  echo "<a href='tel:$phone'>$echoTel</a>";
?>