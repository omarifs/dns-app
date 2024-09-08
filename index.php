<?php
//header('Access-Control-Allow-Credentials: true');
//header('X-Frame-Options: ALLOW FROM http://jasaku.web.id/');
//header('Access-Control-Allow-Origin: *');
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

$userAgent = $_SERVER['HTTP_USER_AGENT'];

if (strpos($userAgent, 'curl') !== false) {
    // Jalankan skrip PHP yang ingin Anda eksekusi jika User-Agent adalah "curl"
    echo getIPAddress()."\n";
    exit(0);
    // Tambahkan logika atau skrip PHP lainnya di sini
}
$ipwhitelist=['103.147.154.56','103.147.154.58','103.126.226.90','172.105.125.136'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Websolusi - Online Tools</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" type="text/css" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-C4648P71NX"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
        
          gtag('config', 'G-C4648P71NX');
        </script>
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-light bg-light static-top">
            <div class="container">
                <a class="navbar-brand" href="#!">Websolusi - Domains/IP Online Tools</a>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container position-relative">
                <div class="row justify-content-center">
                    <div class="col-xl-10">
                        <div class="text-center text-white">
                            <!-- Page heading
                            <h1 class="mb-5">Generate more leads with a professional landing page!</h1> -->
                            <div class="form-subscribe">
                                <!-- Email address input-->
                                <div class="row">
                                    <div class="col">
                                        <input class="form-control form-control-sm" id="Address" type="text" placeholder="Domain / IP" data-sb-validations="required" name="param"/>
                                        <div class="invalid-feedback text-white" data-sb-feedback="Address:required">Domain / IP</div>
                                    </div>
                                    <div class="col-sm-12">
                                      <button class="btn btn-primary btn-sm" id="whois" type="button" onclick="run('whois')">Whois</button> 
                                      <button class="btn btn-success btn-sm" id="dig" type="button" onclick="run('dig')">DNS Record</button>
                                      <button class="btn btn-danger btn-sm" id="ptr" type="button" onclick="run('ptr')">Host IP / PTR</button>
                                      <!--<button class="btn btn-warning btn-sm" id="dnscek" type="button" onclick="run('dnscek')">DNS Checker</button>
                                      <button class="btn bg-secondary btn-sm" id="intodns" type="button" onclick="run('intodns')">Into DNS</button>-->
                                      <button class="btn btn-warning btn-sm" id="propagate" type="button" onclick="run('propagate')">
                                      <select class="tipe"><option value="A">A</option><option value="AAAA">AAAA</option><option value="MX">MX</option><option value="CNAME">CNAME</option><option value="TXT">TXT</option><option value="NS">NS</option><option value="CAA">CAA</option><option value="SRV">SRV</option></select>
                                      DNS Propagation</button>
                                      <button class="btn btn-success btn-sm" id="traceroute" type="button">
                                      <a onclick="run('traceroute')" style="z-index: 9999;padding: 10px 0;">Network Test</a>   
                                      <select class="tipe2"><option value="ping">ping</option><option value="ping6">ping6</option><option value="mtr">mtr</option><option value="mtr6">mtr6</option><option value="trace">traceroute</option><option value="trace6">traceroute6</option></select>
                                      </button>
                                      <button class="btn btn-info btn-sm" id="cekssl" type="button" onclick="run('cekssl')">SSL Checker</button>
                                      <?php if(in_array(getIPAddress(),$ipwhitelist)): ?>
									   <button class="btn btn-primary btn-sm" id="product" type="button">
                                      <a onclick="run('product')" style="z-index: 9999;padding: 10px 0;">Domainesia Find</a>   
                                      <select class="gol"><option value="services">Service Hostname</option><option value="username">Username</option><option value="domains">Domain</option><option value="invoice">Invoice</option><option value="ip">IP</option><option value="email">Email</option><option value="tiketid">TIket By ID</option><option value="tiketsub">Tiket By Subject</option></select>
                                      </button>
                                      <a class="btn btn-default btn-sm" id="whois" type="button" href="https://my.domainesia.com/control/api/chatwoot/canned.php" target="_blank">Canned Response</a> 
                                      <?php if(getIPAddress()=='103.147.154.56'): ?> 
                                      <!--<button class="btn btn-success btn-sm" id="cekakun" type="button" onclick="run('cekakun')">Query Akun Utama</button>-->
									  <?php endif; endif; ?>
                                      <button class="btn btn-danger btn-sm" id="hideemail" type="button" onclick="run('hideemail')">Email Sensor</button>
                                    </div>
                                </div>
                                <div class="text-left mb-3" id="response">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Footer-->
        <footer class="footer bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 h-100 text-center text-lg-start my-auto">
                        <ul class="list-inline mb-2">
                            <!--<li class="list-inline-item"><a href="#!">About</a></li>
                            <li class="list-inline-item">⋅</li>
                            <li class="list-inline-item"><a href="#!">Contact</a></li>
                            <li class="list-inline-item">⋅</li>
                            <li class="list-inline-item"><a href="#!">Terms of Use</a></li>
                            <li class="list-inline-item">⋅</li>
                            <li class="list-inline-item"><a href="#!">Privacy Policy</a></li> -->
                          <?php echo nl2br(getIPAddress()) ?>			
                        </ul>
                        <p class="text-muted small mb-4 mb-lg-0">&copy; Your Website 2022. All Rights Reserved.</p>
                    </div>
                    <div class="col-lg-6 h-100 text-center text-lg-end my-auto hide">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item me-4">
                                <a href="#!"><i class="bi-facebook fs-3"></i></a>
                            </li>
                            <li class="list-inline-item me-4">
                                <a href="#!"><i class="bi-twitter fs-3"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#!"><i class="bi-instagram fs-3"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <!-- <script src="js/sb-forms-0.4.1.js"></script> -->
        <script>
        function parseURL(text) {
            try {
              var urlObject = new URL(text);
              return urlObject.hostname.trim();
            } catch (error) {
              return text.trim();
            }
          }
        function run(aksi) {
          param=$('input[name=param]').val();
          /*param=param.replace(/^(https?:\/\/)?/, '').trim();*/
          param=parseURL(param);
          if(aksi=='dnscek')
            window.open('https://dnspropagation.net/A/'+param, '_blank');
          else if(aksi=='intodns')
            window.open('https://intodns.com/'+param, '_blank');
          else if(aksi=='product'){
            gol=$('.gol').val();
            if(gol=='username')
                window.open('https://my.domainesia.com/control/index.php?rp=/control/services&username='+param, '_blank');
            else if (gol=='ip')
               window.open('https://my.domainesia.com/control/index.php?rp=/control/services&dedicatedip='+param, '_blank');
            else if (gol=='email')
               window.open('https://my.domainesia.com/control/clients.php?email='+param, '_blank');
            else if (gol=='invoice')
               window.open('https://my.domainesia.com/control/invoices.php?invoicenum='+param, '_blank');
            else if (gol=='tiketid')
               window.open('https://my.domainesia.com/control/supporttickets.php?ticketid='+param, '_blank');
            else if (gol=='tiketsub')
               window.open('https://my.domainesia.com/control/supporttickets.php?subject='+param, '_blank');   
            else
            	window.open('https://my.domainesia.com/control/index.php?rp=/control/'+gol+'&domain='+param, '_blank');
          }else if(aksi=='hideemail'){
            var censorWord = function (str) {
                 return str[0] + "*".repeat(str.length - 2) + str.slice(-1);
            }
            var censorWord2 = function (str) {
                 return str[0]+str[1]+str[2]+str[3] + "*".repeat(str.length - 8) + str.slice(-4);
            }
              
            var censorEmail = function (email){
                   var arr = email.split("@");
                   return arr[0].length>8 ? censorWord2(arr[0]) + "@" +arr[1] : censorWord(arr[0]) + "@" +arr[1];
            }
            if(param.includes('@'))
              $('input[name=param]').val(censorEmail(param));
            else 
                alert('bukan email');  
          }
          else{  
             cancelActiveRequests();
             var Request = $.ajax({
          			  type: "POST",
          			  url: "aksi.php",
          			  data:{'param': param,'aksi':aksi,'tipe':$('.tipe').val(),'tipe2':$('.tipe2').val()},
          			  dataType:"html",
          			  success: function(data){
          			  	$('#response').html(data);
          			  },
                  beforeSend: function(){
                    $('#response').html('Loading '+aksi+'.......');
                  },
          			  error:function(XMLHttpRequest){
          				  console.log(XMLHttpRequest.responseText);
          			  }
          	  });
              activeRequests.push(Request);
          }
        }
        var activeRequests = [];
        function cancelActiveRequests() {
            for (var i = 0; i < activeRequests.length; i++) {
                activeRequests[i].abort();
            }
            activeRequests = [];
        }
        
        </script>
      
    </body>
</html>
