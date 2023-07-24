<?php
	session_start();
	
	spl_autoload_register(function($class){
		$fname = $class.'.php';
		if(file_exists('../core/'.$fname)){
			include_once('../core/'.$fname);
		}
	});
	
	if(!isset($_SESSION['USR']))
	{echo $_SESSION['USR'].'----------';
		header('Location:.');
		exit;
	}
	
	general::get_instance()->set_title('Hệ thống quản trị GIS PETROLIMEX');
	$m = isset($_GET['m']) && !empty($_GET['m']) ? $_GET['m'] : 'dashboard';
	$CONTENT = router::load_module($m, true);
	$TITLE = general::get_instance()->get_title();
?>
<!DOCTYPE html>
<html lang="vi">
    <head>
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="fav.ico" />
        <title><?php echo $TITLE ?></title>
        <link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.min.css" />
        <link href="bootstrap-3.3.6-dist/css/bootstrap.min.css" rel="stylesheet" />
        <link href="css/style.css" rel="stylesheet" />
        <script src="js/jquery.min-1.11.3.js" type="text/javascript"></script>
		<script src="bootstrap-3.3.6-dist/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/script.js" type="text/javascript"></script>
        <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    </head>
    
    <body>
    	<div class="modal fade" tabindex="-1" role="dialog" id="mymodal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal-title">Thông báo</h4>
              </div>
              <div class="modal-body">
                <span id="modal-body"></span>
              </div>
              <div class="modal-footer" id="modal-footer">
                <!--<button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Đồng ý</button>-->
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        
    	<nav class="navbar navbar-inverse navbar-fixed-top">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a target="_blank" class="navbar-brand" href="../"><span class="b-logo">P</span></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav navbar-right">
                <li class="<?php if($m=='dashboard')echo 'active'?>"><a href="home.php?m=dashboard"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
                <li class="<?php if($m=='changepwd')echo 'active'?>">
                	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i>  <?php echo $_SESSION['USR'] ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li class="<?php if($m=='changepwd')echo 'active'?>"><a href="home.php?m=changepwd">Đổi mật khẩu</a></li>
                      <li><a href="home.php?m=logoff">Đăng xuất</a></li>
                    </ul>
                </li>
              </ul>
            </div>
          </div>
        </nav>
    
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-3 col-md-2 sidebar">
              <ul class="nav nav-sidebar">
				<li class="<?php if($m=='company')echo 'active'?>"><a href="home.php?m=company&act=lst"><i class="fa fa-book"></i> Công ty đầu mối</span></a></li>
				<li class="<?php if($m=='station')echo 'active'?>"><a href="home.php?m=station&act=lst"><i class="fa fa-book"></i> Trạm bán lẻ</span></a></li>
                <li class="<?php if($m=='typeofgas')echo 'active'?>"><a href="home.php?m=typeofgas&act=lst"><i class="fa fa-cube"></i> Loại xăng dầu</a></li>
                <li class="<?php if($m=='price')echo 'active'?>"><a href="home.php?m=price&act=lst"><i class="fa fa-indent"></i> Giá bán</a></li>
              </ul>
             
            </div>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" style="padding:20px;">
            	<?php echo $CONTENT ?>
            </div>
          </div>
		 </div>
         
         <script type="text/javascript" src="js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
		<script type="text/javascript" src="js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
        <script type="text/javascript">
            $('.form_datetime').datetimepicker({
                //language:  'fr',
                weekStart: 1,
                todayBtn:  1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                forceParse: 0,
                showMeridian: 1
            });
            $('.form_date').datetimepicker({
                language:  'fr',
                weekStart: 1,
                todayBtn:  1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                minView: 2,
                forceParse: 0
            });
            $('.form_time').datetimepicker({
                language:  'fr',
                weekStart: 1,
                todayBtn:  1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 1,
                minView: 0,
                maxView: 1,
                forceParse: 0
            });
        </script>
    </body>
</html>