<?php
	class PriceModel
	{
		private $db;
		private $con;
		
		function __construct(){
			$this->db = db_helper::get_instance();
			$this->con = config::get_instance();
			$this->uti = utility::get_instance();
		}
		
		public function add_thoidiem($td_ngaygio, $cty_ma, $loai, $giaban){
			$escaped = $this->db->escape(array($td_ngaygio));
			$query = sprintf("INSERT INTO thoidiem(td_ngaygio) VALUES('%s')", $escaped[0]);
			$tdid = $this->db->execute($query, 4);

			if($tdid == -1)
				return -1;
			else
			{
				return $this->db->execute("INSERT INTO giaban(td_id, cty_ma, lxd_maloai, gb_giaban) VALUES($tdid, $cty_ma, $loai, '$giaban')", 3);
			}
			
		}
		
		public function upd_thoidiem($td_ngaygio, $tdid){
			$date = strtotime($td_ngaygio);
			$date = date('Y-m-d H:i:s', $date);
			$query = "update thoidiem set td_ngaygio = '$date' where td_id = $tdid";
			return $this->db->execute($query, 3);
		}
		
		public function upd_giaban($cty_ma, $lxd_maloai, $giaban, $gb){
			$query = "update giaban set cty_ma = '$cty_ma', lxd_maloai = '$lxd_maloai', gb_giaban = '$giaban' where gb_ma = $gb";
			return $this->db->execute($query, 3);
		}
		
		public function del_thoidiem($tdid){
			return $this->db->execute("delete from thoidiem where td_id = $tdid", 3);
		}
		
		public function del_giaban($gb){
			return $this->db->execute("delete from giaban where gb_ma = $gb", 3);
		}
		
		public function get_list($msg = ''){
			$cid = isset($_GET['cid']) && is_numeric($_GET['cid'])?$_GET['cid']:0;
			$lid = isset($_GET['lid']) && is_numeric($_GET['lid'])?$_GET['lid']:0;
			$query1 = '';
			$query2 = '';
			if($cid > 0)
			{
				$query1 = "SELECT count(gb.cty_ma)
						   FROM	  giaban gb, thoidiem td, congty ct, loaixangdau lx 
						   WHERE  gb.td_id = td.td_id
						   AND	  gb.cty_ma = ct.cty_ma
						   AND 	  gb.lxd_maloai = lx.lxd_maloai
						   AND 	  gb.cty_ma = $cid";
			}
			else
			{
				$query1 = "SELECT count(gb.cty_ma)
						   FROM	  giaban gb, thoidiem td, congty ct, loaixangdau lx 
						   WHERE  gb.td_id = td.td_id
						   AND	  gb.cty_ma = ct.cty_ma
						   AND 	  gb.lxd_maloai = lx.lxd_maloai";
			}
			$row_per_page = $this->con->get_row_per_page();
			$page = !isset($_GET['page'])||$_GET['page']<=0||!is_numeric($_GET['page'])?1:$_GET['page'];
			$total_item = $this->db->execute($query1, 1);
			$total_page = ceil($total_item/$row_per_page);
			$total_page = $total_page > 0 ? $total_page : 1;
			$page = $page > $total_page ? $total_page : $page;
			$start = $page*$row_per_page-$row_per_page;
			include_once('share/_paging.php');
			
			
			$parent_cat = $this->db->execute("SELECT cty_ma, cty_ten FROM congty ORDER BY cty_ma ASC", 0);
			$cty = '';
			while($pcat = mysql_fetch_array($parent_cat)){
				if($cid == $pcat['cty_ma'])
					$cty .= '<option value="'.$pcat['cty_ma'].'" selected>'.$pcat['cty_ten'].'</option>';
				else
					$cty .= '<option value="'.$pcat['cty_ma'].'">'.$pcat['cty_ten'].'</option>';
			}
			
			$loaixangdau = $this->db->execute("SELECT lxd_maloai, lxd_tenloai FROM loaixangdau ORDER BY lxd_tenloai ASC", 0);
			$lxd = '';
			while($pl = mysql_fetch_array($loaixangdau)){
				if($lxd == $pl['lxd_maloai'])
					$lxd .= '<option value="'.$pl['lxd_maloai'].'" selected>'.$pl['lxd_tenloai'].'</option>';
				else
					$lxd .= '<option value="'.$pl['lxd_maloai'].'">'.$pl['lxd_tenloai'].'</option>';
			}
			
			$html = '<h2 class="sub-header">Danh sách giá bán</h2>';
			$html .= $msg .'
				
			  <div class="row">
				  <div class="col-md-12 col-sm-12">
					<div class="panel panel-default">
						<div class="panel-body">
							<form enctype="multipart/form-data" method="post" action="home.php?m=price&act=add&cid='.$cid.'" onSubmit="return chk()" id="frm">
								<div class="col-md-6">
									<label class="control-label">Công ty đầu mối</label>
									<select class="form-control" name="txtCongTy" id="cmb-congty">
										<option value="0">Chọn công ty cung ứng</option>
										'.$cty.'
									</select>
								</div>
								<div class="col-md-6">
									<label class="control-label">Loại xăng dầu</label>
									<select class="form-control" name="txtLoai" id="cmb-loai">
										<option value="0">Chọn loại xăng dầu</option>
										'.$lxd.'
									</select>
								</div>
								<div class="form-group col-md-6">
									<label class="control-label">Ngày bán</label>
									<div class=" input-group date form_date" data-date="" data-date-format="dd-mm-yyyy H:i:s" data-link-field="dtp_input2" data-link-format="">
										<input class="form-control" size="16" type="text"  id="txt-ngayban" name="dtpinput2" value="" readonly>
										<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
										<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
									</div>
								  
								</div>
								<div class="form-group col-md-6 col-sm-12 col-xs-12">
									<label class="control-label">Giá bán </label>
									<input type="number" class="form-control" id="txt-price"  name="txtPrice" value="">
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
			if($cid > 0)
			{
				$query2 = "SELECT gb_ma, gb.td_id, gb.cty_ma, cty_ten, gb.lxd_maloai, lxd_tenloai, gb_giaban, td_ngaygio
						   FROM	  giaban gb, thoidiem td, congty ct, loaixangdau lx 
						   WHERE  gb.td_id = td.td_id
						   AND	  gb.cty_ma = ct.cty_ma
						   AND 	  gb.lxd_maloai = lx.lxd_maloai
						   AND 	  gb.cty_ma = $cid order by td_ngaygio DESC limit $start, $row_per_page";
			}
			else
			{
				$query2 = "SELECT gb_ma, gb.td_id, gb.cty_ma, cty_ten, gb.lxd_maloai, lxd_tenloai, gb_giaban, td_ngaygio
						   FROM	  giaban gb, thoidiem td, congty ct, loaixangdau lx 
						   WHERE  gb.td_id = td.td_id
						   AND	  gb.cty_ma = ct.cty_ma
						   AND 	  gb.lxd_maloai = lx.lxd_maloai
						   ORDER by td_ngaygio DESC limit $start, $row_per_page";
			}

			$child_cat = $this->db->execute($query2, 0);
			$html .= '
				<table class="table table-bordered" id="tbl-list">
					<thead>
						<tr style="vertical-align:middle">
							<th class="text-center" style="width:50px">#</th>
							<th style="text-align:center;">Công ty đầu mối</th>
							<th style="text-align:center;">Loại xăng dầu</th>
							<th style="text-align:center;">Ngày bán</th>
							<th style="text-align:center;">Giá bán</th>
							<th style="text-align:center;" hidden="hidden">Giá bán No-Format</th>
							<th style="width:50px;">Sửa/Xoá</th>
						</tr>
					</thead>
					<tbody>
				';
			$no = $start;
			while($cat = mysql_fetch_array($child_cat)){
				$ngayban = strtotime($cat['td_ngaygio']);
				$ngayban = date('d-m-Y h:i:s', $ngayban);
				$no++;
				$_pid = $cat['cty_ma']==NULL?0:$cat['cty_ma'];
				$_lid = $cat['lxd_maloai']==NULL?0:$cat['lxd_maloai'];
				$html .= '<tr><td style="vertical-align:middle" class="text-center">'.$no.'</td>
								<td style="vertical-align:middle">'.$cat['cty_ten'].'</td>
								<td style="vertical-align:middle">'.$cat['lxd_tenloai'].'</td>
								<td style="vertical-align:middle; text-align:right;">'.$ngayban.'</td>
								<td style="vertical-align:middle; text-align:right;">'.$this->uti->format_number($cat['gb_giaban']).'</td>
								<td style="vertical-align:middle; text-align:right;" hidden="hidden">'.$cat['gb_giaban'].'</td>
								<td style="vertical-align:middle" class="text-center" style="width:100px">
									<a href="home.php?m=price&act=update&tdid='.$cat['td_id'].'&lid='.$cat['lxd_maloai'].'&page='.$page.'&gb='.$cat['gb_ma'].'&cid='.$_pid.'&lid='.$_lid.'" title="Cập nhật" class="act-edit" cid="'.$_pid.'" lid="'.$_lid.'"><i class="fa fa-pencil command"></i></a>&nbsp;&nbsp;
									<a href="home.php?m=price&act=delete&tdid='.$cat['td_id'].'&gb='.$cat['gb_ma'].'&cid='.$_pid.'&lid='.$_lid.'"&page='.$page.'" title="Xóa" class="act-del"><i class="fa fa-times-circle command"></i></a>
								</td></tr>';
			}				
			$html .= '
					</tbody>
					<tfoot><tr><th colspan="8" class="text-right">'.paging($total_page, $page, 'home.php?m=price&act=lst&cid='.$cid).'</th></tr></tfoot>
				</table>
			';
			return $html;
		}
	}
?>