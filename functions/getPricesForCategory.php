<?php
	// Функция получения всех услуг по категории
	function getPricesForCategory($data) {
		GLOBAL $DB;

		$categoryID = $data['id'];	

		$category = $DB->query("SELECT * FROM `category` WHERE `id` = '$categoryID'");

		if($category == []) {
			echo API::doErrors(404, 'Not Found', Array("category" => "category not found"));
			return false;				
		}	

		$categoryName = $category[0]['category'];

		// Поиск всех услуг по категориям
		$prices = $DB->query("SELECT * FROM `prices` WHERE `id_category` = '$categoryID'");	

		if($prices == []) {
			echo API::doErrors(404, 'Not Found', Array("prices" => "prices not found"));
			return false;				
		}	

		$dataPrices = [];
		foreach ($prices as $key => $price) {
			$dataPrices[$key] = Array(
				"id" => $price['id'],
				"name" => $price['name'],
				"price" => $price['price'].'.00 RUB'
			);
		}	

		$result = Array(
			"id_category" => $categoryID,
			"category" => $categoryName,
			"prices" => $dataPrices
		);

		echo API::doResult(200, "Data send", $result);
		return true;		
	}	