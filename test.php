<?php 
$data='12.12.12.12';
if(filter_var($data, FILTER_VALIDATE_IP))
  echo 'IP';
 else
   echo 'Bukan IP';
?>