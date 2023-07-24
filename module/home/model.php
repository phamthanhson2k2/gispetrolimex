<?php
	class HomeModel
	{	
		private $db_helper;
		
		function __construct()
		{
			$this->db_helper = db_helper::get_instance();
		}
		
		function get_product_1()
		{
			$query = "SELECT pid, name, price, prom_price, image, detail, cid
					  FROM product
					  WHERE note = 1 AND cid = 1
					  ORDER BY view DESC LIMIT 8";
			return $this->db_helper->execute($query, 0);
		}

		
		// lay mau tin feature thuoc cid
		function get_feature_node_by_cid($cid)
		{
			// lay mau tin feature
			$query = "SELECT a.aid, title, url, description, image
					  FROM article a, art_cat b
					  WHERE a.aid = b.aid AND a.feature = 1 AND b.cid = $cid AND visible = 1
					  ORDER BY modified DESC LIMIT 1";
			$article = $this->db_helper->execute($query, 0);
			if(mysql_num_rows($article)>0)
				return $article;
			else
			{
				// khong co mau tin nao trong cid dc danh dau la feature, luc nay lay mau tin moi nhat
				$query = "SELECT a.aid, title, url, description, image
						  FROM article a, art_cat b
						  WHERE a.aid = b.aid AND b.cid = $cid AND visible = 1
						  ORDER BY created DESC LIMIT 1";
				$article = $this->db_helper->execute($query, 0);
				
				return $article;
			}
		}
		// lay 5 mau tin thuoc cid va khac mau tin da lay lam feature
		function get_new_node_by_cid($cid, $aid)
		{
			$query = "SELECT a.aid, title, url, image, description
					  FROM article a, art_cat b
					  WHERE a.aid = b.aid AND b.cid = $cid AND a.aid <> $aid AND visible = 1
					  ORDER BY created DESC LIMIT 5";
					  
			return $this->db_helper->execute($query, 0);
		}
		
		
	}
?>