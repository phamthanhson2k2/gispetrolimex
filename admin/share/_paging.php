<?php
	
	function paging($total_page, $current_page, $url) {
		$html = '';
		if($total_page > 1){
			$start = $current_page - 3;
			$end = $current_page + 3;
			
			if($current_page <= 3){
				$start = 1;
				$end = $total_page > 7 ? 7 : $total_page;
			}
			
			if($current_page >= $total_page - 3){
				$end = $total_page;
				$start = $total_page - 6 > 0 ? $total_page - 6 : 1;
			}
				
			if($current_page > 2)
				$html .= '<a class="btn btn-default btn-sm page" href="'.$url.'&page=1" role="button"><i class="fa fa-angle-double-left"></i></a>&nbsp;';
			
			if($current_page > 1)
				$html .= '<a class="btn btn-default btn-sm page" href="'.$url.'&page='.($current_page-1).'" role="button"><i class="fa fa-angle-left"></i></a>&nbsp;';
				
			for($i=$start; $i<=$end; $i++)
			{
				if($i==$current_page)
					$html .= '<span class="btn btn-success btn-sm page" role="button">'.$i.'</span>&nbsp;';
				else
					$html .= '<a class="btn btn-default btn-sm page" href="'.$url.'&page='.$i.'" role="button">'.$i.'</a>&nbsp;';
			}
				
			if($current_page < $total_page)
				$html .= '<a class="btn btn-default btn-sm page" href="'.$url.'&page='.($current_page+1).'" role="button"><i class="fa fa-angle-right"></i></a>&nbsp;';
				
			if($current_page < $total_page-1)
				$html .= '<a class="btn btn-default btn-sm page" href="'.$url.'&page='.$total_page.'" role="button"><i class="fa fa-angle-double-right"></i></a>';
		}
		$html .= '<span class="pull-left">Trang '.$current_page.'/'.$total_page.'</span>';
		return $html;
	}
?>