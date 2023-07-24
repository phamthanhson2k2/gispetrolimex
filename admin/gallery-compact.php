<?php
	session_start();
	if(!isset($_SESSION["USR_ID"])|| !isset($_SESSION["USR"]))
	{
		header('Location:.');
		exit;
	}
	$page = (isset($_GET["page"]) && is_numeric($_GET["page"]) && $_GET["page"] > 0) ? $_GET["page"] : 1;
	
	function get_image()
	{
		$img_list = glob("../gallery/*.{jpg,JPG,jpeg,JPEG,gif,GIF,png,PNG,bmp,BMP}", GLOB_BRACE);
		usort($img_list, create_function('$a, $b', 'return filemtime($b) - filemtime($a);'));
		return $img_list;
	}
	
	function paging_img_list($page, &$tpage, &$cpage)
	{
		$item_per_page = 8;
		$imglist = get_image();
		$total_img = sizeof($imglist);
		$tpage = ceil($total_img/$item_per_page);
		$cpage = $page>$tpage?$tpage:$page;
		$start = $cpage * $item_per_page - $item_per_page;
		$end = $start + $item_per_page - 1;
		$images = array();
		for ($i = 0; $i < $total_img; $i++)
		{
			if($i >= $start && $i <= $end)
				array_push($images, $imglist[$i]);
		}
		return $images;
	}
	
	function gen_paging($tpage, $cpage)
	{
		$paging = "";
		if($tpage > 1)
		{
			$paging .= '<div class="btn-group" role="group" aria-label="">';
			if($cpage > 2)	// add move first button
			{
				$paging .= '<a class="btn btn-default" href="?m=gallery&page=1" role="button">
					<i class="fa fa-angle-double-left" style="font-size:20px"></i></a>';
			}
			if($cpage > 1)	// add previous button
			{
				$paging .= '<a class="btn btn-default" href="?m=gallery&page='.($cpage-1).'" role="button">
					<i class="fa fa-angle-left" style="font-size:20px"></i></a>';
			}
			
			if($cpage - 2 >= 1)
			{
				$start = $cpage-2;
				if($cpage + 2 <= $tpage)
					$end = $cpage+2;
				else
				{
					$end = $tpage;
					$start = $tpage-4>=1? $tpage-4:1;
				}
			}else
			{
				$start = 1;
				if($start + 4 <= $tpage)
					$end = $start+4;
				else
					$end = $tpage;
			}
			
			for($i = $start; $i <= $end; $i++)
			{
				$class = $i == $cpage?"btn-primary":"btn-default";
				$paging .= '<a class="btn '.$class.'" href="?m=gallery&page='.$i.'" role="button">'.$i.'</a>';
			}
			
			if($cpage < $tpage)	// add next button
			{
				$paging .= '<a class="btn btn-default" href="?m=gallery&page='.($cpage+1).'" role="button">
					<i class="fa fa-angle-right" style="font-size:20px"></i></a>';
			}
			if($cpage < $tpage-1)	// add last button
			{
				$paging .= '<a class="btn btn-default" href="?m=gallery&page='.$tpage.'" role="button">
					<i class="fa fa-angle-double-right" style="font-size:20px"></i></a>';
			}
			$paging .= '</div>';
		}
		return $paging;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="bootstrap-3.3.6-dist/css/bootstrap.min.css" type="text/css" />
        <link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.min.css" type="text/css" />
    	<title>Gallery compact</title>
        <link rel="shortcut icon" type="image/x-icon" href="fav.ico" />
    </head>
    
    <body>
    	<div class="container">
        	<div class="row">
            <?php
            	$images = paging_img_list($page, $tpage, $cpage);
				foreach ($images as $filename)
				{
					$image_name = str_replace('../gallery/','gallery/',$filename);
					$name = str_replace('../gallery/','',$filename);
					echo '<div class="col-md-2 col-sm-3 col-xs-4">';
					echo '<a href="#" class="thumbnail" data-whatever="'.$filename.'">';
					echo '<img src="thumbnail.php?p='.$filename.'&w=220&h=200" title="'.$name.'" alt="'.$name.'">';
					echo '</a>';
					echo '</div>';
				}
			?>
            </div><!--/.row-->
            
            <div class="row">
            	<div class="col-md-12">
                <?php
                	echo gen_paging($tpage, $cpage);
				?>
                <input type="hidden" id="txt-img-path" />
                </div>
            </div>
        </div><!--/.container-->
    	<script type="text/javascript" src="js/jquery.min-1.11.3.js"></script>
    	<script type="text/javascript" src="bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
        <script type="text/javascript">
			$('.thumbnail').click(function(e) {
                $('#txt-img-path').val($(this).attr('data-whatever'));
            });
		</script>
    </body>
</html>