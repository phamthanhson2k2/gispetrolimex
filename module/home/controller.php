
<?php
	class HomeController
	{
		private $model;
		
		function __construct($model)
		{
			$this->model = $model;
		}
		
		// xu ly du lieu mau tin feature
		function process_feature_node($cid)
		{
			$article = $this->model->get_feature_node_by_cid($cid);
			$article = mysql_fetch_array($article);
			return array(
				"aid"=>$article["aid"],
				"title"=>$article["title"],
				"url"=>$article["url"].".".$article["aid"],
				"desc"=>utility::split_string($article["description"], 30),
				"image"=>$article["image"]
			);
		}
		
		// xu ly du lieu 5 mau tin moi
		function process_new_node($cid, $aid)
		{
			$nodes = $this->model->get_new_node_by_cid($cid, $aid);
			$html = '';
			$t = "#0066cc";
			$t1 = "#0066cc";
			$t2 = "#0066cc";
			$t3 = "#0066cc";
			if($cid==2)
				while($row = mysql_fetch_array($nodes))
				{
				 
					$html .= '<p style="padding-botom:10px;"><a  class="color-ahref-conten " href="'.$row["url"].'.'.$row["aid"].'-1"> <i style="color: 
					
					'.$t3.'; 
					" class="fa fa-check-circle"></i> '.$row["title"].'</a></br></p>';
					
				}
			else if ($cid==3)
				while($row = mysql_fetch_array($nodes))
				{
				 
					$html .= '<p style="padding-botom:10px;"><a  class="color-ahref-conten " href="'.$row["url"].'.'.$row["aid"].'-1"> <i style="color: 
					
					'.$t1.';
					" class="fa fa-check-circle"></i> '.$row["title"].'</a></br></p>';
					
				}
			
			else 
				while($row = mysql_fetch_array($nodes))
				{
				 
					$html .= '<p style="padding-botom:10px;"><a  href="'.$row["url"].'.'.$row["aid"].'-1"> <i style="color: 
					
					'.$t.';
					" class="fa fa-check-circle"></i> '.$row["title"].'</a></br></p>';
					
				}
			
			$html.= '';
			return $html;
		}
		
		
	}
?>