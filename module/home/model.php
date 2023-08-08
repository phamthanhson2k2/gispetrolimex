<?php
	class HomeModel
	{	
		private $db_helper;
		
		function __construct()
		{
			$this->db_helper = db_helper::get_instance();
		}
		
		function get_congty()
		{
			$congty = "SELECT * FROM congty ORDER BY cty_ten ASC";
			return $this->db_helper->execute($congty, 0);
		}
		
		function get_cty_trambanle()
		{
			$query_str = "SELECT c.cty_ma, c.cty_ten, c.cty_logo, t.tbl_tentram, t.tbl_kinhdo, t.tbl_vido 
				FROM congty c, trambanle t WHERE c.cty_ma = t.cty_ma ORDER BY c.cty_ma ASC";
			return $this->db_helper->execute($query_str, 0);
		}

		function get_trambanle_of_congty($cty_ma){
			$query_str = "SELECT c.cty_ma, c.cty_ten, c.cty_logo, t.tbl_tentram, t.tbl_kinhdo, t.tbl_vido 
				FROM congty c, trambanle t WHERE c.cty_ma = t.cty_ma AND c.cty_ma = $cty_ma ORDER BY c.cty_ma ASC";
			return $this->db_helper->execute($query_str, 0);
		}
		
	}
?>