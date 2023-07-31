<?php
	class ChartController
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
			$html = '';
			$html='<select name="cmbHuyen" class="form-control" id="cmbHuyen">';
				$html.= '<option value="0" selected="selected">Tất cả Quận/Huyện</option>';				
			$cat = $this->model->get_huyen();
			while($row = mysql_fetch_array($cat))
			{
				$html.= '<option value="'.$row["maqh"].'">'.$row["name"].'</option>';
			}
			$html.='</select>';
			
			return $html;
		}
		
		/*
		function process_get_huyen()
		{
			if(isset($_GET["hid"])&& is_numeric($_GET["hid"]))
				$hid = $_GET["hid"];
			else
				$hid = 0;
			$url = '\'chart\'';
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
		}*/
		
		
	}
?>






















