<?php
	class SearchView
	{
		private $controller;
		private $model;
		private $gen;
		
		function __construct($controller, $model)
		{
			$this->controller = $controller;
			$this->model = $model;
			$this->gen = general::get_instance();
		}
		
		function output()
		{
			$tid = (isset($_POST['tid'])&& is_numeric($_POST['tid'])&& $_POST['tid']>0)?$_POST['tid']:0;
			return '<link rel="stylesheet" type="text/css" href="module/statis/css/statis.css" />
			
			<div class="panel panel-content-cont">
				<div class="header-content-cont">
					<h1 style="font-size:18px; margin-top:10px; padding-left:10px;">TÌM KIẾM</h1>
				</div>
				<div class="panel-body">
					<div class="row" style="padding-bottom:15px;">
						<div class="col-md-12">
							<form action="tim-kiem/'.$tid.'" method="post">
								<div class="input-group">
									<input type="text" name="search" id="search" class="form-control form-inline" placeholder="Nhập thông tin trạm tìm kiếm......." autocomplete="off" required>
									<div class="input-group-btn">
									  <button class="btn btn-default" type="submit" id="submit"><i class="glyphicon glyphicon-search"></i></button>
									</div>
								</div>
							</form>
						  </div>
						  <div class="col-md-12" style="position: relative;">
							<div class="list-group" id="show-list">
							  <!-- Here autocomplete list will be display -->
							</div>
						  </div>
						</div>
						
					</div>
					<div class="row">
						'.$this->controller->process_get_table().'
					</div>
				</div>
			</div>
			<script src="module/search/js/search.js"></script>
			';
			
		}
	}
?>