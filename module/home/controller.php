
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
			while($row = mysql_fetch_array($cat))
			{
				//$html.= '<option value="'.$row["cty_ma"].'">'.$row["cty_ten"].'</option>';
				if($row["cty_ma"] == $cid)
					$html.= '<option value="'.$row["cty_ma"].'" selected="selected">'.$row["cty_ten"].'</option>';
				else
					$html.= '<option value="'.$row["cty_ma"].'">'.$row["cty_ten"].'</option>';
			}
			$html.='</select>';
			
			return $html;
		}
		
		function process_get_cty_trambanle()
		{
			$html='<select name="cmbCongTyTBL" class="form-control" id="cmbCongTyTBL">';
			$html.= '<option value="0" selected="selected">Tất cả các Công ty TBL</option>';
			$cat = $this->model->get_cty_trambanle();
			while($row = mysql_fetch_array($cat))
			{
				$html.= '<option value="'.$row["cty_ma"].'">'.$row["cty_ten"].'</option>';
			}
			$html.='</select>';
			return $html;
		}
		
	}
?>