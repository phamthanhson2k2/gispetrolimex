<?php
	class SearchModel
	{
		private $db_helper;
		public $row_per_page;
		
		function __construct()
		{
			$this->db_helper = db_helper::get_instance();
			$this->row_per_page = config::get_instance()->get_row_per_page();
		}
		/*
		function get_cty_combobox()
		{
			$congty = "SELECT cty_ma, cty_ten FROM congty ORDER BY cty_ten ASC";
			return $this->db_helper->execute($congty, 0);
		}*/
		
		function get_thong_tin_tram_ban_le($tid)
		{
			$query = "SELECT  ct.cty_ma, cty_ten, tbl_tentram, tbl_diachi, tbl_tentram, tbl_sdt, tbl_kinhdo, tbl_vido, x.name as xa, h.name as huyen, t.name as tinh, cty_logo
					  FROM 	  congty ct, trambanle tbl, devvn_xaphuongthitran x, devvn_quanhuyen h, devvn_tinhthanhpho t
					  WHERE	  ct.cty_ma = tbl.cty_ma 
					  AND 	  tbl_xaid = x.xaid
					  AND 	  x.maqh = h.maqh
					  AND 	  h.matp = t.matp";
			if($tid > 0)
				$query .= " AND tbl.tbl_matram = $tid";	
			return $this->db_helper->execute($query, 0);	
		}
		
		function get_loai_xang_dau_cua_tram_ban_le()
		{
			$tid = isset($_GET['tid']) && is_numeric($_GET['tid'])?$_GET['tid']:0;
			$query = "SELECT  ct.cty_ma, cty_ten, tbl_tentram, lxd.lxd_maloai, lxd_tenloai, lxd_donvitinh, tbl_kinhdo, tbl_vido
					  FROM 	  congty ct, trambanle tbl, loaixangdau lxd, trambanle_loaixangdau tl
					  WHERE	  ct.cty_ma = tbl.cty_ma 
					  AND 	  tbl.tbl_matram = tl.tbl_matram
					  AND 	  lxd.lxd_maloai = tl.lxd_maloai";
			if($tid > 0)
				$query .= " AND tbl.tbl_matram = $tid";	
			$query .= " ORDER BY lxd_tenloai ASC";
			return $this->db_helper->execute($query, 0);	
		}
	}
?>