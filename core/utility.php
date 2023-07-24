<?php
	class utility
	{
		private $thousands_separator;
		private $decimal_separator;
		private $decimals;
		private $date_format;
		private $time_format;
		private static $instance;
		
		private function __construct()
		{
			$config = config::get_instance();
			$this->thousands_separator = $config->get_thousands_separator();
			$this->decimal_separator = $config->get_decimal_separator();
			$this->decimals = $config->get_decimal_number();
			$this->date_format = $config->get_date_format();
			$this->time_format = $config->get_time_format();
		}
		
		public static function get_instance()
		{
			if(self::$instance == NULL)
				self::$instance = new self();
			
			return self::$instance;
		}
		
		public static function create_ramdom_string($length)
		{
			$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
			$str = NULL;
			$size = strlen($chars);
			for($i = 0; $i < $length; $i++) 
			{
				$str .= $chars[rand(0, $size - 1)];
			}
			return $str;
		}
		
		public static function create_ramdom_number($length)
		{
			$chars = '0123456789';
			$str = NULL;
			$size = strlen($chars);
			for($i = 0; $i < $length; $i++) 
			{
				if($i == 0 && $chars[rand(0, $size - 1)] == 0)
					$i--;
				else
					$str .= $chars[rand(0, $size - 1)];
			}
			return $str;
		}
		
		public static function split_string($str_to_split, $num_word)
		{
			$str_to_split = trim($str_to_split);
			$arr_str = explode(' ', $str_to_split);
			$num_of_word = count($arr_str);
			if($num_of_word <= $num_word){
				return $str_to_split;
			}
			else
			{
				$str = '';
				$arr_str = explode(' ', $str_to_split);
				for($i = 0; $i < $num_word; $i++)
					$str .= $arr_str[$i].' ';
					
				return $str.'[...]';
			}
		}
		
		public static function remove_sign($str)
		{
			$str = mb_strtolower($str, 'UTF-8');
			$str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
			$str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
			$str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
			$str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
			$str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
			$str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
			$str = preg_replace("/(đ)/", 'd', $str);
			$str = preg_replace("/(,|%|'|\"|“|”|\?|-)/", '', $str);
			$str = trim($str);
			$str = preg_replace('/\s\s+/', ' ', $str);
			$str = str_replace(' ', '-', $str);
			return $str;
		}
		
		public static function delete_file($directory, $name)
		{
			$files = glob($directory."/".$name.".*");
			foreach($files as $file)
				unlink($file);
		}
		
		public function format_number($number)
		{
			return number_format($number, $this->decimals, $this->decimal_separator, $this->thousands_separator);
		}
		
		public function conf_format_date($date)
		{
			return date($this->date_format.' '.$this->time_format, strtotime($date));
		}
		
		public function format_date($str_format, $date)
		{
			return date($str_format, strtotime($date));
		}
		
		private static function create_error_thumbnail($thumbnail_w, $thumbnail_h)
		{
			$dst_image = imagecreate($thumbnail_w, $thumbnail_h);
			$bg = imagecolorallocate($dst_image, 226, 226, 226);
			$textcolor = imagecolorallocate($dst_image, 0, 0, 0);
			imagestring($dst_image, 5, ($thumbnail_w - 80)/2, $thumbnail_h/2 - 20, "Thumbnail", $textcolor);
			imagestring($dst_image, 5, ($thumbnail_w - 50)/2, $thumbnail_h/2, "error!", $textcolor);
			header('Content-Type: image/jpeg');
			imagejpeg($dst_image, NULL, 75);
			imagedestroy($dst_image);
		}
		
		public static function create_thumbnail($img_path, $thumbnail_w, $thumbnail_h)
		{
			if(!file_exists($img_path))
			{
				self::create_error_thumbnail($thumbnail_w, $thumbnail_h);
				exit;
			}
			
			$img_pro = getimagesize($img_path);
			$src_w = $img_pro[0];
			$src_h = $img_pro[1];
			$img_type = $img_pro[2];
			
			if($img_type != 1 && $img_type != 2 && $img_type != 3)
			{
				$this->create_error_thumbnail($thumbnail_w, $thumbnail_h);
				exit;
			}
			
			/*
			** if($src_w < $thumbnail_w || $src_h < $thumbnail_h)
			** {
			**	$this->create_error_thumbnail($thumbnail_w, $thumbnail_h);
			**	exit;
			** }
			*/
			
			$dst_image = imagecreatetruecolor($thumbnail_w, $thumbnail_h);
			
			switch($img_type)
			{
				case 1:
					$src_image = imagecreatefromgif($img_path);
					break;
				case 2:
					$src_image = imagecreatefromjpeg($img_path);
					break;
				case 3:
					imagealphablending($dst_image, false);
					imagesavealpha($dst_image, true);
					$src_image = imagecreatefrompng($img_path);
					imagealphablending($src_image, true);
					break;
				default:
			}
			
			$w_x = ($src_w / $thumbnail_w);
			$h_x = ($src_h / $thumbnail_h);
			$x = $w_x > $h_x ? $h_x : $w_x;
			
			$src_size_w = $thumbnail_w * $x;
			$src_size_h = $thumbnail_h * $x;
			
			$src_x = ($src_w - $src_size_w) / 2;
			$src_x = $src_x < 0 ? 0 : $src_x;
			$src_y = ($src_h - $src_size_h) / 2;
			$src_y = $src_y < 0 ? 0 : $src_y;
			
			imagecopyresampled($dst_image, $src_image, 0, 0, $src_x, $src_y, $thumbnail_w, $thumbnail_h, $src_size_w, $src_size_h);
			header('Content-Type: '.$img_pro['mime']);
			switch($img_type)
			{
				case 1:
					imagegif($dst_image, NULL, 100);
					break;
				case 2:
					imagejpeg($dst_image, NULL, 100);
					break;
				case 3:
					imagepng($dst_image, NULL, 9);
					break;
				default:
			}
			
			imagedestroy($dst_image);
		}
		
		public static function get_base_url()
		{
			$protocal = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https://' : 'http://';
			$url = $protocal.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
			$url_arr = explode('/', $url);
			$base_url = '';
			for($i = 0; $i < sizeof($url_arr) - 1; $i++)
			{
				$base_url .= $url_arr[$i].'/';
			}
			return $base_url;
		}
	}
?>