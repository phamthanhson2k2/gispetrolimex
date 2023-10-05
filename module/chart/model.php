<?php
	class ChartModel
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

		function get_huyen()
		{
			$congty = "SELECT maqh, name FROM devvn_quanhuyen WHERE matp = 92 ORDER BY name ASC";
			return $this->db_helper->execute($congty, 0);
		}

	}
?>