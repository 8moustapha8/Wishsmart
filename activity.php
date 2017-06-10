<?php

//$GLOBALS['infi'] = 0;
//$GLOBALS['shop'] = 0;

	function display1()
	{
		echo "<div id=\"page-wrapper\"> <div class=\"compare\">";
	}

	function determine_ref($refine,$site){

		if ($refine == "LH" && $site == "shopclues") {
			$ref = "&sort_by=sort_price&sort_order=asc";
		}
		elseif ($refine == "LH" && $site == "ask") {
			$ref = "&sort=store_offer_price@asc";
		}
		elseif ($refine == "HL" && $site == "shopclues") {
			$ref = "&sort_by=sort_price&sort_order=desc";
		}
		elseif ($refine == "HL" && $site == "ask") {
			$ref = "&sort=store_offer_price@desc";
		}
		elseif ($refine == "POP" && $site == "shopclues") {
			$ref = "&sort_by=popularity&sort_order=desc";
		}
		elseif ($refine == "POP" && $site == "ask") {
			$ref = "";
		}
		elseif ($refine == "REl" && $site == "shopclues") {
			$ref = "";
		}
		elseif ($refine == "REl" && $site == "ask") {
			$ref = "";
		}
		else
		{
			$ref = "";
		}

		return $ref;

	}

	function display_shopclues($query,$refine){

		echo " <div class=\"col-md-6 span_8
		\"> <div class=\"activity_box\"> <div class=\"scrollbar\" id=\"style-2\"> ";
		echo "<h1>Shopclues</h1>";
		$ref = determine_ref($refine,"shopclues");
		$re = "";
		$out = scrap1($query,$ref,$re);
		$re = $out['retry'];
		$GLOBALS['shop'] = $out['price'];
		for ($i=0 ; $i < 4; $i++ ) { 
			activity_row($out['name'],$out['img'],$out['price']);
			$out = scrap1($query,$ref,$re);
			$re = $out['retry'];
			$GLOBALS['shop'] = $out['price'];
		}
		echo "</div></div></div>";
}

	function display_shopclues1($query,$refine){

		echo " <div class=\"col-md-6 span_4\"> <div class=\"activity_box\"> <div class=\"scrollbar\" id=\"style-2\"> ";
		echo "<h1>Shopclues</h1>";
		$ref = determine_ref($refine,"shopclues");
		$re = "";
		$out = scrap1($query,$ref,$re);
		$re = $out['retry'];
		$GLOBALS['shop'] = $out['price'];
		for ($i=0 ; $i < 1; $i++ ) { 
			activity_row($out['name'],$out['img'],$out['price']);
		}
		echo "</div></div></div>";

	}

function display_infibeam($query,$refine){

		echo " <div class=\"col-md-8 span_8\"> <div class=\"activity_box\"> <div class=\"scrollbar\" id=\"style-2\"> ";
		echo "<h1>Infibeam</h1>";
		$ref = determine_ref($refine,"shopclues");
		$re = "";
		$out = scrap2($query,$ref,$re,1);
		$re = $out['retry'];
		$GLOBALS['infi'] = $out['price'];
		for ($i=0 ; $i < 4; $i++ ) { 
			activity_row($out['name'],$out['img'],$out['price']);
			$out = scrap2($query,$refine,$re,$i+2);
			$re = $out['retry'];
			$GLOBALS['infi'] = $out['price'];
		}
		echo "</div></div></div>";
}

function display_infibeam1($query,$refine){
	echo " <div class=\"col-md-6 span_4\"> <div class=\"activity_box\"> <div class=\"scrollbar\" id=\"style-2\"> ";
		echo "<a class=\"navbar-brand\" href=\"#\">Infibeam</a>";
		$ref = determine_ref($refine,"shopclues");
		$re = "";
		$out = scrap2($query,$ref,$re,1);
		$re = $out['retry'];
		$GLOBALS['infi'] = $out['price'];
		activity_row($out['name'],$out['img'],$out['price']);
		echo "</div></div></div>";
}

function display_askmeba($query,$refine){

	echo " <div class=\"col-md-6 span_8\"> <div class=\"activity_box\"> <div class=\"scrollbar\" id=\"style-2\"> ";
	echo "<h1>Askme Bazaar</h1>";
	$ref = determine_ref($refine,"ask");
	$re = "";
	$out = scrap3($query,$ref,$re);
	$re = $out['retry'];
	$GLOBALS['ask'] = $out['price'];
	for ($i=0 ; $i < 4; $i++ ) {

		activity_row($out['name'],$out['img'],$out['price']);
		$out = scrap3($query,$refine,$re);
		$re = $out['retry'];
		$GLOBALS['ask'] = $out['price'];
	}
	echo "</div></div></div>";
}

function display_askmeba1($query,$refine){

	echo " <div class=\"col-md-6 span_4\"> <div class=\"activity_box\"> <div class=\"scrollbar\" id=\"style-2\"> ";
	echo "<h1>Askme Bazaar</h1>";
	$ref = determine_ref($refine,"ask");
	$re = "";
	$out = scrap3($query,$ref,$re);
	$re = $out['retry'];
	$GLOBALS['ask'] = $out['price'];
	activity_row($out['name'],$out['img'],$out['price']);
	echo "</div></div></div>";
}

