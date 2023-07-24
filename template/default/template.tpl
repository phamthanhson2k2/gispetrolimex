<!DOCTYPE html>
<html lang="vi"><head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    	<meta name="viewport" content="width=device-width, initial-scale=1" />
        <base href="<?php echo $BASE ?>" />
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo $PATH ?>fav.ico" />
        <link rel="stylesheet" href="<?php echo $PATH ?>font-awesome-4.5.0/css/font-awesome.min.css" />
        <link href="<?php echo $PATH ?>bootstrap-3.3.6-dist/css/bootstrap.min.css" rel="stylesheet" />
        <link href="<?php echo $PATH ?>bootstrap-3.3.6-dist/css/bootstrap-theme.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="<?php echo $PATH ?>fancybox-2.1.5/jquery.fancybox.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo $PATH ?>css/style.css" />
        <link rel="stylesheet" href="template/default/nivo-slider/nivo-slider.css" type="text/css" media="screen" />
        <link href="template/default/css/animate.min.css" rel="stylesheet">
        
        <script type="text/javascript" src="template/default/js/wow.min.js"></script>
        
		<script src="<?php echo $PATH ?>js/jquery.min-1.11.3.js" type="text/javascript"></script>
        <script src="<?php echo $PATH ?>bootstrap-3.3.6-dist/js/bootstrap.min.js" type="text/javascript"></script>
        
        <script type="text/javascript" src="<?php echo $PATH ?>fancybox-2.1.5/jquery.fancybox.pack.js?v=2.1.5"></script>
    	<script src="<?php echo $PATH ?>js/script.js" type="text/javascript"></script>
		<link rel="stylesheet" href="<?php echo $PATH ?>css/bootstrap-dropdownhover.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php echo $PATH ?>css/bootstrap-dropdownhover.min.css" type="text/css" media="screen" />
		<script src="<?php echo $PATH ?>js/bootstrap-dropdownhover.min.js" type="text/javascript"></script>
        <title><?php echo $TITLE ?></title>

        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
        crossorigin=""/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw-src.css"
        integrity="sha512-vJfMKRRm4c4UupyPwGUZI8U651mSzbmmPgR3sdE3LcwBPsdGeARvUM5EcSTg34DK8YIRiIo+oJwNfZPMKEQyug=="
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    

    </head>
    
     <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-93339675-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'UA-93339675-1');
    </script>
    
    <body class="container-fluid">
	<div id="fb-root"></div>
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.5";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
        </script>
        <!--/.facebook plugin-->
	
	<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="<?php @$_GET["cid"]==''?print('active'):print('') ?>"><a href=""><i class="fa fa-home"></i> Trang chủ</a></li>
                <li class="<?php @$_GET["cid"]=='1'?print('active'):print('') ?>"><a href="#"><i class="fa fa-info-circle"></i> Giới thiệu</a></li>
                <li class="<?php @$_GET["cid"]=='2'?print('active'):print('') ?>"><a href="#"><i class="fa fa-file-text"></i> Thống kê</a></li>
            </ul><!--left-->
            <ul class="nav navbar-nav navbar-right">              
                <li class="<?php @$_GET["cid"]=='4'?print('active'):print('') ?>"><a target="_blank" href="./admin"><i class="fa fa-shopping-cart"></i> Đăng nhập</a></li>
            </ul>
        </div><!--/.nav-collapse -->        
      </div>
    </nav>
    <div class="row padding-top-banner">
    	<div class="container"></div>
        	
    </div>
	<?php
	if(isset($_GET['m']) && $_GET['m'] != "home")
	{
		echo '           
			<div class="row" style="margin-top:10px;">
                <div class="container" ><!-- /test  content -->
                    <div class="col-md-8 col-sm-12 col-xs-12 padding-desktop">
                        '.$CONTENT.'
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12 padding-desktop" >';
                            router::load_module("recommendation");
                            router::load_module("news") ;
       echo'
                    </div>
                </div>
            </div><!-- /end  content -->';
	}
    
	else
		echo $CONTENT;
	?>
	<!-- FancyBox -->
		<script type="text/javascript" src="template/default/fancybox-2.1.5/helpers/jquery.fancybox-thumbs.js"></script>
		<!-- <script type="text/javascript" src="template/default/fancybox-2.1.5/js/fanc.js"></script> -->
		<!-- <script type="text/javascript" src="template/default/fancybox/js/jquery.easing-1.3.pack.js"></script> -->
		<script type="text/javascript" src="template/default/fancybox-2.1.5/jquery.fancybox.js"></script>
		<script type="text/javascript" src="template/default/fancybox-2.1.5/jquery.fancybox.pack.js"></script>
		<script type="text/javascript" src="template/default/fancybox-2.1.5/helpers/jquery.fancybox-buttons.js"></script>
		<!-- <script type="text/javascript" src="template/default/fancybox/js/jquery.mousewheel-3.0.6.pack.js"></script> -->
        <script type="text/javascript">
		$(document).ready(function() {
			$(".fancybox").fancybox();
		});
		</script>
        <script type="text/javascript">
        	$(document).ready(function() {
				$(".various").fancybox({
					maxWidth	: 800,
					maxHeight	: 600,
					fitToView	: false,
					width		: "70%",
					height		: "70%",
					autoSize	: false,
					closeClick	: false,
					openEffect	: "elastic",
					closeEffect	: "none"
				});
			});
		</script>
	<script>
   new WOW().init();
    </script>
		<script src="https://apis.google.com/js/platform.js" async defer>{lang: 'vi'}</script>
		<script type="text/javascript" src="template/default/nivo-slider/jquery.nivo.slider.pack.js"></script>
		<script type="text/javascript" src="template/default/js/ca-mau-travel.js"></script>
		<script type="text/javascript" src="template/default/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
		
	</body>
</html>