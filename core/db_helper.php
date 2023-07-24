<?php
	class db_helper
	{
		private $server_name;
		private $db_name;
		private $user_name;
		private $password;
		private static $instance;
		private $debug;
		private $str;
		
		private function __construct()
		{
			$config = config::get_instance();
			$this->server_name = $config->get_server_name();
			$this->db_name = $config->get_db_name();
			$this->user_name = $config->get_username();
			$this->password = $config->get_password();
			$this->debug = $config->get_debug();
		}
		
		public static function get_instance()
		{
			if(self::$instance == NULL)
				self::$instance = new self();
			
			return self::$instance;
		}
		
		private function open()
		{
			return @mysql_connect($this->server_name, $this->user_name, $this->password) && mysql_select_db($this->db_name);
		}
		
		private function close()
		{
			mysql_close();
		}
		
		public static function check_connection($svr_name, $db_name, $user_name, $password)
		{
			$conn = mysql_connect($svr_name, $user_name, $password) && mysql_select_db($db_name);
			if($conn)
				mysql_close();
			
			return $conn;
		}
		
		/* 
		** Execute mysql query
		** $type: 0 or 1 or 2 or 3 or 4
		**  0: Return resultset
		**  1: Return first cell in resultset
		**  2: Return number of rows from a resultset by the last SELECT or SHOW
		**  3: Return the number of affected rows by the last INSERT, UPDATE, REPLACE or DELETE
		**  4: Return last number of AUTOINCREMENT column
		*/
		public function execute($query, $type)
		{
			if($this->open())
			{
				mysql_query("set names 'utf8'");
				$rs = mysql_query($query);
				if(!$rs)
				{
					if($this->debug == 'on')
						echo '<div style="position:relative; color:red; z-index:1000">Execute query error: '.mysql_error().'</div>';
					$this->close();
					return -1;
				}
				else
				{
					switch($type)
					{
						case 1:
							$rs = @mysql_result($rs, 0);
							break;
						case 2:
							$rs = mysql_num_rows($rs);
							break;
						case 3:
							$rs = mysql_affected_rows();
							break;
						case 4:
							$rs = mysql_query("select LAST_INSERT_ID()");
							$rs = @mysql_result($rs, 0);
							break;
						case 0:
						default:
					}
					$this->close();
					return $rs;
				}
			}
			else
			{
				if($this->debug == 'on')
					echo '<div style="position:relative; color:red; z-index:1000">Can not connect to database</div>';
				return -11;
			}
		}
		
		/*
		** Escape string to void sql injection
		** $arr_string: Array string to escape
		** Return array string escaped
		*/
		public function escape($arr_string)
		{
			if($this->open())
			{
				$size = count($arr_string);
				for($i = 0; $i < $size; $i++)
				{
					$arr_string[$i] = mysql_real_escape_string($arr_string[$i]);
				}
				$this->close();
				return $arr_string;
			}
			else
			{
				if($this->debug == 'on')
					echo '<div style="position:relative; color:red; z-index:1000">Can not connect to database</div>';
			}
		}
	}
?>