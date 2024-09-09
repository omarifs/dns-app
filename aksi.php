<?php

//if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']!="https://tools.websolusi.com")  header('location:https://tools.websolusi.com');
//echo $_SERVER['HTTP_USER_AGENT'];
header("Access-Control-Allow-Origin: *");
//header("Content-Security-Policy: default-src *; style-src 'self' 'unsafe-inline'; script-src 'self' 'unsafe-inline' 'unsafe-eval'");
$dns=[
  "Domainesia NS1"=>"ns1.domainesia.net",
  "Domainesia DNS1"=>"dns1.domainesia.com",
  "Domainesia NSX1"=>"nsx1.domainesia.com",
  "Domainesia DNSX1"=>"dnsx1.domainesia.com",
  "Cloudflare"=>"1.1.1.1",
  "Google"=>"8.8.8.8",
  "Quad9"=>"9.9.9.9",
  "Verisign"=>"64.6.65.6",
  "Open DNS (US)"=>"208.67.222.222",
  "Singapore (SG)"=>"103.86.99.100",
  "Medan (ID)"=>"103.139.112.201",
  "Palembang (ID)"=> "103.84.119.172",
  "Lampung (ID)"=>"103.145.47.26",
  "Bekasi (ID)"=>"119.252.168.35",
  "Jember (ID)"=>"103.156.141.253",
  "Jawa Barat (ID)"=>"36.93.68.21",
  "Yogyakarta (ID)"=>"103.105.54.137",
  "Klaten (ID)"=>"103.105.53.173",
  "Kudus (ID)"=>"103.168.254.138",
  "Surabaya (ID)"=>"101.0.6.195",
  "Kalteng (ID)"=>"103.144.181.77",
];
$ns='149.112.112.112';
function aman($args){
  return escapeshellarg(trim($args));
}
$aksi= $_POST['aksi'] ?? '';
if($aksi=='whois'){
  $data = aman($_POST['param'] ?? '') ;
  //$data = getMainDomain($data);
  $patterns = array("/'/", "/www\./", "/\//");
  $data=preg_replace($patterns, '' ,$data);
  if(filter_var($data, FILTER_VALIDATE_IP))
  	$output = shell_exec("whois $data");
  else{
	  $output = whois($data);
  }
  //$output=$data;
  echo "<pre>".str_replace('   ','',$output)."</pre>";
}else if($aksi=='dig'){
  $data = aman($_POST['param'] ?? '') ;
  $digadd="dig -4 +nocmd mail.$data CNAME A +noall +answer  && dig -4 +nocmd www.$data CNAME A +noall +answer && dig -4 +nocmd _dmarc.$data TXT +noall +answer && dig -4 +nocmd default._domainkey.$data TXT +noall +answer && dig -4 +short -x $(dig -4 +short $data A) ";
  if(strstr($data,'mail.') || strstr($data,'www.') || strstr($data,'_dmarc.') || strstr($data,'default._domainkey.') )
    $output = shell_exec("dig -4 +nocmd $data any +noall +answer @$ns && dig -4 +short -x $(dig -4 +short $data A @$ns)");
  else{
    $data = str_replace("'","",aman($_POST['param'] ?? '')) ;
    $output =shell_exec("dig -4 +nocmd $data any +noall +answer @$ns && $digadd");
  }
  if(preg_match('/RFC/',$output))
    $output = shell_exec('RECORD="A MX TXT CNAME AAAA NS SOA"; for i in $RECORD; do dig -4 +nocmd '.$data.' +noall +answer $i; done; '.$digadd);
  else if($output=='')
     $output = shell_exec('RECORD="A MX TXT CNAME AAAA NS SOA"; for i in $RECORD; do dig -4 +nocmd '.$data.' +noall +answer $i; done; '.$digadd);
  else if($output=='')
     $output = shell_exec('RECORD="A MX TXT CNAME AAAA NS SOA"; for i in $RECORD; do dig -4 +nocmd '.$data.' +noall +answer $i; done; '.$digadd);
  echo "<pre style='text-align:left;'>$output</pre>";
}else if($aksi=='ptr'){
  $data = aman($_POST['param'] ?? '') ;
  if(filter_var(str_replace("'","",$data), FILTER_VALIDATE_IP))
    $output = shell_exec("dig -4 +short -x $data @$ns");
  else
    $output = shell_exec("dig -4 +short -x $(dig -4 +short $data A @$ns)");
  if($output=='')
    $output = shell_exec("dig -4 +short -x $(dig -4 +short @ns1.domainesia.net $data A)");
  if($output=='')
    $output = shell_exec("dig -4 +short -x $(dig -4 +short @ns1.domainesia.net $data TXT | grep -Eo '[0-9]+\.[0-9]+\.[0-9]+\.[0-9]+' | head -n 1)");
  echo $output;
}else if($aksi=='host'){
  $data = aman($_POST['param'] ?? '') ;
  $output = shell_exec("dig -4 +short -x $(dig -4 +short @ns1.domainesia.net $data A)");
  if($output=='')
    $output = shell_exec("dig -4 +short -x $(dig -4 +short @ns1.domainesia.net $data TXT | grep -Eo '[0-9]+\.[0-9]+\.[0-9]+\.[0-9]+' | head -n 1)");
  echo $output;
}else if($aksi=='cekssl'){
  $data = str_replace("'","",aman($_POST['param'] ?? '')) ;
  echo "<pre style='text-align:left;'>".sslcek($data)."</pre>";
}
else if($aksi=='propagate'){
  $data = aman($_POST['param'] ?? '') ;
  $tipe = aman($_POST['tipe'] ?? 'A') ;
  echo "<table border='0' width='100%'>";
  foreach($dns as $ns => $ip)
    echo "<tr style='border-bottom:1px solid #fff;'><td class='text-left'>$ns</td><td class='text-right dns".md5($ip)."'>".ajaxdig($ip,$data,$tipe)."</td></tr>";
  echo "</table>";
}
else if($aksi=='propagate2'){
  $data = aman($_POST['param'] ?? '') ;
  $tipe = aman($_POST['tipe'] ?? 'A') ;
  echo "<table border='0' width='100%'>";
  foreach($dns as $ns => $ip)
    echo "<tr style='border-bottom:1px solid #fff;'><td class='text-left'>$ns</td><td class='text-right dns".md5($ip)."'><script>propagasi('dns".md5($ip)."','$ip',$data,$tipe)</script></td></tr>";
  echo "</table>";
}
else if($aksi=='digpropagate'){
  $ip = ($_POST['dns'] ?? '') ;
  $data = ($_POST['data'] ?? '') ;
  $tipe = ($_POST['tipe'] ?? 'A');
  $output=shell_exec("dig -4 +short @$ip $data $tipe | grep -v '; communications error'");
  if(preg_match("/timed out/",$output))
    $output='-';
  //$output=$ip.$data.$tipe;
  echo "<pre>$output</pre>";
}
else if($aksi=='cekakun'){
  //$data = trim(preg_replace('/^(https?:\/\/)?/', '', ($_POST['param'] ?? ''))); ; //cara untuk mengambil domain saja tanpa http dan tanpa https
  // Set the content type to plain text
  header('Content-Type: text/plain');

  $domain = parseURL(($_POST['param'] ?? ''));
  $data = preg_replace('/^www\./', '', $domain);
  $output=shell_exec("dig -4 +short -x $(dig -4 +short @ns1.domainesia.net $data A)");
  $host=explode(".",$output);
  $akun =isset($host[0]) && !empty($host[0]) ? "tsh ".$host[0]." /scripts/whoowns $data && " : '';
  $dir =$akun!='' ? "&& echo 'Direktori : ' && awk '/$data/' /etc/userdatadomains |  cut -d '=' -f 1,5,9 | column -t -s ':' | column -t -s '=' | awk '{print $1 , $3 , $4}' | column -t -s ' '" : '';
  echo "$akun echo -e '\\nServer : \\n$output\\n'  $dir";
  //$output=shell_exec("ansible dn-arif -m shell -a 'df -h'");
  //echo "<pre>$output</pre>";
}else if($aksi=='traceroute'){
  $data = aman($_POST['param'] ?? '') ;
  $tipe = ($_POST['tipe2'] ?? 'ping') ;
  $data =str_replace("'","",$data);
  $output = show_ip_server();
  switch($tipe){
    case 'trace' :$output.=shell_exec("traceroute -4 -w 3,3,3 $data"); break;
    case 'trace6' :$output.=shell_exec("traceroute -6 -w 3,3,3 $data"); break;
    //case 'mtr' : $output=procExecute('mtr -4 --report --report-wide', $data); break;
    case 'mtr' : $output.=shell_exec("mtr -4 --report --report-wide $data"); break;
    case 'mtr6' : $output.=shell_exec("mtr -6 --report --report-wide $data"); break;
    case 'ping6' : $output.=shell_exec("ping6 -c 4 $data"); break;
    default : $output.=shell_exec("ping -c 4 $data"); break;
  }
  echo "<pre>$output</pre>";
  @ob_flush();
  flush();
}elseif($aksi=='getmacros'){
    // Step 1: Connect to MySQL database
    $servername = "localhost";
    $username = "macrosuser";
    $password = "9HLX2ITiN5KUzB4z1QxR";
    $dbname = "macrosdb";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    // Step 4: Retrieve data from the table
    $sql = "SELECT * FROM macros_tb";
    $result = $conn->query($sql);

    $data = [];
    if ($result->num_rows > 0) {
        header('Content-Type: application/json');

        // Retrieve data from the database

        while($row = $result->fetch_assoc()) {
            $data[]=[$row["title"], $row["content"]];
        }
    } else {
        $data[] = ['data', " kosong"];
    }
    echo json_encode(["data" => $data]);

}
function show_ip_server(){
  $serverAddresses = $_SERVER['SERVER_ADDR'];
  $ipv4Address = '103.161.184.136';
  $ipv6Address = '2001:df7:5300:3::15f';

  /*foreach ($serverAddresses as $address) {
      if (filter_var($address, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
          $ipv4Address = $address;
      } elseif (filter_var($address, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
          $ipv6Address = $address;
      }
  }*/

  return "IPv4 Address (Source Server): $ipv4Address <br>IPv6 Address (Source Server): $ipv6Address <br>";
}
function procExecute($cmd, $host, $failCount = 2)
{
    // define output pipes
    $spec = array(
        0 => array("pipe", "r"),
        1 => array("pipe", "w"),
        2 => array("pipe", "w")
    );

    // sanitize + remove single quotes
    $host = str_replace('\'', '', filter_var($host, FILTER_SANITIZE_URL));
    // execute command
    $process = proc_open("{$cmd} '{$host}'", $spec, $pipes, null);

    // check pipe exists
    if (!is_resource($process)) {
        return false;
    }

    // check for mtr/traceroute
    if (strpos($cmd, 'mtr') !== false) {
        $type = 'mtr';
    } elseif (strpos($cmd, 'traceroute') !== false) {
        $type = 'traceroute';
    } else {
        $type = '';
    }

    $fail = 0;
    $match = 0;
    $traceCount = 0;
    $lastFail = 'start';
    // iterate stdout
    while (($str = fgets($pipes[1], 1024)) != null) {
        // check for output buffer
        if (ob_get_level() == 0) {
            ob_start();
        }

        // fix RDNS XSS (outputs non-breakble space correctly)
        $str = htmlspecialchars(trim($str));

        // correct output for mtr
        if ($type === 'mtr') {
            if ($match < 10 && preg_match('/^[0-9]\. /', $str, $string)) {
                $str = preg_replace('/^[0-9]\. /', '&nbsp;&nbsp;' . $string[0], $str);
                $match++;
            } else {
                $str = preg_replace('/^[0-9]{2}\. /', '&nbsp;' . substr($str, 0, 4), $str);
            }
        }
        // correct output for traceroute
        elseif ($type === 'traceroute') {
            if ($match < 10 && preg_match('/^[0-9] /', $str, $string)) {
                $str = preg_replace('/^[0-9] /', '&nbsp;' . $string[0], $str);
                $match++;
            }
            // check for consecutive failed hops
            if (strpos($str, '* * *') !== false) {
                $fail++;
                if ($lastFail !== 'start'
                    && ($traceCount - 1) === $lastFail
                    &&  $fail >= $failCount
                ) {
                    echo str_pad($str . '<br />-- Traceroute timed out --<br />', 1024, ' ', STR_PAD_RIGHT);
                    break;
                }
                $lastFail = $traceCount;
            }
            $traceCount++;
        }

        // pad string for live output
        echo str_pad($str . '<br />', 1024, ' ', STR_PAD_RIGHT);

        // flush output buffering
        @ob_flush();
        flush();
    }

    // iterate stderr
    while (($err = fgets($pipes[2], 1024)) != null) {
        // check for IPv6 hostname passed to IPv4 command, and vice versa
        if (strpos($err, 'Name or service not known') !== false || strpos($err, 'unknown host') !== false) {
            echo 'Unauthorized request';
            break;
        }
    }

    $status = proc_get_status($process);
    if ($status['running'] == true) {
        // close pipes that are still open
        foreach ($pipes as $pipe) {
            fclose($pipe);
        }
        // retrieve parent pid
        $ppid = $status['pid'];
        // use ps to get all the children of this process
        $pids = preg_split('/\s+/', `ps -o pid --no-heading --ppid $ppid`);
        // kill remaining processes
        foreach($pids as $pid) {
            if (is_numeric($pid)) {
                posix_kill($pid, 9);
            }
        }
        proc_close($process);
    }
    return true;
}
function ajaxdig($dns,$domain,$tipe){
$base_url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
$base_url .= "://" . $_SERVER['HTTP_HOST'];
$base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
  echo '<script>
   $.ajax({
    			  type: "POST",
    			  url: "'.$base_url.'/aksi.php",
    			  data:{"dns": "'.$dns.'","data":"'.$domain.'","tipe":"'.$tipe.'","aksi":"digpropagate"},
    			  dataType:"html",
    			  success: function(data){
    			  	$(".dns'.md5($dns).'").html(data);
    			  },
            beforeSend: function(){
              $(".dns'.md5($dns).'").html("Loading...");
            },
    			  error:function(XMLHttpRequest){
    				  console.log(XMLHttpRequest.responseText);
    			  }
    	  });
  </script>';
}
function sslcek($args){
	$rawCert = getCertificate($args);
	$cert = [];
	$cert['domain'] = $args;
	$cert['serialNumber'] = $rawCert['serialNumber'];
	$cert['validFrom'] = gmdate("Y-m-d\TH:i:s\Z", $rawCert['validFrom_time_t']);
	$cert['validTo'] = gmdate("Y-m-d\TH:i:s\Z", $rawCert['validTo_time_t']);
	$cert['validToUnix'] = $rawCert['validTo_time_t'];
	$cert['issuer'] = $rawCert['issuer']['CN'];
	$cert['days'] = (intval($cert['validToUnix']) - time())/60/60/24;

  // Generate output
  $bar = str_repeat('=', 80);
  $format = "$bar\n %s (%d days)\n$bar\n from: %s\n until: %s\n serial: %s\n issuer: %s\n$bar\n\n";

  return sprintf($format, $cert['domain'], $cert['days'], $cert['validFrom'], $cert['validTo'], $cert['serialNumber'], $cert['issuer']);
}
// Get certificate info
// This code is adopted from http://stackoverflow.com/a/29779341/967802
function getCertificate($domain) {
	$url = "https://$domain";
	$orignal_parse = parse_url($url, PHP_URL_HOST);
	$get = stream_context_create(array("ssl" => array("capture_peer_cert" => TRUE)));
	$read = stream_socket_client("ssl://".$orignal_parse.":443", $errno, $errstr, 30, STREAM_CLIENT_CONNECT, $get);
	$cert = stream_context_get_params($read);
	$certinfo = openssl_x509_parse($cert['options']['ssl']['peer_certificate']);
	return $certinfo;
}
/*if(isset($_GET['domain'])){
  echo "<pre style='text-align:left;'>".sslcek($_GET['domain'])."</pre>";
}*/
function parseURL($url){
  $urlParts = parse_url(trim($url));

  if ($urlParts && isset($urlParts['scheme']) && isset($urlParts['host'])) {
    return $urlParts['host'];
  } else {
    // Teks bukan URL, kembalikan teks asli
    return $url;
  }
}
function whois($domain) {
  $subdomains = explode('.', $domain); // Membagi domain menjadi bagian-bagian subdomain
    $subdomain_count = count($subdomains); // Menghitung jumlah subdomain

    // Loop untuk menghapus subdomain dari paling depan dan melakukan pemeriksaan WHOIS
    for ($i = 0; $i < $subdomain_count; $i++) {
        $subdomain = implode('.', $subdomains); // Menggabungkan subdomain kembali ke dalam string
        $whois_result = shell_exec("whois -I " . $subdomain . " --no-recursion"); // Menjalankan perintah WHOIS pada subdomain
                
        if(strstr($whois_result , 'Sorry we do not own this TLD or SLD') || strstr($whois_result , 'No match'))
          array_shift($subdomains); // Menghapus subdomain dari paling depan
        else{
          if(strstr($subdomain,'.it'))
              $output = shell_exec("whois -I $subdomain --no-recursion");
         	else
              $output = shell_exec("whois -I $subdomain | grep 'Domain Name\|Updated On\|Date\|Status\|Name Server\|DNSSEC\|Registrar URL\|Registrar WHOIS\|Registrar:'");
          if($output==''){
              //$output = shell_exec("whois $data --no-recursion");
              $output = shell_exec("whois $subdomain | grep 'Domain Name\|Updated On\|Date\|Status\|Name Server\|DNSSEC\|Registrar URL\|Registrar WHOIS'");
          }
          return $output;
          exit;
        }
    }
}
function getIPAddress() {  
  //whether ip is from the share internet  
   if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
              $ip = $_SERVER['HTTP_CLIENT_IP'];  
      }  
  //whether ip is from the proxy  
  elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
              $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
   }  
//whether ip is from the remote address  
  else{  
           $ip = $_SERVER['REMOTE_ADDR'];  
   }  
  return $ip;
}
function ipinfo(){
  $ip=getIPAddress();
  // Mengambil data dari API ipinfo.io
  $response = @file_get_contents("http://ip-api.com/json/$ip?fields=countryCode,city,isp,reverse" ,false,  stream_context_create(['http' => ['timeout' => 3 ]]));

  // Memeriksa apakah data berhasil diambil
  if ($response === FALSE) {
      die('Error occurred while fetching data from API.');
  }

  // Mengubah response JSON menjadi array PHP
  $data = json_decode($response, true);

  // Mengambil data negara dan kota
  $country = isset($data['countryCode']) ? $data['countryCode'] : '-';
  $city = isset($data['city']) ? $data['city'] : '-';
  $isp = isset($data['isp']) ? $data['isp'] : '-';
  $hostname = isset($data['reverse']) ? $data['reverse'] : '-';

  return "IP ku \t: $ip \nLokasi \t: $city ($country) \nISP \t: $isp \nHostname: $hostname";

}
?>
