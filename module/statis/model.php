<?php
	class StatisModel
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
		
		function get_cty()
		{
			$congty = "SELECT cty_ma, cty_ten FROM congty ORDER BY cty_ten ASC";
			return $this->db_helper->execute($congty, 0);
		}
		
		function get_huyen()
		{
			$congty = "SELECT maqh, name FROM devvn_quanhuyen WHERE matp = 92 ORDER BY name ASC";
			return $this->db_helper->execute($congty, 0);
		}
		
		function get_huyen_view()
		{
			$hid = isset($_GET['hid']) && is_numeric($_GET['hid'])?$_GET['hid']:0;
			$query = "SELECT maqh, name FROM devvn_quanhuyen WHERE matp = 92";
			if($hid > 0)
				$query .= " AND maqh = $hid";	
			$query .= " ORDER BY name ASC";
			return $this->db_helper->execute($query, 0);
		}
		
		function get_cty_view($hid)
		{
			$cid = isset($_GET['cid']) && is_numeric($_GET['cid'])?$_GET['cid']:0;
			$query = "SELECT tbl_matram, t.cty_ma, x.maqh, tbl_tentram, tbl_diachi, tbl_sdt, tbl_kinhdo, tbl_vido, cty_ten, cty_logo, h.name as huyen, x.name as xa, tt.name as tinh
			    FROM 	 trambanle t, congty ct, devvn_xaphuongthitran x, devvn_quanhuyen h , devvn_tinhthanhpho tt
			    WHERE	 t.cty_ma = ct.cty_ma
			    AND	 	 t.tbl_xaid = x.xaid 
			    AND	     x.maqh = h.maqh
			    AND 	 h.matp = tt.matp
				AND h.maqh = $hid";
			if($cid > 0)
				$query .= " AND t.cty_ma = $cid";	
			$query .= " ORDER BY tbl_tentram ASC";
			return $this->db_helper->execute($query, 0);	
		}
		
		function count_trambale_cuacty($hid)
		{
			$cid = isset($_GET['cid']) && is_numeric($_GET['cid'])?$_GET['cid']:0;
			$query = "SELECT count(*)
			    FROM 	 trambanle t, congty ct, devvn_xaphuongthitran x, devvn_quanhuyen h , devvn_tinhthanhpho tt
			    WHERE	 t.cty_ma = ct.cty_ma
			    AND	 	 t.tbl_xaid = x.xaid 
			    AND	     x.maqh = h.maqh
			    AND 	 h.matp = tt.matp
				AND h.maqh = $hid";
			if($cid > 0)
				$query .= " AND t.cty_ma = $cid";	
			$query .= " ORDER BY tbl_tentram ASC";
			return $this->db_helper->execute($query, 1);	
		}
		
		function get_trambanle_chitiet()
		{
			$hid = isset($_GET['hid']) && is_numeric($_GET['hid'])?$_GET['hid']:0;
			$cid = isset($_GET['cid']) && is_numeric($_GET['cid'])?$_GET['cid']:0;
			$query = "SELECT tbl_matram, t.cty_ma, x.maqh, tbl_tentram, tbl_diachi, tbl_sdt, tbl_kinhdo, tbl_vido, cty_ten, cty_logo, h.name as huyen, x.name as xa, tt.name as tinh
			    FROM 	 trambanle t, congty ct, devvn_xaphuongthitran x, devvn_quanhuyen h , devvn_tinhthanhpho tt
			    WHERE	 t.cty_ma = ct.cty_ma
			    AND	 	 t.tbl_xaid = x.xaid 
			    AND	     x.maqh = h.maqh
			    AND 	 h.matp = tt.matp";
			
			if($hid > 0)
				$query .= " AND h.maqh = $hid";
			if($cid > 0)
				$query .= " AND t.cty_ma = $cid";	
			
			$query .= " ORDER BY tbl_tentram ASC";
			
			return $this->db_helper->execute($query, 0);
		}

	}
?>