<?php
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

header('Location: https://my.domainesia.com/control/api/chatwoot/canned.php ');
?>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Domainesia - Canned Response</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="favicon.png" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" type="text/css" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="/../css/styles.css" rel="stylesheet" />
        <!-- Data Tables CSS -->
        <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-C4648P71NX"></script>
        <style>
          .masthead {background-color:#fff !important;}
          .dataTables_wrapper .dataTables_filter {
            float: left;
            text-align: left;
          }
          div.dataTables_info,.dataTables_wrapper .dataTables_paginate .paginate_button, .dataTables_wrapper .dataTables_paginate .paginate_button.current {color:#000 !important;}
          table td pre {
            white-space: pre-wrap;
            word-wrap: break-word;
          }
      
          table td pre,
          table td pre * {
            max-width: 100%;
            width: 100%;
          }
      
          table td {
            padding: 0;
            position: relative;
            overflow: hidden;
          }
      
          table td button.copy-button {
            display: none;
          }
      
          table td:hover button.copy-button {
            display: block;
          }
          .overlay {
          position: absolute;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          background-color: rgba(0, 0, 0, 0.4);
          opacity: 0;
          transition: opacity 0.3s;
          display: flex;
          justify-content: center;
          align-items: center;
          text-align: center;
          color: #fff;
          font-size: 16px;
          font-weight: bold;
          cursor: pointer;
        }
        .copy-button {
          position: absolute;
          top: 20px;
          left: 40px;
          transform: translate(-50%, -50%);
          margin: 5px;
          border: 2px solid #fff;
          background-color: transparent;
          color: #fff;
          padding: 5px 10px;
          border-radius: 5px;
          font-size: 14px;
          cursor: pointer;
          transition: border-color 0.3s, background-color 0.3s;
        }
        .copy-button:hover {
          background-color: #fff;
          color: #000;
          border-color: #fff;
        }
        .overlay:hover {
          opacity: 1;
        }
        </style>
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
                <a class="navbar-brand" href="#!"><img src="https://static.domainesia.com/assets/images/mediakit/2021/primary/fullcolor/domainesia-primary-fullcolor.svg?v=2" height="40"/> <span style="position: absolute;top: 22px;">- Canned Response</span></a>
            </div>
        </nav>
        <!-- Masthead-->
         <header class="" style="color:#000 !important">
            <div class="container position-relative">
                <div class="row justify-content-center">
                    <div class="col-xl-10">
                        <div class="text-center text-white">
                            <!-- Page heading
                            <h1 class="mb-5">Generate more leads with a professional landing page!</h1> -->
                            <div class="form-subscribe">
                                <div class="row">
                                    <div class="col-sm-12">
                                      <table id="macros" class="display" style="width:100%">
                                          <thead>
                                              <tr>
                                                  <th>Judul</th>
                                                  <th>Content</th>
                                              </tr>
                                          </thead>
                                          <tfoot>
                                              <tr>
                                                  <th>Judul</th>
                                                  <th>Content</th>
                                              </tr>
                                          </tfoot>
                                      </table>
                                    </div>
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
                            <li class="list-inline-item">·</li>
                            <li class="list-inline-item"><a href="#!">Contact</a></li>
                            <li class="list-inline-item">·</li>
                            <li class="list-inline-item"><a href="#!">Terms of Use</a></li>
                            <li class="list-inline-item">·</li>
                            <li class="list-inline-item"><a href="#!">Privacy Policy</a></li> -->
                          IP ku : <?php echo getIPAddress() ?>			
                        </ul>
                        <p class="text-muted small mb-4 mb-lg-0">&copy; Your Website 2022. All Rights Reserved.</p>
                    </div>
                    <div class="col-lg-6 h-100 text-center text-lg-end my-auto">
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
        <!-- <script src="https://code.jquery.com/jquery-3.5.1.js" type="text/javascript"></script> -->
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <!-- Load the Clipboard.js library -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
        <script>
        function encode_utf8(s) {
            return unescape(encodeURIComponent(s));
          }
          $(document).ready(function () {
              var table = $('#macros').DataTable({
                            processing: true,
                            searching: true,
                            lengthChange: false,
                            language: { search: "" },
                            columnDefs: [{
                              targets: 0, // index of the column to apply the width to
                              width: '20%' // custom width of the column
                            }],
                            ajax: {
                               url : 'aksi.php',
           			               error:function(XMLHttpRequest){
                      				    console.log(XMLHttpRequest.responseText);
                      			    }
                            }
                        });
              $('div.dataTables_filter').append('<input type="button" class="btn-clear" value="Clear"/>');          
              $('input.btn-clear').on( 'click', function () {
                  $('div.dataTables_filter input[type=search]').val('').change(); 
              });                                
              $('div.dataTables_filter input[type=search]').focus();     
              cari('keyup');   
              function cari(aksi){
                $('div.dataTables_filter input[type=search]').on( aksi, function () {
                    table
                        .columns( 0 )
                        .search( this.value )
                        .draw();
                } );    
              
              }          
              table.on('mouseenter', 'td', function() {
                var cell = $(this);
                var text = cell.find('pre').text();
                if (text) {
                  var overlay = $('<div class="overlay"><button class="copy-button">Copy</button></div>');
                  cell.append(overlay);
                  var clipboard = new ClipboardJS(overlay.find('.copy-button').get(0), {
                    text: function() {
                      return text;
                    }
                  });
                  clipboard.on('success', function() {
                    overlay.find('.copy-button').text('Copied!');
                    setTimeout(function() {
                      overlay.find('.copy-button').text('Copy');
                    }, 2000);
                  });
                  clipboard.on('error', function() {
                    alert('Failed to copy text!');
                  });
                  overlay.on('click', function() {
                    clipboard.destroy();
                    $('div.dataTables_filter input[type=search]').val('').change();  
                    clipboard = new ClipboardJS(overlay.find('.copy-button').get(0), {
                      text: function() {
                        return text;
                      }
                    });
                    clipboard.on('success', function() {
                      overlay.find('.copy-button').text('Copied!');
                      setTimeout(function() {
                        overlay.find('.copy-button').text('Copy');
                      }, 2000);
                    });
                    clipboard.on('error', function() {
                      alert('Failed to copy text!');
                    });
                    clipboard.onClick(event);
                    $('div.dataTables_filter input[type=search]').focus(); 
                  });
                  cell.on('mouseleave', function() {
                    overlay.remove();
                  });
                }
              });
              
              

          });
        </script>
    </body>
</html>
