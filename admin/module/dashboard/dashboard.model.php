<?php
	class DashBoardModel {
		private $db;
		private $uti;
		
		function __construct(){
			$this->db = db_helper::get_instance();
			$this->uti = utility::get_instance();
		}
		
		public function get_new_order(){
			$html = '<table class="table table-bordered">';
			$html .= '<thead><tr><th class="text-center">#</th><th>Họ tên</th><th>Địa chỉ</th><th>Điện thoại</th><th>Ngày đặt hàng</th></tr></thead>';
			$order = $this->db->execute("select * from cart where is_view =0 order by is_view asc, boo_date desc limit 10", 0);
			$html .= '<tbody>';
			$no = 0;
			while($o = mysql_fetch_array($order)){
				$no++;
				$html .= '<tr><td class="text-center">'.$no.'</td><td>'.$o['full_name'].'</td><td>'.$o['address'].'</td><td>'.$o['phone'].'</td><td>'.$o['boo_date'].'</td></tr>';
			}
			$html .= '</tbody>';
			$html .= '</table>';
			return $html;
		}
		
		public function get_hot_product(){
			$html = '<table class="table table-bordered">';
			$html .= '<thead><tr><th class="text-center">#</th><th>Tên sản phẩm</th><th class="text-right">Giá KM</th><th class="text-right">Giá bán</th><th class="text-right">Lượt xem</th><th>Tồn kho</th></tr></thead>';
			$order = $this->db->execute("select a.name, prom_price, price, view, total, b.name as danhmuc from product a, category b where a.cid = b.cid order by view desc limit 10", 0);
			$html .= '<tbody>';
			$no = 0;
			while($p = mysql_fetch_array($order)){
				$no++;
				$html .= '<tr><td class="text-center">'.$no.'</td><td>'.$p[0].'</td><td class="text-right">'.$this->uti->format_number($p['prom_price']).'</td><td class="text-right">'.$this->uti->format_number($p['price']).'</td><td class="text-right">'.$p['view'].'</td><td>'.$p['total'].'</td></tr>';
			}
			$html .= '</tbody>';
			$html .= '</table>';
			return $html;
		}
	}
?>