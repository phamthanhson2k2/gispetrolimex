<?php
	class ChangepwdModel {
		
		private $db_helper;
		private $security;
		function __construct()
		{
			$this->db_helper = db_helper::get_instance();
			$this->security = new security();
		}
		
		function update_acc($fname, $email, $uid)
		{
			$escaped = $this->db_helper->escape(array($fname, $email));
			$query = sprintf("UPDATE user SET fullname = '%s', email = '%s' WHERE uid = %d", $escaped[0], $escaped[1], $uid);
			return $this->db_helper->execute($query, 3);
		}
		
		function change_password($pwd, $uid)
		{
			$enpass = $this->security->encryption($pwd);
			return $this->db_helper->execute("UPDATE user SET password = '$enpass' WHERE uid = $uid", 3);
		}
		
		function get_curpass($uid)
		{
			$enpwd = $this->db_helper->execute("SELECT password FROM user WHERE uid = $uid", 1);
			return $this->security->decryption($enpwd);
		}
		
		function get_email($uid)
		{
			return $this->db_helper->execute("SELECT email FROM user WHERE uid = $uid", 1);
		}
	}
?>