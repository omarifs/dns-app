<?php
/*// Set up API endpoint URL
$url = 'https://chat.dnva.me/api/v1/accounts/1/canned_responses';
$url = 'https://app.chatwoot.com/api/v1/accounts/80979/canned_responses';

// Set up request headers
$headers = [
    'api_access_token: v6BWyCJMUAyr1CztVa8KKKvP',
    'Content-Type: application/json',
];

// Set up request options
$options = [
    CURLOPT_URL => $url,
    CURLOPT_HTTPHEADER => $headers,
    CURLOPT_RETURNTRANSFER => true,
];

// Send the request
$ch = curl_init();
curl_setopt_array($ch, $options);
$response = curl_exec($ch);

// Handle the response
if (curl_errno($ch)) {
    echo 'Error: ' . curl_error($ch);
} else {
    $response = json_decode($response, true);
    $data = [];
    if (!empty($response) && count($response)> 0) {
        //header('Content-Type: application/json');

        // Retrieve data from the database
        
        for($i=0;$i<count($response);$i++){
            $data[]=[$response[$i]["short_code"], $response[$i]["content"]];
        }
    } else {
        $data[] = ['data', " kosong"];
    }
    echo json_encode(["data" => $data]);
    //print_r($data);
}

// Close the request
curl_close($ch);*/
$response = file_get_contents('data.json');
/*if($_GET['param']=='asli') : 
  //$response = json_decode($response, false);
  $response=htmlentities($response, ENT_QUOTES, 'UTF-8', false);
  echo $response;
endif;*/
//$response = str_replace('\n','<br/>',$response);
$response = json_decode($response, true);

$data = [];
if (!empty($response) && count($response)> 0) {
    header('Content-Type: application/json');

    // Retrieve data from the database
    
    for($i=0;$i<count($response);$i++){
        $data[]=[$response[$i]["short_code"], '<pre>'.htmlentities($response[$i]["content"], ENT_QUOTES, 'UTF-8', false).'</pre>'];
    }
} else {
    $data[] = ['data', " kosong"];
}
echo json_encode(["data" => $data]);

//print_r($data);
