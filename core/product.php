<?php
	class product {
		private $pid;
		private $name;
		private $price;
		private $prom_price;
		private $unit;
		private $cid;
		private $gid;
		private $image;
		private $view;
		private $tag;
		private $detail;
		private $pub_date;
		private $qty;
		private $material;
		private $active;
		private $size;
		
		function __construct(){
			$this->qty = 1;
		}
		
		public function set_pid($pid){
			$this->pid = $pid;
		}
		
		public function get_pid(){
			return $this->pid;
		}
		
		public function set_name($name){
			$this->name = $name;
		}
		
		public function get_name(){
			return $this->name;
		}
		
		public function set_price($price){
			$this->price = $price;
		}
		
		public function get_price(){
			return $this->price;
		}
		
		public function set_prom_price($prom_price){
			$this->prom_price = $prom_price;
		}
		
		public function get_prom_price(){
			return $this->prom_price;
		}
		
		public function set_unit($unit){
			$this->unit = $unit;
		}
		
		public function get_unit(){
			return $this->unit;
		}
		
		public function set_cid($cid){
			$this->cid = $cid;
		}
		
		public function get_cid(){
			return $this->cid;
		}
		
		public function set_gid($gid){
			$this->gid = $gid;
		}
		
		public function get_gid(){
			return $this->gid;
		}
		
		public function set_image($image){
			$this->image = $image;
		}
		
		public function get_image(){
			return $this->image;
		}
		
		public function set_view($view){
			$this->view = $view;
		}
		
		public function get_view(){
			return $this->view;
		}
		
		public function set_tag($tag){
			$this->tag = $tag;
		}
		
		public function get_tag(){
			return $this->tag;
		}
		
		public function set_detail($detail){
			$this->detail = $detail;
		}
		
		public function get_detail(){
			return $this->detail;
		}
		
		public function set_pub_date($pub_date){
			$this->pub_date = $pub_date;
		}
		
		public function get_pub_date(){
			return $this->pub_date;
		}
		
		public function add_quantity($qty){
			return $this->qty += $qty;
		}
		
		public function get_quantity(){
			return $this->qty;
		}
		
		public function get_material(){
			return $this->material;
		}
		
		public function set_material($material){
			return $this->material = $material;
		}
		
		public function get_active(){
			return $this->active;
		}
		
		public function set_active($active){
			return $this->active = $active;
		}
		
		public function get_size(){
			return $this->size;
		}
		
		public function set_size($size){
			return $this->size = $size;
		}
	}
?>