<?php
	class config
	{
		private $serv_name;
		private $db_name;
		private $username;
		private $password;
		private $thousands_sep;
		private $decimal_sep;
		private $decimal_num;
		private $auth_email;
		private $auth_pass;
		private $debug;
		private $row_per_page;
		private $date_format;
		private $time_format;
		private $timezone;
		private $template;
		private static $instance;
		
		private function __construct()
		{
			$sec = new security();
			$content = file_get_contents('config.con', FILE_USE_INCLUDE_PATH);
			$config = json_decode($content, true);
			$this->serv_name = $config['config'][0]['sever_name'];
			$this->db_name = $config['config'][0]['db_name'];
			$this->username = $config['config'][0]['db_usr_name'];
			$this->password = $sec->decryption($config['config'][0]['db_usr_password']);
			$this->thousands_sep = $config['config'][0]['thousands_separator'];
			$this->decimal_sep = $config['config'][0]['decimal_separator'];
			$this->decimal_num = $config['config'][0]['decimal_num'];
			$this->auth_email = $config['config'][0]['auth_email'];
			$this->auth_pass = $config['config'][0]['auth_password']==''?'':$sec->decryption($config['config'][0]['auth_password']);
			$this->debug = $config['config'][0]['debug'];
			$this->row_per_page = $config['config'][0]['row_per_page'];
			$this->date_format = $config['config'][0]['date_format'];
			$this->time_format = $config['config'][0]['time_format'];
			$this->timezone = $config['config'][0]['timezone'];
			$this->template = $config['config'][0]['template'];
		}
		
		public static function get_instance()
		{
			if(self::$instance == NULL)
				self::$instance = new self();
			
			return self::$instance;
		}
		
		public function release()
		{
			self::$instance = NULL;
		}
		
		public function get_server_name()
		{
			return $this->serv_name;
		}
		
		public function get_db_name()
		{
			return $this->db_name;
		}
		
		public function get_username()
		{
			return $this->username;
		}
		
		public function get_password()
		{
			return $this->password;
		}
		
		public function get_thousands_separator()
		{
			return $this->thousands_sep;
		}
		
		public function get_decimal_separator()
		{
			return $this->decimal_sep;
		}
		
		public function get_decimal_number()
		{
			return $this->decimal_num;
		}
		
		public function get_authentication_email()
		{
			return $this->auth_email;
		}
		
		public function get_authentication_password()
		{
			return $this->auth_pass;
		}
		
		public function get_debug()
		{
			return $this->debug;
		}
		
		public function get_row_per_page()
		{
			return $this->row_per_page;
		}
		
		public function get_date_format()
		{
			return $this->date_format;
		}
		
		public function get_time_format()
		{
			return $this->time_format;
		}
		
		public function get_timezone()
		{
			return $this->timezone;
		}
		
		public function get_template()
		{
			return $this->template;
		}
		
	}
?>