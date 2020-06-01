<?php

if (! function_exists('pricePro')) {
    function pricePro($cat_id, $product_id, $sPrice){
		if (\Cache::has('Promotion'))
		{
			$tPrice	= $nPrice = $sPrice;
			$sRow 	= \Cache::get('Promotion');
			if($sRow){
				if(isset($sRow['w'])){
					if($sRow['w']['T']=='B'){
						$nPrice = $sPrice - $sRow['w']['D'];
					}else{
						$nPrice = $sPrice-($sPrice*($sRow['w']['D']/100));
					}
					if($nPrice < $tPrice) $tPrice = $nPrice;
				}
				if(isset($sRow['c'])){
					if (array_key_exists($cat_id, $sRow['c'])){
						if($sRow['c'][$cat_id]['T']=='B'){
							$nPrice = $sPrice - $sRow['c'][$cat_id]['D'];
						}else{
							$nPrice = $sPrice-($sPrice*($sRow['c'][$cat_id]['D']/100));
						}
					}
					if($nPrice < $tPrice) $tPrice = $nPrice;
				}
				if(isset($sRow['p'])){
					if (array_key_exists($product_id, $sRow['p'])){
						if($sRow['p'][$product_id]['T']=='B'){
							$nPrice = $sPrice - $sRow['p'][$product_id]['D'];
						}else{
							$nPrice = $sPrice-($sPrice*($sRow['p'][$product_id]['D']/100));
						}
					}
					if($nPrice < $tPrice) $tPrice = $nPrice;
				}
			}
			return ($tPrice==$sPrice)?null:$tPrice;
		}
		return null;
	}
	function gen_en_date($date, $year = '0') {
		if($date) {
			$ex     = explode('-', $date);
			$month  = str_pad($ex[1],2,'0',STR_PAD_LEFT);
			$day 	= str_pad($ex[2],2,'0',STR_PAD_LEFT);
			$return = gen_full_month($month,'en').' '.$day.','.($ex[0]+$year);
		} else {
			$return = $date;
		}
		return $return;
	}
	function gen_full_month($month_num = 0, $lang='en') {
    	$month_num = str_pad($month_num,2,'0',STR_PAD_LEFT);
    	if($lang == 'en') {
	    	$month_text = array(
	    		'0'  => '',
	    		'01' => 'January',
	    		'02' => 'February',
	    		'03' => 'March',
	    		'04' => 'April',
	    		'05' => 'May',
	    		'06' => 'June',
	    		'07' => 'July',
	    		'08' => 'August',
	    		'09' => 'September',
	    		'10' => 'October',
	    		'11' => 'November',
	    		'12' => 'December',
	    	);
	    } else if($lang == 'th') {
	    	$month_text = array(
	    		'0'  => '',
	    		'01' => 'มกราคม',
	    		'02' => 'กุมภาพันธ์',
	    		'03' => 'มีนาคม',
	    		'04' => 'เมษายน',
	    		'05' => 'พฤษภาคม',
	    		'06' => 'มิถุนายน',
	    		'07' => 'กรกฎาคม',
	    		'08' => 'สิงหาคม',
	    		'09' => 'กันยายน',
	    		'10' => 'ตุลาคม',
	    		'11' => 'พฤศจิกายน',
	    		'12' => 'ธันวาคม',
	    	);
	    }

	    return @$month_text[$month_num];
	}
}