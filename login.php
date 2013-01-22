<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>菜脑壳后台管理系统</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/manage.css" rel="stylesheet">
    <style type="text/css">
      html, body {
        height: 100%;
        width: 100%;
        background-image:url(img/login.png); 
        background-size:cover; 
        background-attachment:fixed; 
        /*background-color:transparent; */
        background-position:50% 0;
        background-clip:border-box;
        background-origin:padding-box;
      }
      /* Wrapper for page content to push down footer */
      #wrap {
        min-height: 100%;
        height: auto !important;
        height: 100%;
        /* Negative indent footer by it's height */
        margin: 0 auto -100px;
      }

      /* Set the fixed height of the footer here */
      #push,
      #footer {
        height: 60px;
      }
      

      /* Lastly, apply responsive CSS fixes as necessary */
      @media (max-width: 767px) {
        #footer {
          margin-left: -20px;
          margin-right: -20px;
          padding-left: 20px;
          padding-right: 20px;
        }
      }
    </style>

    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>

  <body>
      <div id="wrap">
          <div style=" margin-left: auto; margin-right: auto; width: 460px; padding-top: 18%">
            <p style="font-size: 38px; color: #FFFFFF;font-weight: bold;"><img src="img/logo.png" border="0" /> <span style="color: #559446;">| </span>后台管理系统</p>
          </div>
          <div style=" margin-left: auto; margin-right: auto; width: 200px; margin-top: 5%; margin-bottom: 20px" >
              <div class="alert alert-error fade in hide" id="loginErr">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <span id="warning"></span>
              </div>
              <form>
                  <input id="username" type="text" id="uname" placeholder="用户名"><br/>
                  <input id="passwd" type="password" id="passwd" placeholder="密码">
            </form>
            <button id="login" class="btn btn-primary" style="min-width=80px;margin-left: 140px">登 陆</button>
          </div>
          <div id="push"></div>
      </div>
      <div id="footer">
      <?php include "footer.inc"?>
      </div>
      <script type="text/javascript" src="js/lib.js"></script>
      <script type="text/javascript" src="js/md5.js"></script>
      <script type="text/javascript" src="js/login.js"></script>
  </body>
</html>