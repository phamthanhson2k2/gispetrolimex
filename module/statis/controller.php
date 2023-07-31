<?php
	class StatisController
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
			$url = '\'thong-ke\'';
			$html = '';
			$html='<select name="txtCongTy" class="form-control" id="cmb-congty" onchange="change_cb_congty('.$url.');" >';
			if($cid == 0)
				$html.= '<option value="0" selected="selected">Tất cả Công ty đầu mối</option>';
			else
				$html.= '<option value="0">Tất cả Công ty đầu mối</option>';
				
			$cat = $this->model->get_cty();
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
			$t = 1;
			$node = $this->model->get_huyen_view();
			$html .= '
				<div class="col-md-12">
				<table class="table table-hover">
				  <thead>
					<tr>
					  <th class="text-center" style="width:20px">#</th>
					  <th class="text-center">Trạm bán lẻ</th>
					  <th class="text-center" style="width:350px">Địa chỉ</th>
					  <th class="text-center" style="width:100px">Điện thoại</th>
					</tr>
				  </thead>
				  <tbody>
			';
			while($row = mysql_fetch_array($node))
			{	
				$dem_tram = $this->model->count_trambale_cuacty($row["maqh"]);
				$no = 1;
				$html.= '<tr>
						 	<th colspan=4><span style="text-transform:uppercase">'.$row["name"].'</span>'.' (Có '.$dem_tram.' Trạm bán lẻ)'.'</th>
						</tr>';
						
						$cty = $this->model->get_cty_view($row["maqh"]);
						while($rowcty = mysql_fetch_array($cty))
						{
							$html .= '
								  <tr>
								  <td style="vertical-align:middle">'.$no.'</td>
								  <td style="vertical-align:middle">'.$rowcty["tbl_tentram"].'<br/><b>'.$rowcty["cty_ten"].'</b></td>
								  <td style="vertical-align:middle">'.$rowcty["tbl_diachi"].', '.$rowcty["xa"].', '.$rowcty["huyen"].', '.$rowcty["tinh"].'</td>
								  <td style="vertical-align:middle;">'.$rowcty["tbl_sdt"].'</td>
							';	
							$no = $no+1;
						}
					 $html .= '</tr>';
			}
			$html .= '
				</tbody>
				</table>
				</div>
			';
			return $html;	
		}
			
		function process_get_trambanle()
		{
			$html = '';
			$node = $this->model->get_trambanle_chitiet();
			while($row = mysql_fetch_array($node))
			{	
				
				$html .= '
				<div class="col-md-6">
					<div class="row content-item">
						<fieldset class="fsStyle">
							<legend class="legendStyle"><a href="#">'.$row["tbl_tentram"].'</a></legend>
							<div class="ct-content-text">
								<div class="ct-img">
								  <img class="image-boder-news thumbnail" src="'.$row["cty_logo"].'" alt="'.$row["tbl_tentram"].'" style="height:100px; width:100%;"/>
								</div>
								<div class="ct-text">Địa chỉ: '.$row["tbl_diachi"].', '.$row["xa"].', '.$row["huyen"].', '.$row["tinh"].'</div>
								<div class="ct-text">Điện thoại: '.$row["tbl_sdt"].'</div>
							</div>
						</fieldset>
					 </div>
				 </div>';
				 
				 /*
				 $html .= '
				 	<fieldset class="fsStyle">
					  <legend class="legendStyle">In legend</legend>
					  <p class="content">This is in legend.</p>
					</fieldset>
				 ';*/
			}
			return $html;
		}
	}
?>






















