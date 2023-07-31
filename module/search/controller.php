<?php
	class SearchController
	{
		private $model;
		private $dtformat;
		private $paging;
		
		function __construct($model)
		{
			$this->model = $model;
			$this->dtformat = config::get_instance()->get_date_format();
			$this->paging = "";
		}
		
		function process_get_huyen()
		{
			if(isset($_GET["hid"])&& is_numeric($_GET["hid"]))
				$hid = $_GET["hid"];
			else
				$hid = 0;
			$url = '\'thong-ke\'';
			$html = '';
			$html='<select name="txtHuyen" class="form-control" id="cmb-huyen" onchange="change_cb_huyen('.$url.');" >';
			if($hid == 0)
				$html.= '<option value="0" selected="selected">Tất cả Quận/Huyện</option>';
			else
				$html.= '<option value="0">Tất cả Quận/Huyện</option>';
				
			$cat = $this->model->get_huyen();
			while($row = mysql_fetch_array($cat))
			{
				if($row["maqh"] == $hid)
					$html.= '<option value="'.$row["maqh"].'" selected="selected">'.$row["name"].'</option>';
				else
					$html.= '<option value="'.$row["maqh"].'">'.$row["name"].'</option>';
			}
			$html.='</select>';
			
			return $html;
		}
		
		function process_get_cty()
		{
			if(isset($_GET["cid"])&& is_numeric($_GET["cid"]))
				$cid = $_GET["cid"];
			else
				$cid = 0;
			$url = '\'tim-kiem\'';
			$html = '';
			$html='<select name="txtCongTy" class="form-control" id="cmb-congty" onchange="change_cb_congty('.$url.');" >';
			if($cid == 0)
				$html.= '<option value="0" selected="selected">Tất cả Công ty đầu mối</option>';
			else
				$html.= '<option value="0">Tất cả Công ty đầu mối</option>';
				
			$cat = $this->model->get_cty_combobox();
			while($row = mysql_fetch_array($cat))
			{
				if($row["cty_ma"] == $cid)
					$html.= '<option value="'.$row["cty_ma"].'" selected="selected">'.$row["cty_ten"].'</option>';
				else
					$html.= '<option value="'.$row["cty_ma"].'">'.$row["cty_ten"].'</option>';
			}
			$html.='</select>';
			
			return $html;
		}
		
		function process_get_table()
		{
			$html = '';
			$no = 1;

			$html .= '
				<div class="col-md-12">
				<table class="table table-hover">
				  <thead>';
				   $tid = isset($_GET['tid']) && is_numeric($_GET['tid'])?$_GET['tid']:0;
					if($tid>0)
					{
						$query_tram = $this->model->get_thong_tin_tram_ban_le($tid);
						$row1 = mysql_fetch_array($query_tram);
						$html .= '<tr>
								  	<td colspan=4>
										<p style="text-transform:uppercase; font-weight:bold">'.$row1["tbl_tentram"].' ('.$row1["cty_ten"].')'.'</p>
										<p>Địa chỉ: '.$row1["tbl_diachi"].', '.$row1["xa"].', '.$row1["huyen"].', '.$row1["tinh"].'</p>
										<p>Điện thoại: '.$row1["tbl_sdt"].'</p>
										<p>Kinh độ: '.$row1["tbl_kinhdo"].' - Vĩ độ: '.$row1["tbl_vido"].'</p>
									</td>
								  </tr>';
					}
					
			$html .= '<tr>
					  <th class="text-center" style="width:50px">#</th>
					  <th>Loại xăng dầu</th>
					  <th class="text-center" style="width:350px">ĐVT</th>
					</tr>
				  </thead>
				  <tbody>
			';
			$node = $this->model->get_loai_xang_dau_cua_tram_ban_le();
			while($row = mysql_fetch_array($node))
			{	
				
				$html .= '
					  <tr>
					  <td style="vertical-align:middle" align="center">'.$no.'</td>
					  <td style="vertical-align:middle">'.$row["lxd_tenloai"].'</td>
					  <td style="vertical-align:middle" align="center">'.$row["lxd_donvitinh"].'</td>
				';	
				$no = $no+1;
			}
			$html .= '
				</tbody>
				</table>
				</div>
			';
			return $html;	
		}
	}
?>






















