
<?php
	class HomeController
	{
		private $model;
		
		function __construct($model)
		{
			$this->model = $model;
		}
		
		function process_get_congty()
		{
			$cid = 0;
			if(isset($_GET["cid"]))
				$cid = $_GET["cid"];
			else
				$cid = 0;
			$url = '\'home\'';
			//$html= '<br/>'.$cid.'<br/>';
			$html= '<select name="cmbCongTy" class="form-control" id="cmbCongTy" onchange="change_cb_cty('.$url.');" >';
			$html.= '<option value="0" selected="selected">Tất cả các Công ty cung cấp</option>';				
			$cat = $this->model->get_congty();
			$cty_string = '';
			while($row = mysql_fetch_array($cat))
			{
				//$html.= '<option value="'.$row["cty_ma"].'">'.$row["cty_ten"].'</option>';
				if($row["cty_ma"] == $cid)
					$html.= '<option value="'.$row["cty_ma"].'" selected="selected">'.$row["cty_ten"].'</option>';
				else
					$html.= '<option value="'.$row["cty_ma"].'">'.$row["cty_ten"].'</option>';
				$cty_string.= $row["cty_ten"];
			}
			$html.='</select>';

			
			
			return [$html, $cty_string];
		}
		
		function process_get_cty_trambanle()
		{
			$arr_trambanles = array();
			$cat = $this->model->get_cty_trambanle();
			while($row = mysql_fetch_array($cat))
			{
				$arr_trambanles[] = $row;
			}
			return $arr_trambanles;
		}
		
		function get_trambanle_of_congty($cid){
			$cat = $this->model->get_trambanle_of_congty($cid);
			$arr_trambanles = array();
			while($row = mysql_fetch_array($cat))
			{
				//$arr_trambanles.array_push(array($row["cty_ten"], $row["tbl_tentram"], $row["cty_logo"], $row["tbl_kinhdo"], $row["tbl_kinhdo"]));
				$arr_trambanles[] = $row;
			}
			//$arr_trambanles.array_push($cty_string);
			return $arr_trambanles;
		}
		
	}
?>