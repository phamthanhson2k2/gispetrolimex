<?php
	class security
	{
		private $key;
		
		public function __construct()
		{		
			$this->key = 'HuynhTh@nhDu@Gm@il.Com';	
		}
		
		public function encryption($str_to_enc)
		{
			return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($this->key), $str_to_enc, MCRYPT_MODE_CBC, md5(md5($this->key))));
		}
		
		public function decryption($str_to_dec)
		{
			return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($this->key), base64_decode($str_to_dec), MCRYPT_MODE_CBC, md5(md5($this->key))), "\0");
		}		
		
		public static function md5_hash($str)
		{
			return md5($str);
		}
		
		function __destruct()
		{
			$this->key;
		}
	}
?>