<?php
	class cart {
		private $products;
		private $cid;
		private $full_name;
		private $address;
		private $phone;
		private $email;
		private $note;
		private $boo_date;
		
		function __construct(){
			$this->products = array();
		}
		
		public function add_product($product){
			$count = $this->count();
			for($i = 0; $i < $count; $i++){
				if($this->products[$i]->get_pid() == $product->get_pid() && $this->products[$i]->get_size() == $product->get_size()){
					$this->products[$i]->add_quantity(1);
					return true;
				}
			}
			return array_push($this->products, $product) > $count;
		}
		
		public function minus_product($product){
			$count = $this->count();
			for($i = 0; $i < $count; $i++){
				if($this->products[$i]->get_pid() == $product->get_pid()&& $this->products[$i]->get_size() == $product->get_size()){
					if($this->products[$i]->get_quantity() <= 1){
						$this->rem_product($product);
					}else{
						$this->products[$i]->add_quantity(-1);
					}
					return true;
				}
			}
		}
		
		public function rem_product($product){
			$count = $this->count();
			$fpos = -1;
			for($i = 0; $i < $count; $i++){
				if($this->products[$i]->get_pid()==$product->get_pid() && $this->products[$i]->get_size() == $product->get_size()){
					$fpos = $i;
					break;
				}
			}
			
			if($fpos != -1){
				unset($this->products[$fpos]);
				$this->products = array_values($this->products);
			}
			
			return $fpos != -1;
		}
		
		public function clear(){
			$this->products = array();
		}
		
		public function count(){
			return count($this->products);
		}
		
		public function get_quantity(){
			$count = $this->count();
			$qty = 0;
			for($i = 0; $i < $count; $i++){
				$qty+=$this->products[$i]->get_quantity();
			}
			return $qty;
		}
		
		public function get_products(){
			return $this->products;
		}
		
		public function set_cid($cid){
			$this->cid = $cid;
		}
		
		public function get_cid(){
			return $this->cid;
		}
		
		public function set_full_name($full_name){
			$this->full_name = $full_name;
		}
		
		public function get_full_name(){
			return $this->full_name;
		}
		
		public function set_address($address){
			$this->address = $address;
		}
		
		public function get_address(){
			return $this->address;
		}
		
		public function set_phone($phone){
			$this->phone = $phone;
		}
		
		public function get_phone(){
			return $this->phone;
		}
		
		public function set_email($email){
			$this->email = $email;
		}
		
		public function get_email(){
			return $this->email;
		}
		
		public function set_note($note){
			$this->note = $note;
		}
		
		public function get_note(){
			return $this->note;
		}
		
		public function set_booking_date($boo_date){
			$this->boo_date = $boo_date;
		}
		
		public function get_booking_date(){
			return $this->boo_date;
		}
	}
?>