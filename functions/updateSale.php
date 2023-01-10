<?php
	// Функция изменения покупки
	function updateSale($data) {
		GLOBAL $DB;

		$categoryID = $data['categoryID'];
		$priceID = $data['priceID'];
		$saleID = $data['id'];
		$desc = $data['desc'];

		$isSale = $DB->query("SELECT * FROM `sales` WHERE `id` = '$saleID'");

		if($isSale == []) {
			echo API::doErrors(404, 'Not Found', Array("sale" => "sale not found"));
			return false;				
		}

		$isPrice = $DB->query("SELECT * FROM `prices` WHERE `id` = '$priceID'");

		if($isPrice == []) {
			echo API::doErrors(404, 'Not Found', Array("price" => "price not found"));
			return false;				
		}	

		$price = $isPrice[0]['price'];	
		$salesmanID = $isSale[0]['id_salesman'];
		$customerID = $isSale[0]['id_customer'];

		$DB->execute("UPDATE `sales` SET `id_price` = '$priceID', `id_salesman` = '$salesmanID', `id_customer` = '$customerID', `text` = '$desc' WHERE `sales`.`id` = $saleID");

		$result = Array(
			"status" => "update",
			"sale" => Array(
				"id" => $saleID,
				"categoryID" => $categoryID,
				"priceID" => $priceID,
				"desc" => $desc,
				"price" => $price
			) 
		);
	
		echo API::doResult(201, "Data send", $result);
		return true;		
	} 	