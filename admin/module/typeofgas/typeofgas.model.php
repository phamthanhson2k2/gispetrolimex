<?php
	class TypeofgasModel
	{
		private $db;
		private $con;
		
		function __construct(){
			$this->db = db_helper::get_instance();
			$this->con = config::get_instance();
		}
		
		public function add_lxd($name, $dvt, $tid){
			//$query ="insert into loaixangdau(lxd_tenloai, lxd_donvitinh) values ('$name', '$dvt')"; 
			//return $this->db->execute($query, 3);
			
		
			$escaped = $this->db->escape(array($name, $dvt));
			$query = sprintf("INSERT INTO loaixangdau(lxd_tenloai, lxd_donvitinh) VALUES('%s', '%s')", $escaped[0], $escaped[1]);
			$lid = $this->db->execute($query, 4);

			if($lid == -1)
				return -1;
			else
			{
				return $this->db->execute("INSERT INTO trambanle_loaixangdau(tbl_matram, lxd_maloai) VALUES($tid, $lid)", 3);
			}
			
		}
		
		public function upd_loaixangdau($name, $dvt, $lid){
			$query = "update loaixangdau set lxd_tenloai = '$name', lxd_donvitinh = '$dvt' where lxd_maloai = $lid";
			return $this->db->execute($query, 3);
		}
		
		public function upd_trambanle_loaixangdau($matram, $maloai, $tlid){
			$query = "update trambanle_loaixangdau set tbl_matram = '$matram', lxd_maloai = '$maloai' where tl_ma = $tlid";
			return $this->db->execute($query, 3);
		}
		
		public function del_loaixangdau($lid){
			return $this->db->execute("delete from loaixangdau where lxd_maloai = $lid", 3);
		}
		
		public function del_trambanle_loaixangdau($tlid){
			return $this->db->execute("delete from trambanle_loaixangdau where tl_ma = $tlid", 3);
		}
		
		function get_trambanle()
		{
			$html='';
			$cat = $this->db->execute("SELECT tbl_matram, tbl_tentram FROM trambanle ORDER BY tbl_tentram ASC", 0);
			while($row = mysql_fetch_array($cat))
			{
				//if($row["maqh"] == $maqh)
					//$html.= '<option value="'.$row["maqh"].'" selected="selected">'.$row["name"].'</option>';
				//else
					$html.= '<option value="'.$row["tbl_matram"].'">'.$row["tbl_tentram"].'</option>';
			}
			return $html;
		}
		
		public function get_list($msg = ''){
			$tid = isset($_GET['tid']) && is_numeric($_GET['tid'])?$_GET['tid']:0;
			$query1 = '';
			$query2 = '';
			if($tid > 0)
			{
				$query1 = "SELECT count(l.lxd_maloai) 
						   FROM loaixangdau l, trambanle_loaixangdau tl
						   WHERE l.lxd_maloai = tl.lxd_maloai 
						   AND tbl_matram = $tid";
			}
			else
			{
				$query1 = "SELECT count(l.lxd_maloai) 
						   FROM loaixangdau l, trambanle_loaixangdau tl
						   WHERE l.lxd_maloai = tl.lxd_maloai";
			}
			$row_per_page = $this->con->get_row_per_page();
			$page = !isset($_GET['page'])||$_GET['page']<=0||!is_numeric($_GET['page'])?1:$_GET['page'];
			$total_item = $this->db->execute($query1, 1);
			$total_page = ceil($total_item/$row_per_page);
			$total_page = $total_page > 0 ? $total_page : 1;
			$page = $page > $total_page ? $total_page : $page;
			$start = $page*$row_per_page-$row_per_page;
			include_once('share/_paging.php');
			
			
			$parent_cat = $this->db->execute("SELECT tbl_matram, tbl_tentram FROM trambanle ORDER BY tbl_tentram ASC", 0);
			$poption = '';
			while($pcat = mysql_fetch_array($parent_cat)){
				if($tid == $pcat['tbl_matram'])
					$poption .= '<option value="'.$pcat['tbl_matram'].'" selected>'.$pcat['tbl_tentram'].'</option>';
				else
					$poption .= '<option value="'.$pcat['tbl_matram'].'">'.$pcat['tbl_tentram'].'</option>';
			}
			
			$html = '<h2 class="sub-header">Danh sách loại xăng dầu</h2>';
			$html .= $msg .'
				
			  <div class="row">
				  <div class="col-md-12 col-sm-12">
					<div class="panel panel-default">
						<div class="panel-body">
							<form enctype="multipart/form-data" method="post" action="home.php?m=typeofgas&act=add&tid='.$tid.'" onSubmit="return chk()" id="frm">
								<div class="col-md-12">
									<label class="control-label">Trạm bán lẻ</label>
									<select class="form-control" name="txtTram" id="cmb-parent">
										<option value="0">Tất cả</option>
										'.$poption.'
									</select>
								</div>
								<div class="form-group col-md-6 col-sm-12 col-xs-12">
									<label class="control-label">Loại xăng dầu </label>
									<input type="text" class="form-control" id="txt-name"  name="txtName" value="">
								</div>
								<div class="form-group col-md-6 col-sm-12 col-xs-12">
									<label class="control-label">Đơn vị tính </label>
									<input type="text" class="form-control" id="txt-dvt"  name="txtDVT" value="">
								</div>

								<div class="form-group col-md-12 col-sm-12 col-xs-12">
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
			if($tid > 0)
			{
				$query2 = "SELECT l.lxd_maloai, lxd_tenloai, lxd_donvitinh, tl_ma, t.tbl_matram, lt.lxd_maloai, tbl_tentram, tl_ma
						   FROM	  loaixangdau l, trambanle_loaixangdau lt, trambanle t 
						   WHERE  l.lxd_maloai = lt.lxd_maloai
						   AND	  lt.tbl_matram = t.tbl_matram
						   AND 	  t.tbl_matram = $tid order by l.lxd_maloai DESC limit $start, $row_per_page";
			}
			else
			{
				$query2 = "SELECT l.lxd_maloai, lxd_tenloai, lxd_donvitinh, tl_ma, t.tbl_matram, lt.lxd_maloai, tbl_tentram, tl_ma
						   FROM	  loaixangdau l, trambanle_loaixangdau lt, trambanle t 
						   WHERE  l.lxd_maloai = lt.lxd_maloai
						   AND	  lt.tbl_matram = t.tbl_matram
						   order by l.lxd_maloai DESC limit $start, $row_per_page";
			}

			$child_cat = $this->db->execute($query2, 0);
			$html .= '
				<table class="table table-bordered" id="tbl-list">
					<thead>
						<tr style="vertical-align:middle">
							<th class="text-center" style="width:50px">#</th>
							<th>Loại xăng dầu</th>
							<th>ĐVT</th>
							<th>Trạm bán lẻ</th>
							<th>Sửa/Xoá</th>
						</tr>
					</thead>
					<tbody>
				';
			$no = $start;
			while($cat = mysql_fetch_array($child_cat)){
				$no++;
				$_pid = $cat['tbl_matram']==NULL?0:$cat['tbl_matram'];
				$html .= '<tr><td style="vertical-align:middle" class="text-center">'.$no.'</td>
								<td style="vertical-align:middle">'.$cat['lxd_tenloai'].'</td>
								<td style="vertical-align:middle">'.$cat['lxd_donvitinh'].'</td>
								<td style="vertical-align:middle">'.$cat['tbl_tentram'].'</td>
								<td style="vertical-align:middle" class="text-center" style="width:100px">
									<a href="home.php?m=typeofgas&act=update&lid='.$cat['lxd_maloai'].'&page='.$page.'&tlid='.$cat['tl_ma'].'&tid='.$_pid.'" title="Cập nhật" class="act-edit" tid="'.$_pid.'"><i class="fa fa-pencil command"></i></a>&nbsp;&nbsp;
									<a href="home.php?m=typeofgas&act=delete&lid='.$cat['lxd_maloai'].'&tlid='.$cat['tl_ma'].'&tid='.$_pid.'"&page='.$page.'" title="Xóa" class="act-del"><i class="fa fa-times-circle command"></i></a>
								</td></tr>';
			}				
			$html .= '
					</tbody>
					<tfoot><tr><th colspan="8" class="text-right">'.paging($total_page, $page, 'home.php?m=typeofgas&act=lst&tid='.$tid).'</th></tr></tfoot>
				</table>
			';
			return $html;
		}
	}
?>