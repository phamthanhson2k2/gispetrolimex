<?php
	class general
	{
		private static $general;
		private $title;
		private $description;
		private $keyword;
		private $image;
		private $footer;
		private $tag;
		private $tel;
		private $heading;
		
		private function __construct()
		{
			$db_helper = db_helper::get_instance();
			$gen = $db_helper->execute("SELECT * FROM general WHERE gid = 1", 0);
			$gen = mysql_fetch_array($gen);
			$this->description = $gen["description"];
			$this->image = "";
			$this->keyword = $gen["keyword"];
			$this->title = $gen["title"];
			$this->footer = $gen["footer"];
			$this->tag = $gen["tag"];
			$this->tel = $gen["phone"];
			$this->heading = $gen["heading"];
		}
		
		public static function get_instance()
		{
			if(self::$general == NULL)
				self::$general = new self();
			
			return self::$general;
		}
		
		public function get_title()
		{
			return $this->title;
		}
		
		public function set_title($title)
		{
			$this->title = $title;
		}
		
		public function get_description()
		{
			return $this->description;
		}
		
		public function set_description($description)
		{
			$this->description = $description;
		}
		
		public function get_keyword()
		{
			return $this->keyword;
		}
		
		public function set_keyword($keyword)
		{
			$this->keyword = $keyword;
		}
		
		public function get_image()
		{
			return $this->image;
		}
		
		public function set_image($image)
		{
			$this->image = utility::get_base_url().$image;
		}
		
		public function get_tel()
		{
			return $this->tel;
		}
		
		public function set_tel($tel)
		{
			$this->icon = $tel;
		}
		
		public function get_footer()
		{
			return $this->footer;
		}
		
		public function set_footer($footer)
		{
			$this->footer = $footer;
		}
		
		public function get_tag()
		{
			return $this->tag;
		}
		
		public function set_tag($tag)
		{
			$this->footer = $tag;
		}
		
		public function get_heading()
		{
			return $this->heading;
		}
		
		public function set_heading($heading)
		{
			$this->heading = $heading;
		}
	}
?>