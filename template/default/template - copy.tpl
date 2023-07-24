<!DOCTYPE html>
<html lang="vi"><head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    	<meta name="viewport" content="width=device-width, initial-scale=1" />
        <base href="<?php echo $BASE ?>" />
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo $PATH ?>fav.ico" />
        <link rel="stylesheet" href="<?php echo $PATH ?>font-awesome-4.5.0/css/font-awesome.min.css" />
        <link href="<?php echo $PATH ?>bootstrap-3.3.6-dist/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="<?php echo $PATH ?>fancybox-2.1.5/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo $PATH ?>css/style.css" />
		<script src="<?php echo $PATH ?>js/jquery.min-1.11.3.js" type="text/javascript"></script>
        <script src="<?php echo $PATH ?>bootstrap-3.3.6-dist/js/bootstrap.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="<?php echo $PATH ?>fancybox-2.1.5/jquery.fancybox.pack.js?v=2.1.5"></script>
    	<script src="<?php echo $PATH ?>js/script.js" type="text/javascript"></script>
		<link rel="stylesheet" href="<?php echo $PATH ?>css/bootstrap-dropdownhover.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php echo $PATH ?>css/bootstrap-dropdownhover.min.css" type="text/css" media="screen" />
		<script src="<?php echo $PATH ?>js/bootstrap-dropdownhover.min.js" type="text/javascript"></script>
        <title><?php echo $TITLE ?></title>
    </head>
    
    <body>
    	<div class="container" >
			<div class="row hidden-sm hidden-xs" >
				<img class="img-responsive" src="banner/banner.png" style="width: 100%;padding-bottom: 1px;">
			</div><!-- /row banner -->
			<div class="row" >
				<nav class="navbar navbar-inverse boder-menu-sm" style="z-index:20000000">
                   <div style=" background-color:#0091ea;" class="navbar-header hidden-md hidden-lg">
				   	
                        <button style="border:1px solid #fff;" type="button " class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        							
                    </div>
                    <div data-hover="dropdown" id="navbar" class="collapse navbar-collapse">
                        <ul class="nav navbar-nav menu">
                            <li><a href="" style="font-size:17px;height:35px; padding-top:8px;">TRANG CHỦ</a></li>
							<li class="dropdown">
                              <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#" style="background-color:#40af64; font-size:17px;color: #fff; padding-left:20px; height: 35px; padding-top:8px; padding-left:30px">GIỚI THIỆU</a>
                                  <ul class="dropdown-menu dropdownhover-bottom">                            
                                        <li><a href="bai-viet/100" style="line-height:2.2;">Giới thiệu</a></li>
                                        <li><a href="bai-viet/102" style="line-height:2.2;">Hướng dẫn mua hàng</a></li>
										<li><a href="bai-viet/103" style="line-height:2.2;">Phương thức thanh toán</a></li>
                                        <li><a href="bai-viet/104" style="line-height:2.2;">Chính sách vận chuyển và giao hàng</a></li>
										<li><a href="bai-viet/105" style="line-height:2.2;">Chính sách đổi trả và giao hàng</a></li>
                                        <li><a href="bai-viet/106" style="line-height:2.2;">Chính sách bảo mật thông tin</a></li>
                                  </ul>
                            </li>
							<li><a href="bai-viet/107" style="font-size:17px;height:35px; padding-top:8px; padding-left:30px">DỊCH VỤ<span class="sr-only"></span></a></li>
							<li><a href="san-pham" style="font-size:17px;height:35px; padding-top:8px; padding-left:30px">SẢN PHẨM<span class="sr-only"></span></a></li>
							<li><a href="tin-tuc" style="font-size:17px;height:35px; padding-top:8px; padding-left:30px">TIN TỨC<span class="sr-only"></span></a></li>
							<li><a href="bai-viet/112" style="font-size:17px;height:35px; padding-top:8px; padding-left:30px">TUYỂN DỤNG<span class="sr-only"></span></a></li>
							<li><a href="." style="font-size:17px;height:35px; padding-top:8px; padding-left:30px">LIÊN HỆ<span class="sr-only"></span></a></li>
						</ul>
					</div>
			 </nav>
			</div><!-- /menu -->
			<div class="row" style="margin-left: -30px; margin-right: -30px">
            	<?php echo router::load_module('slideshowfuture')?>
            </div><!--slideshow-->
        	<div class="row noidung-sp" >
            	<div class="col-sm-3 hidden-xs tablet-left">
                	<?php echo router::load_module('category')?>
                </div>
                <div class="col-sm-9 tablet-right"> 
                	<?php echo $CONTENT ?>
                </div>
            </div>
			<div class= "row footer">
				<div class ="col-sm-9 " style="color:#eeeeee;">
					<p style="color: #ffd320; font-size:20px; padding-top:10px"><b>HỢP TÁC XÃ DỊCH VỤ SẢN XUẤT LÚA TÔM TRÍ LỰC </b></p>
					<p>	Địa chỉ: ấp 5, Xã Trí Lực, Huyện Thới Bình, Tỉnh Cà Mau<br>
						SĐT : 0919634427     Email : htxluatomtriluc@gmail.com<br>
						® Ghi rõ nguồn "HỢP TÁC XÃ DỊCH VỤ SẢN XUẤT LÚA TÔM TRÍ LỰC" khi phát lại thông tin từ website này<br>
						<a href="http://cmict.camau.gov.vn">Thiết kế và phát triển bởi Trung tâm Công nghệ Thông tin và Truyền thông tỉnh Cà Mau</a>
					</p>
				</div>			
				<div class="col-sm-3">
					<p style="color: #ffd320; font-size:18px; padding-top:10px"><b>THỐNG KÊ </b></p>
					<span style="color: #eeeeee;">
						<b>Đang online: 0016</b></br>
						<b>Tổng lượt truy cập: 0016</b>
					</span>
				</div>
				
			</div>
        </div><!--end container-->
        
       
    </body>
</html>