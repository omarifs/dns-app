<?php
function getjson(){
  // Read the JSON file 
  $json = file_get_contents('id.json');

  // Decode the JSON file
  $json_data = json_decode($json,true);
  echo '<table>';
  foreach ($json_data as $item) {
     if ($item['reliability']>0.9 && $item['city']!='') {
          echo '<tr><td>'.$item['city'].' ('.$item['country_id'].') </td><td>'.$item['ip'].'</td><td>'.$item['as_org'].'</td></tr>';
      }
  }
  echo '</table>';
  // Display data
  //print_r($json_data);
  
}
getjson();

?>