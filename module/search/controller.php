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
		
		function process_get_table()
		{
			$html = '';
			$no = 1;

			$html .= '
				<table class="table table-hover">
				  <thead>';
				   $tid = isset($_GET['tid']) && is_numeric($_GET['tid'])?$_GET['tid']:0;
					if($tid>0)
					{
						$query_tram = $this->model->get_thong_tin_tram_ban_le($tid);
						$row1 = mysql_fetch_array($query_tram);
						$html .= '<tr align="justify">
								  	<td colspan=4>
										<p style="text-transform:uppercase; font-weight:bold">'.$row1["tbl_tentram"].' ('.$row1["cty_ten"].')'.'</p>
										<p>Địa chỉ: '.$row1["tbl_diachi"].', '.$row1["xa"].', '.$row1["huyen"].', '.$row1["tinh"].'</p>
										<p>Điện thoại: '.$row1["tbl_sdt"].'</p>
										<p>Kinh độ: '.$row1["tbl_kinhdo"].' - Vĩ độ: '.$row1["tbl_vido"].'</p>
									</td>
								  </tr>';
					}
					$soluong_lxd = $this->model->count_loai_xang_dau_cua_tram_ban_le();
			if($soluong_lxd >0)
			{
				$html .= '<tr>
							  <th class="text-center" style="width:20px">#</th>
							  <th>Loại xăng dầu</th>
							  <th class="text-center" style="width:40px">ĐVT</th>
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
			}
			$html .= '
				</tbody>
				</table>
			';
			return $html;	
		}
		
		function process_get_trambanle_load_to_map($tid)
		{
			$tid = isset($_GET['tid']) && is_numeric($_GET['tid'])?$_GET['tid']:0;
			$arr_trambanles = array();
			$cat = $this->model->get_thong_tin_tram_ban_le($tid);
			while($row = mysql_fetch_array($cat))
			{
				$arr_trambanles[] = $row;
			}
			return $arr_trambanles;
		}
	}
?>






















