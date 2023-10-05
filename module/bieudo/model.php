<?php
	class BieudoModel
	{
		private $db_helper;
		public $row_per_page;
		
		function __construct()
		{
			$this->db_helper = db_helper::get_instance();
			$this->row_per_page = config::get_instance()->get_row_per_page();
		}
		
		function count_node()
		{
			$qr = "SELECT COUNT(*) FROM article a, art_cat b WHERE a.aid = b.aid AND visible=1";
			return $this->db_helper->execute($qr, 1);
		}

		function get_soluong()
		{
			$query = "SELECT count(*) as sl
			  FROM 	 trambanle t, congty ct, devvn_xaphuongthitran x, devvn_quanhuyen h , devvn_tinhthanhpho tt
			  WHERE	 t.cty_ma = ct.cty_ma
			  AND	 t.tbl_xaid = x.xaid 
			  AND	 x.maqh = h.maqh
			  AND 	 h.matp = tt.matp
			  GROUP BY ct.cty_ten";
			return $this->db_helper->execute($query, 0);
		}
		
		function get_cty()
		{
			$query = "SELECT cty_ten
			  FROM 	 trambanle t, congty ct, devvn_xaphuongthitran x, devvn_quanhuyen h , devvn_tinhthanhpho tt
			  WHERE	 t.cty_ma = ct.cty_ma
			  AND	 t.tbl_xaid = x.xaid 
			  AND	 x.maqh = h.maqh
			  AND 	 h.matp = tt.matp
			  GROUP BY ct.cty_ten";
			return $this->db_helper->execute($query, 0);
		}

	}
?>