function activity_row($name,$img,$price){

	echo "<div class=\"activity-row\"> <div class=\"col-xs-1\"></div> 
	 <div class=\"col-xs-8 activity-img\">";
	 echo $img;
	 //var_dump($img);
	 echo "</div> <div class=\"col-xs-8 activity-desc\"><h5>";
	 echo $name;
	 echo "</h5> <p>";
	 echo $price;
	 echo "</p> </div> <div class=\"clearfix\"> </div></div>";
}

function compare()
{
	//$price_infi = $GLOBALS['infi'] ;
	$price_shop = $GLOBALS['shop'] ;
	$price_ask = $GLOBALS['ask'];
	//$price_infi = str_replace(',','',$price_infi);
	echo "<h4>";
	if($price_ask > $price_shop)
	{
		echo "Shopclues sells the product cheaper by Rs ";
		echo $price_ask - $price_shop;
	}
	else
	{
		echo "Askme Bazaar sells the product cheaper by Rs ";
		echo $price_shop - $price_ask;
	}
	echo "</h4>";
}

function display2()
{
	//compare();
	echo "</div></div>";
}

function scrap1($query,$ref,$retry){

	$query = str_replace(' ','+',$query);
	$url = 'http://search.shopclues.com/?q=';
	$url .= $query;
	$url .= '&auto_suggest=0';
	$url .= $ref;
	if ($retry == "") {
	$output = file_get_contents($url);
	}
	else
		$output = $retry;

	$m = substr($output, strpos($output, '<h5><a href')+12);

	$link = substr($m, 0, strpos($m, '>'));

	$init = strpos($m, '>') + 1;
	$len = strpos($m, '</a>') - $init;
	$name = substr($m, $init, $len);

	$out['name'] = $name;

	$price = substr($output, strpos($output, '<div class="p_price">')+21);
	$price = substr($price, 0, strpos($price, '</div>'));

	$img = substr($output, strpos($output, $link));
	$init = strpos($img, "<img src");
	$len = strpos($img, "</a>") - $init;
	$img = substr($img, $init, $len);

	$out['img'] = $img; //prints the image

	$out['price'] = $price;
	$out['retry'] = $m;
	return $out;
}


function scrap3($query,$refine,$retry){

	$query = str_replace(' ','+',$query);
	$url = 'http://www.askmebazaar.com/index.php?defSearch=1&search_query=';
	$url .= $query;
	$url .= $refine;
	if ($retry == "") {
	$output = file_get_contents($url);
	}
	else
		$output = $retry;
	
	//$m = substr($output, strpos($output, '<ul class="thumbnails lazy" id="product_list" style="margin-left:0px;">'));
	$l = substr($output, strpos($output, '<li class="unitProduct item ndd_item"'));
	$l = substr($l, strpos($l, '<img'));
	$l = substr($l, strpos($l, 'src=')+4);

	$link = substr($l, 0, strpos($l, '>'));
	$img = "<img src=";
	$img .= $link;
	//var_dump($img);

	$l = substr($l, strpos($l, '<a class="prd_title"'));
	$l = substr($l, strpos($l, '>')+1);
	$name = substr($l, 0, strpos($l, '</a>'));
	$name = ltrim($name);
	$name = rtrim($name);
	//var_dump($name);

	$l = substr($l, strpos($l, 'Deal Price:')+16);
	$price = substr($l, 0, strpos($l, '</span>'));
	//var_dump($price);

	$out['name'] =  $name;
	$out['img'] =  $img;
	$out['price'] =  $price;

	$out['retry'] = $l;
	return $out;
}


function scrap2($query,$ref,$retry,$i){

	$query = str_replace(' ','+',$query);
	$url = 'http://www.infibeam.com/search?q=';
	$url .= $query;
	$url .= '%20&us=nbc';
	$url .= $ref;
	if ($retry == "") {
	$output = file_get_contents($url);
	}
	else
		$output = $retry; 
	
	//$m = substr($output, strpos($output, '<div class="col-md-3 col-sm-6 col-xs-12 search-icon " data-pos="' + $i));
		$m = substr($output, strpos($output, "<div class=\"product-content col-md-12 col-xs-8\">")+50);
	$p_out = $m;

	$init = strpos($m, '<a href=') + 8;
	$len = strpos($m, '</a>') - $init;
	$l = substr($m, $init, $len);

	$init = strpos($l, '>') + 1;
	$name = substr($l, $init, $len);

	$out['name'] =  $name;
	
	$price = substr($p_out, strpos($p_out, '<span class="c-inr">')+21);
	$price = substr($price, strpos($price, '</span>')+7);
	$price = substr($price, 0, strpos($price, '</span>'));

	$init = strpos($p_out, '<picture>');
	$len = strpos($p_out, '</picture>') - $init + 9;
	$img = substr($p_out, $init, $len);

	$out['img'] = $img;

	$out['price'] = $price;
	$out['retry'] = $m;
	return $out;
}
?>