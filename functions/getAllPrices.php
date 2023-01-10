<?php
	// Функция получения всех услуг
	function getAllPrices() {
		GLOBAL $DB;		

		$allPrices = $DB->query("SELECT * FROM `prices`");

		if($allPrices == []) {
			echo API::doErrors(404, 'Not Found', Array("prices" => "prices not found"));
			return false;				
		}

		$dataPrices = [];
		foreach ($allPrices as $key => $price) {
			$idCategory = $price['id_category'];

			$category = $DB->query("SELECT * FROM `category` WHERE `id` = '$idCategory'");

			$categoryName = $category[0]['category'];

			$dataPrices[$key] = Array(
				"category" => $categoryName,
				"name" => $price['name'],
				"term" => $price['term_date'],
				"price" => $price['price'].'.00 RUB',
				"costs" => $price['costs'].'.00 RUB',
				"profit" => $price['profit'].'.00 RUB'
			);
		}

		$result = Array(
			"prices" => $dataPrices
		);

		echo API::doResult(200, "Data send", $result);
		return true;			
	}