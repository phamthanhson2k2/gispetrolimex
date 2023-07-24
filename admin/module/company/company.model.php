<?php
	class CompanyModel
	{
		private $db;
		private $con;
		
		function __construct(){
			$this->db = db_helper::get_instance();
			$this->con = config::get_instance();
		}
		
		public function add_cat($name, $add, $phone, $email, $tax, $logo){
			$query ="insert into congty(cty_ten, cty_diachi, cty_sdt, cty_email, cty_mst, cty_logo) values ('$name', '$add', '$phone', '$email', '$tax', '$logo')"; 
			return $this->db->execute($query, 3);
		}
		
		public function upd_cat_img_edit($name, $add, $phone, $email, $tax, $logo, $cid){
			$query = "update congty set cty_ten = '$name', cty_diachi = '$add', cty_sdt = '$phone', cty_email = '$email', cty_mst = '$tax', cty_logo = '$logo' where cty_ma = $cid";
			return $this->db->execute($query, 3);
		}
		
		public function upd_cat_img($name, $add, $phone, $email, $tax, $cid){
			$query = "update congty set cty_ten = '$name', cty_diachi = '$add', cty_sdt = '$phone', cty_email = '$email', cty_mst = '$tax' where cty_ma = $cid";
			return $this->db->execute($query, 3);
		}
		
		public function del_cat($cid){
			return $this->db->execute("delete from congty where cty_ma = $cid", 3);
		}
		
		public function get_list($msg = ''){
			$query1 = '';
			$query1 = "select count(cty_ma) from congty";
			$row_per_page = $this->con->get_row_per_page();
			$page = !isset($_GET['page'])||$_GET['page']<=0||!is_numeric($_GET['page'])?1:$_GET['page'];
			$total_item = $this->db->execute($query1, 1);
			$total_page = ceil($total_item/$row_per_page);
			$total_page = $total_page > 0 ? $total_page : 1;
			$page = $page > $total_page ? $total_page : $page;
			$start = $page*$row_per_page-$row_per_page;
			include_once('share/_paging.php');
		
			$html = '<h2 class="sub-header">Danh sách Công ty</h2>';
			$html .= $msg .'
				
			  <div class="row">
				  <div class="col-md-12 col-sm-12">
					<div class="panel panel-default">
						<div class="panel-body">
							<form enctype="multipart/form-data" method="post" action="home.php?m=company&act=add" onSubmit="return chk()" id="frm">
								<div class="form-group col-md-6 col-sm-12 col-xs-12" style="padding-left:0px;">
									<label>Tên công ty </label>
									<input type="text" class="form-control" id="txt-name"  name="txtName" value="">
								</div>
								<div class="form-group col-md-6 col-sm-12 col-xs-12" style="padding-left:0px;">
									<label>Địa chỉ </label>
									<input type="text" class="form-control" id="txt-add"  name="txtAdd" value="">
								</div>
								<div class="form-group col-md-6 col-sm-12 col-xs-12" style="padding-left:0px;">
									<label>Số điện thoại </label>
									<input type="text" class="form-control" id="txt-phone"  name="txtPhone" value="">
								</div>
								<div class="form-group col-md-6 col-sm-12 col-xs-12" style="padding-left:0px;">
									<label>Email </label>
									<input type="text" class="form-control" id="txt-email"  name="txtEmail" value="">
								</div>
								<div class="form-group col-md-6 col-sm-12 col-xs-12" style="padding-left:0px;">
									<label>Mã số thuế </label>
									<input type="text" class="form-control" id="txt-tax"  name="txtTax" value="">
								</div>
								<div class="form-group col-md-6 col-sm-12 col-xs-12" style="padding-left:0px;">
									<label for="txt-img" class="control-label">Logo công ty</label>
									<div class="input-group">
										<input type="text" class="form-control" readonly id="txt-file-name" name="txtImage" value="" />
										<input type="file" name="txtImg" id="txt-img"
											accept="image/x-png, image/gif, image/jpeg, image/pjpeg" style="display:none" />
										<span class="input-group-btn">
											<button class="btn btn-primary" type="button" id="btn-open-folder" onClick="openFolder()">
												<i class="fa fa-folder-open" style="font-size:20px"></i>
											</button>
										</span>
									</div>
									<input type="hidden" value="" name="txt-img-edit" id="txt-img-edit" />
								</div>
								<div class="form-group col-md-12 col-sm-12 col-xs-12" style="padding-left:0px;">
									</br>
									<button type="submit" class="btn btn-primary" id="btn-submit">Thêm</button>
									<button type="button" class="btn btn-default" id="btn-cancel" disabled="disabled">Hủy</button>
								</div>
							</form>
						</div>
					</div>
				</div><!--/.col-->
			 </div>
			';
			$query2 = "select * from congty order by cty_ma desc limit $start, $row_per_page";
			$child_cat = $this->db->execute($query2, 0);
			$html .= '
				<table class="table table-bordered" id="tbl-list">
					<thead>
						<tr style="vertical-align:middle">
							<th class="text-center" style="width:50px">#</th>
							<th>Tên Công ty</th>
							<th>Địa chỉ</th>
							<th>Điện thoại</th>
							<th>Email</th>
							<th>MST</th>
							<th>Logo</th>
							<th>Sửa/Xoá</th>
						</tr>
					</thead>
					<tbody>
				';
			$no = $start;
			while($cat = mysql_fetch_array($child_cat)){
				$no++;
				$html .= '<tr><td style="vertical-align:middle" class="text-center">'.$no.'</td>
								<td style="vertical-align:middle">'.$cat['cty_ten'].'</td>
								<td style="vertical-align:middle">'.$cat['cty_diachi'].'</td>
								<td style="vertical-align:middle">'.$cat['cty_sdt'].'</td>
								<td style="vertical-align:middle">'.$cat['cty_email'].'</td>
								<td style="vertical-align:middle">'.$cat['cty_mst'].'</td>
								<td style="vertical-align:middle" hidden="hidden">'.$cat['cty_logo'].'</td>
								<td style="vertical-align:middle"><img src="../'.$cat['cty_logo'].'" height="50px" width="50px"></td>
								<td style="vertical-align:middle" class="text-center" style="width:100px">
									<a href="home.php?m=company&act=update&cid='.$cat['cty_ma'].'&page='.$page.'" title="Cập nhật" class="act-edit" ><i class="fa fa-pencil command"></i></a>&nbsp;&nbsp;
									<a href="home.php?m=company&act=delete&cid='.$cat['cty_ma'].'&page='.$page.'" title="Xóa" class="act-del"><i class="fa fa-times-circle command"></i></a>
								</td></tr>';
			}				
			$html .= '
					</tbody>
					<tfoot><tr><th colspan="8" class="text-right">'.paging($total_page, $page, 'home.php?m=company&act=lst').'</th></tr></tfoot>
				</table>
			';
			return $html;
		}
	}
?>