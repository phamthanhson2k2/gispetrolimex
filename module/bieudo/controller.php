<?php
	class BieudoController
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
		
		function process_soluong()
		{
			$html = '';	
			$cat = $this->model->get_soluong();
			while($row = mysql_fetch_array($cat))
			{
				$html .= $row["sl"];
			}
			return $html;
		}
		
		function process_cty()
		{
			$html = '';	
			$cat = $this->model->get_cty();
			while($row = mysql_fetch_array($cat))
			{
				$html .= $row["cty_ten"];
			}
			return $html;
		}
	}
?>






















