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
				$html.= '<option value="0" selected="selected">Chọn Quận/Huyện</option>';				
			$cat = $this->model->get_huyen();
			while($row = mysql_fetch_array($cat))
			{
				$html.= '<option value="'.$row["maqh"].'">'.$row["name"].'</option>';
			}
			$html.='</select>';
			
			return $html;
		}
	}
?>






















