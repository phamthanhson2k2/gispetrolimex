<?php
	class StationModel {
		private $db;
		private $con;
		private $html;
		private $dtformat;
		private $uti;
		
		function __construct(){
			$this->db = db_helper::get_instance();
			$this->con = config::get_instance();
			$this->html = '';
			$this->dtformat = $this->con->get_date_format().' '.$this->con->get_time_format();
			$this->uti = utility::get_instance();
		}
		
		public function get_html(){
			return $this->html;
		}
		
		public function get_list($msg = ''){
			general::get_instance()->set_title('Danh sách trạm bán lẻ');
			$row_per_page = $this->con->get_row_per_page();
			$page = !isset($_GET['page'])||$_GET['page']<=0||!is_numeric($_GET['page'])?1:$_GET['page'];
			$total_item = $this->db->execute("select count(tbl_matram) from trambanle", 1);
			$total_page = ceil($total_item/$row_per_page);
			$total_page = $total_page > 0 ? $total_page : 1;
			$page = $page > $total_page ? $total_page : $page;
			$start = $page*$row_per_page-$row_per_page;
			
			include_once('share/_paging.php');
			$this->html = '<h2 class="sub-header">Danh sách trạm bán lẻ <a href="home.php?m=station&act=add" class="btn btn-primary" role="button"><i class="fa fa-plus-circle"></i> Thêm trạm bán lẻ mới</a></h2>';
			$this->html .= $msg;
			$this->html .= '<table class="table table-bordered">';
			$this->html .= '<thead>
					<tr>
						<th class="text-center">#</th>
						<th class="text-center">Tên trạm bán lẻ</th>
						<th class="text-center">Địa chỉ</th>
						<th class="text-center">Điện thoại</th>
						<th class="text-center">Kinh độ</th>
						<th class="text-center">Logo</th>
						<th class="text-center">Sửa/xoá</th>
					</tr>
				</thead>';
			
			$query = "SELECT tbl_matram, tbl_tentram, tbl_sdt, tbl_kinhdo, tbl_vido, cty_ten, cty_logo, tbl_diachi, x.name as xa, h.name as huyen, t.name as tinh
					FROM 	trambanle s, congty ct, devvn_xaphuongthitran x, devvn_quanhuyen h, devvn_tinhthanhpho t
					WHERE 	s.cty_ma = ct.cty_ma
					AND 	s.tbl_xaid = x.xaid
					AND		x.maqh = h.maqh
					AND 	h.matp = t.matp
					ORDER BY	s.tbl_matram DESC LIMIT $start, $row_per_page";
			$stations = $this->db->execute($query, 0);
			
			$this->html .= '<tbody>';
			$no = $start;
			while($p = mysql_fetch_array($stations)){
				$no++;
				$this->html .= '<tr>
					<td style="vertical-align:middle" class="text-center">'.$no.'</td>
					<td style="vertical-align:middle">'.$p['tbl_tentram'].'</br>'.$p['cty_ten'].'</td>
					<td style="vertical-align:middle">'.$p['tbl_diachi'].', '.$p['xa'].', '.$p['huyen'].', '.$p['tinh'].'</td>
					<td style="vertical-align:middle">'.$p['tbl_sdt'].'</td>
					<td style="vertical-align:middle">'.$p['tbl_kinhdo'].','.$p['tbl_vido'].'</td>
					<td style="vertical-align:middle"><img src="../'.$p['cty_logo'].'" height="50px" width="50px"></td>
					<td style="vertical-align:middle" class="text-center"><a href="home.php?m=station&act=edit&tid='.$p['tbl_matram'].'&page='.$page.'" title="Cập nhật"><i class="fa fa-pencil command"></i></a>&nbsp;&nbsp;<a href="javascript:onDel('.$p['tbl_matram'].','.$page.')" title="Xóa"><i class="fa fa-times-circle command"></i></a></td>
					</tr>';
			}
			$this->html .= '</tbody>';
			$this->html .= '<tfoot><tr><th colspan="7" class="text-right">'.paging($total_page, $page, 'home.php?m=station&act=lst').'</th></tr></tfoot>';
			$this->html .= '</table>';
		}
		public function gen_form($tentram, $diachi, $phone, $kinhdo, $vido, $cty_ma, $xaid, $tid, $page){
			$this->html = '
			<h2 class="sub-header">Thêm mới Trạm bán lẻ </h2>
			<div class="modal fade" id="galleryModal" style="z-index:20000">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header modal-header-primary">
                        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            	<span aria-hidden="true">&times;</span></button>
                            <h3><i class="fa fa-check-square-o"></i> Chọn ảnh</h3>
                        </div>
                        <div class="modal-body">
                            <iframe src="" width="100%" height="370" frameborder="0" id="iframe"></iframe>
                            <input type="hidden" id="txt-img-path" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Không</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal" id="btn-modal-ok">Đồng ý</button>
                        </div>
                    </div>
                </div>
            </div><!--/.modal-->
            <script src="module/station/js/station.js"></script>
			<div class = "row">
			<form action="?m=station&act=save&page='.$page.'" method="post" onsubmit="return chkEditArticle()" id="edit-art">
			<div class="col-md-9 col-sm-12">
				<div class="panel panel-default">
                	<div class="panel-body">
						
							<div class="form-group col-md-8 col-sm-12 col-xs-12">
								<label class="control-label">Tên trạm bán lẻ </label>
								<input type="text" class="form-control" id="txt-tentram"  name="txtTenTram" value="'.$tentram.'" placeholder="Nhập tên của trạm bán lẻ">
							</div>
							<div class="form-group col-md-4 col-sm-12 col-xs-12">
								<label class="control-label">Điện thoại </label>
								<input type="text" class="form-control" id="txt-phone"  name="txtPhone" value="'.$phone.'">
							</div>
							<div class="form-group col-md-4 col-sm-12 col-xs-12">
								<label class="control-label">Số nhà/tên đường </label>
								<input type="text" class="form-control" id="txt-add"  name="txtAdd" value="'.$diachi.'" placeholder="Nhập số nhà, tên đường">
							</div>
							
							<div class="col-md-4">
								<label class="control-label">Quận/Huyện</label>
								<select class="form-control" name="district" id="district">
									<option value="0">Chọn Huyện/Thành phố</option>
									'.$this->get_quanhuyen().'
								</select>
							</div>
							<div class="col-md-4">
								<label class="control-label">Xã/Phường/Thị trấn</label>
								<select class="form-control" name="ward" id="ward">
									<option value="0">Chọn Xã/Phường/Thị trấn</option>
								</select>
							</div>
							
							
							<div class="form-group col-md-8 col-sm-12 col-xs-12">
								<label>Địa chỉ </label>
								<input type="text" class="form-control" id="address" placeholder="Nhập địa chỉ để lấy Kinh độ/Vĩ độ">
							</div>
							<div class="form-group col-md-2 col-sm-12 col-xs-12">
								<label class="control-label">Kinh độ </label>
								<input type="text" class="form-control" id="latitude" name="txtKinhDo" value="'.$kinhdo.'">
							</div>
							<div class="form-group col-md-2 col-sm-12 col-xs-12">
								<label class="control-label">Vĩ độ </label>
								<input type="text" class="form-control" id="longitude" name="txtViDo" value="'.$vido.'">
							</div>
							<input type="hidden" name="txtTid" value="'.$tid.'">
						</form>
				
						<div class="form-group col-md-12 col-sm-12 col-xs-12">
						</br>
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d62860.62287776513!2d105.71637030261547!3d10.034268929018438!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a0629f6de3edb7%3A0x527f09dbfb20b659!2zQ-G6p24gVGjGoSwgTmluaCBLaeG7gXUsIEPhuqduIFRoxqEsIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1688977299643!5m2!1svi!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
						</div>
					</div>
				</div>
			</div><!--/.col-->
			
			<div class="col-md-3 col-sm-12">			
				<div class="panel panel-default">
					<div class="panel-heading"><i class="fa fa-th"></i><b> Chọn Công ty cung cấp</b></div>
					<div class="panel-body">'.$this->get_categories($cty_ma).'</div>
					<div class="panel-footer"><button type="submit" class="btn btn-primary" form="edit-art">Lưu</button></div>
				</div><!--/.panel category-->
			</div><!--/.col-->
			</form>
            </div>
			';
		}
		
		function get_quanhuyen()
		{
			$html='';
			$cat = $this->db->execute("SELECT maqh, name FROM devvn_quanhuyen WHERE matp = 92 ORDER BY name ASC", 0);
			while($row = mysql_fetch_array($cat))
			{
				//if($row["maqh"] == $maqh)
					//$html.= '<option value="'.$row["maqh"].'" selected="selected">'.$row["name"].'</option>';
				//else
					$html.= '<option value="'.$row["maqh"].'">'.$row["name"].'</option>';
			}
			return $html;
		}
		
		public function save_pro()
		{
			if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST')
			{
				$msg = '';
				$tentram = $_POST["txtTenTram"];
				$phone = $_POST["txtPhone"];
				$add = $_POST["txtAdd"];
				$ward = $_POST["ward"];
				$lati = $_POST["txtKinhDo"];
				$longi = $_POST["txtViDo"];
				$cty_ma = $_POST["rdCat"];
				$tid = $_POST["txtTid"];

				$escaped = $this->db->escape(array($tentram, $add, $phone, $lati, $longi));
				if(is_numeric($tid) && $tid > 0)	// edit
				{
					$query = sprintf("UPDATE trambanle SET tbl_tentram = '%s', tbl_diachi = '%s', tbl_sdt = '%s', tbl_kinhdo = '%s', tbl_vido = '%s', cty_ma = $cty_ma, tbl_xaid = $ward WHERE tbl_matram = $tid", $escaped[0], $escaped[1], $escaped[2], $escaped[3], $escaped[4]);
					$num = $this->db->execute($query, 3);
					if( $num ==1)
						$msg = '<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						Cập nhật thông tin trạm bán lẻ thành công</div>';
					else if($num ==0)
						$msg = '<div class="alert alert-warning alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						Không có Trạm bán lẻ nào được cập nhật</div>';
						else
							$msg = '<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							Lỗi xảy ra khi cập nhật thông tin trạm bán lẻ. Vui lòng thử lại sau.</div>';
				}
				else	// add new
				{
					$query = sprintf("INSERT INTO trambanle(tbl_tentram, tbl_diachi, tbl_sdt, tbl_kinhdo, tbl_vido, cty_ma, tbl_xaid)
									  VALUES('%s', '%s', '%s', '%s', '%s', $cty_ma, $ward)",
									  $escaped[0], $escaped[1], $escaped[2], $escaped[3], $escaped[4]);
					
					if($this->db->execute($query, 3) > 0)
						$msg = '<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						Thêm mới Trạm bán lẻ thành công</div>';
					else
						$msg = '<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						Lỗi xảy ra trong khi thêm mới Trạm bán lẻ. Vui lòng thử lại sau.</div>';
					
				}
			}
		
			$this->get_list($msg);
			
		}		
		public function del($tid){
			$msg = '';
			$num = $this->db->execute("delete from trambanle where tbl_matram = $tid", 3);
			if($num > 0)
				$msg = '<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				 Trạm bán lẻ đã được xoá đã được xóa!
				</div>';	
			else
				$msg = '<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				Trạm bán lẻ xóa không thành công, vui lòng thử lại sau!
				</div>';
			$this->get_list($msg);
		}
		public function act($pid){
			$msg = '';
			$num = $this->db->execute("update station set active = !active where pid = $pid", 3);
			if($num > 0)
				$msg = '<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							Cập nhật trạng thái thành công!
						</div>';	
			else
				$msg = '<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							Trạng thái cập nhật không thành công, vui lòng thử lại sau!
						</div>';
			
			$this->get_list($msg);
		}
		function get_categories($cid)
		{
			$html = '';
			$cate = $this->db->execute("SELECT cty_ma, cty_ten FROM congty ORDER BY cty_ten ASC", 0);
			while($row = mysql_fetch_array($cate))
			{
				$checked = '';
				if($row["cty_ma"] == $cid)
				{
						$checked = 'checked';
				}
				$html .= '<div class="radio"><label>
					<input type="radio" value="'.$row["cty_ma"].'" 
						form="edit-art" name="rdCat" '.$checked.'>'.$row["cty_ten"].'</label></div>';
			}
			
			return $html;
		}
		

		public function pro_tid($tid)
		{
			return $this->db->execute("SELECT * FROM trambanle WHERE tbl_matram = $tid", 0);
		}
		
	}
?>