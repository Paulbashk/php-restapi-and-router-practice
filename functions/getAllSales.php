<?php
	// Функция получения всех продаж
	function getAllSales() {
		GLOBAL $DB;

		// Все покупки
		$allSales = $DB->query("SELECT * FROM `sales`");

		if($allSales == []) {
			echo API::doErrors(404, 'Not Found', Array("sales" => "sales not found"));
			return false;				
		}

		$dataPrice = [];
		foreach ($allSales as $key => $sale) {
			$id = $sale['id'];
			$idPrice = $sale['id_price'];
			$idCustomer = $sale['id_customer'];

			$descSale = $sale['text'];
			$dateSale = $sale['date_sale'];
			$priceSale = $sale['price'];

			$price = $DB->query("SELECT * FROM `prices` WHERE `id` = '$idPrice'");
			$customer = $DB->query("SELECT * FROM `customers` WHERE `id` = '$idCustomer'");

			$idCategory = $price[0]['id_category'];

			$category = $DB->query("SELECT * FROM `category` WHERE `id` = '$idCategory'");

			$categoryName = $category[0]['category'];

			$namePrice = $price[0]['name'];
			$fullnameCustomer = $customer[0]['fullname'];
			$phoneCustomer = $customer[0]['phone'];
			$mailCustomer = $customer[0]['mail'];

			$dateSale = explode('-', $dateSale);
			$dateSale = $dateSale[2].'.'.$dateSale[1].'.'.$dateSale[0];

			$dataPrice[$key] = Array(
				"id" => $id,
				"category" => $categoryName,
				"name" => $namePrice,
				"desc" => $descSale,
				"price" => $priceSale.'.00 RUB',				
				"date" => $dateSale,				
				"customer" => Array(
					"fullname" => $fullnameCustomer,
					"phone" => $phoneCustomer,
					"mail" => $mailCustomer
				)
			);
		}

		$result = Array(
			"sales" => $dataPrice
		);

		echo API::doResult(200, "Data send", $result);
		return true;				
	}	