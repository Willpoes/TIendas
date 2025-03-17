<?php 

$searched_textx="polo/relevantes";


$sql = "SELECT  products.*,
	(select gallery from users where user_id=products.user_id) as gallery,
	(select store from users where user_id=products.user_id)  as store,
	(select title from categories where id=products.category)  as categoryname 

	FROM products   ";

//$porciones = explode("/", $searched_textx);
	  $searched_textx=trim($searched_textx);

$porciones = explode("/", $searched_textx);

$searched=$porciones[0];
$searched_text=$porciones[1];
$var_text1=$porciones[2];
$var_text2=$porciones[3];


	if ($searched_text=="relevantes"){
	
	$sql.= "  WHERE (`title` LIKE '%". trim($searched) ."%')  order by relevant desc ";
	
	}elseif ($searched_text=="menoramayor"){
	
	$sql.= "  WHERE (`title` LIKE '%". trim($searched) ."%')  order by price asc ";
	
	}else if ($searched_text=="mayoramenor"){
	
	$sql.= "  WHERE (`title` LIKE '%". trim($searched) ."%')  order by price desc ";

	}else if ($searched_text=="tallas"){

	$sql.= " WHERE (`title` LIKE '%". trim($searched) ."%') and  products.id in(SELECT product_id FROM `product_inventory` WHERE `size_id`=(SELECT size_id FROM `product_sizes` WHERE `size_name` = '".$var_text1."') group by product_id)";

	}else if ($searched_text=="rangoprecio"){
	
	$sql.= "  WHERE (`title` LIKE '%". trim($searched) ."%') and  price BETWEEN ".$var_text1." AND ".$var_text2."  order by price asc ";

	}else{
	
	$sql.= " WHERE (`title` LIKE '%". trim($searched) ."%') ";
	
	}


	$sql.= "  limit 10 ";
echo $sql;
	?>