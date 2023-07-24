<?php
	session_start();
	
	// go to home page if loged in
	if(isset($_SESSION['USR'])){
		header('Location:home.php');
		exit;
	}
	
	// go to home page if cookie set
	if(isset($_COOKIE['USR'])){
		setcookie('USR', $_COOKIE['USR'], time()+(3600*24*7));
		$_SESSION['USR'] = $_COOKIE['USR'];
		header('Location:home.php');
		exit;
	}
	if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])){
		include_once('../core/security.php');
		include_once('../core/config.php');
		include_once('../core/db_helper.php');
		$enpwd = security::md5_hash($_POST['password']);

		$escaped = db_helper::get_instance()->escape(array($_POST['username']));
		$query = sprintf("select fullname, password, uid from user where username = '%s'", $escaped[0]);
		$usr = db_helper::get_instance()->execute($query, 0);
		$usr = mysql_fetch_array($usr);
		if($usr['password'] == $enpwd){
			$_SESSION['USR'] = $usr['fullname'];
			$_SESSION['USR_ID'] = $usr['uid'];
			if(isset($_POST['rem'])){
				setcookie('USR', $_SESSION['USR'], time()+(3600*24*7));
				
			}
			header('Location:home.php');
			exit;
		
		}else{
			$faild = '1';
		}
	}

    
?>
<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="fav.ico" />
        <title>Đăng nhập quản trị</title>
        <link href="bootstrap-3.3.6-dist/css/bootstrap.min.css" rel="stylesheet" />
		
        <style>
			html {
			  position: relative;
			  min-height: 100%;
			}
			body {
			  padding-top: 40px;
			  padding-bottom: 40px;
			  background-color: #eee;
			  margin-bottom: 60px;
			}
			
			.footer {
			  position: absolute;
			  bottom: 0;
			  width: 100%;
			  height: 60px;
			}
			.container .text-muted {
			  margin: 20px 0;
			  text-align:center;
			}
			.form-signin {
			  max-width: 330px;
			  padding: 15px;
			  margin: 0 auto;
			}
			.form-signin .form-signin-heading,
			.form-signin .checkbox {
			  margin-bottom: 10px;
			}
			.form-signin .checkbox {
			  font-weight: normal;
			}
			.form-signin .form-control {
			  position: relative;
			  height: auto;
			  -webkit-box-sizing: border-box;
				 -moz-box-sizing: border-box;
					  box-sizing: border-box;
			  padding: 8px;
			  font-size: 14px;
			}
			.form-signin .form-control:focus {
			  z-index: 2;
			}
			.form-signin .input-usr {
			  margin-bottom: -1px;
			  border-bottom-right-radius: 0;
			  border-bottom-left-radius: 0;
			}
			.form-signin input[type="password"] {
			  margin-bottom: 10px;
			  border-top-left-radius: 0;
			  border-top-right-radius: 0;
			}
			.btn {
				border-radius: 3px;
			}
			.form-control {
				border-radius: 3px;
			}
			.form-control:focus {
				border: 1px solid #ccc;
				webkit-box-shadow:none;
    			box-shadow:none;
			}
			.modal-header {
				padding: 10px;
				border-bottom: 1px solid #337ab7;
				background-color: #337ab7;
				color: #fff;
			}
			.modal-dialog {
				width: 400px;
				margin: 30px auto;
			}			
			.modal-content {
				border: 1px solid #337ab7;
			}
			.modal-body {
				padding: 10px;
			}
			.modal-footer {
    			padding: 7px;
				text-align: center;
			}
			.modal-content {
				border-radius: 3px;
			}
		</style>
        <script src="js/jquery.min-1.11.3.js" type="text/javascript"></script>
		<script src="bootstrap-3.3.6-dist/js/bootstrap.min.js" type="text/javascript"></script>
		
        <script type="text/javascript">
		$(document).ready(function(e) {
            <?php if(isset($faild)) echo "$('#mymodal').modal('show');" ?>
        });
		function chkSubmit(){
			if($('#username').val()==''|| $('#password').val()==''){
				$('#modal-msg').html('Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu!');
				$('#mymodal').modal('show');
				return false;
			}
			return true;
		}
		</script>
    </head>
    
    <body>
    	<div class="modal fade" tabindex="-1" role="dialog" id="mymodal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Thông báo</h4>
              </div>
              <div class="modal-body">
                <span id="modal-msg">Tên đăng nhập và mật khẩu của bạn không đúng, vui lòng kiểm tra lại</span>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Đồng ý</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    	<div class="container">

          <form class="form-signin" method="post" onSubmit="return chkSubmit()">
            <h1 class="form-signin-heading">Đăng nhập</h1>
            <label for="username" class="sr-only">Tên đăng nhập</label>
            <input type="text" name="username" id="username" class="form-control input-usr" placeholder="Tên đăng nhập" autofocus>
            <label for="password" class="sr-only">Mật khẩu</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Mật khẩu" >
            <div class="checkbox">
              <label>
                <input type="checkbox" name="rem" value="1"> Ghi nhớ tài khoản
              </label>
            </div>
            <button class="btn btn-primary btn-block" type="submit">ĐĂNG NHẬP</button>
          </form>
    
        </div> <!-- /container -->
        
        <footer class="footer">
          <div class="container">
            <p class="text-muted">&copy; 2016 - Banana Shopping Cart&trade;</p>
          </div>
        </footer>
    </body>
	<script src="ckeditor-4.5.1-full/ckeditor.js" type="text/javascript" ></script>
</html>