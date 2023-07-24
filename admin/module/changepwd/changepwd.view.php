<?php
	class ChangepwdView {
	
		private $controller;
		private $model;
		function __construct($controller, $model){
			$this->controller = $controller;
			$this->model = $model;
		}
		
		function output(){
			$html = '';
			general::get_instance()->set_title('Đổi mật khẩu');
			$html = '<h1 class="sub-header">Đổi mật khẩu</h1>';
			$html .= '
			<div class="row">
                <div class="col-md-12 col-sm-12">
                    <ol class="breadcrumb">
                        <li><a href="home.php">Trang chủ</a></li>
                        <li class="active">Tài khoản</li>
                    </ol>
                </div>
            </div><!--/.row-->
            
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    '.$this->controller->get_message().'
                </div>
            </div><!--/.row-->
            
            <div class="row">
                <div class="col-md-12 col-sm-12">
                   	<ul class="nav nav-tabs" role="tablist">
                    	<li role="presentation" class="'.$this->controller->get_tab_info_active().'">
                        	<a href="#info" aria-controls="info" role="tab" data-toggle="tab">
                            	<i class="fa fa-info-circle"></i> Thông tin
                            </a>
                        </li>
                        <li role="presentation" class="'.$this->controller->get_tab_pwd_active().'">
                        	<a href="#pass" aria-controls="pass" role="tab" data-toggle="tab">
                            	<i class="fa fa-asterisk"></i> Mật khẩu
                            </a>
						</li>
                    </ul><!--/.nav-tab-->
                    
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane '.$this->controller->get_tab_info_active().'" id="info">
                        	<form class="form-horizontal" action="?m=changepwd&act=update" method="post" onsubmit="return chkAccUpdate()">
								</br>
								<div class="form-group">
									<label for="txt-fullname" class="col-sm-2 control-label">Họ và tên</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="txt-fullname" placeholder="Your full name"
											value="'.htmlspecialchars($_SESSION["USR"]).'" name="txtFullname" />
									</div>
								</div></br>
								<div class="form-group">
									<label for="txt-email" class="col-sm-2 control-label">Email</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="txt-email" placeholder="Your email"
											value="'.htmlspecialchars($this->model->get_email($_SESSION["USR_ID"])).'" 
											name="txtEmail" />
									</div>
								</div>
								</br>
                                <div class="form-group">
                                	<div class="col-sm-offset-2 col-sm-10">
                                  		<button type="submit" class="btn btn-primary">Cập nhật</button>
                                	</div>
                              	</div>
                            </form>
                        </div>
                        
                        <div role="tabpanel" class="tab-pane '.$this->controller->get_tab_pwd_active().'" id="pass">
                        	<form class="form-horizontal" action="?m=changepwd&act=password" method="post" onsubmit="return chkAccPass()">
								</br><div class="form-group">
									<label for="txt-cur-pass" class="col-sm-2 control-label">Mật khẩu hiện tại</label>
									<div class="col-sm-10">
										<input type="password" class="form-control" id="txt-cur-pass" 
											placeholder="Your current password" name="txtCurPass"/>
									</div>
								</div></br>
                                <div class="form-group">
                                	<label for="txt-new-pass" class="col-sm-2 control-label">Mật khẩu mới</label>
                                    <div class="col-sm-10">
                                    	<input type="password" class="form-control" id="txt-new-pass" 
                                        	placeholder="Your new password" name="txtNewPass"/>
                                    </div>
                                </div></br>
                                <div class="form-group">
                                	<label for="txt-renew-pass" class="col-sm-2 control-label">Nhập lại mật khẩu</label>
                                    <div class="col-sm-10">
                                    	<input type="password" class="form-control" id="txt-renew-pass" 
                                        	placeholder="Type your new password again" name="txtRenewPass"/>
                                    </div>
                                </div></br>
                                <div class="form-group">
                                	<div class="col-sm-offset-2 col-sm-10">
                                  		<button type="submit" class="btn btn-primary">Cập nhật</button>
                                	</div>
                              	</div>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!--/.row-->
            <script src="module/account/js/account.js"></script>';
			
			
			
			return $html;
		}
	}
?>