<?php
	// Функция получения последних продаж покупателя за последний месяц
	function getDataSalesSalesman($data) {
		GLOBAL $DB;

		$idSalesman = $data['id'];

		// Все продажи за последний месяц
		$userSales = $DB->query("SELECT * FROM `sales` WHERE `id_salesman` = '$idSalesman' AND DATE(date_sale) >= DATE(NOW()) - INTERVAL 30 DAY");

		if($userSales == []) {
			echo API::doErrors(404, 'Not Found', Array("sales" => "sales not found"));
			return false;				
		}

		$dataPrice = [];
		$customersNumPrices = 0;
		foreach ($userSales as $key => $sale) {
			$id = $sale['id'];
			$idPrice = $sale['id_price'];
			$idCustomer = $sale['id_customer'];

			$descSale = $sale['text'];
			$dateSale = $sale['date_sale'];
			$priceSale = $sale['price'];

			$price = $DB->query("SELECT * FROM `prices` WHERE `id` = '$idPrice'");
			$customer = $DB->query("SELECT * FROM `customers` WHERE `id` = '$idCustomer'");

			$profitSale = $price[0]['profit'];

			$customersNumPrices += $priceSale;
			$present += (($profitSale / 100) * 50) + 350;

			$namePrice = $price[0]['name'];

			$categoryID = $price[0]['id_category'];
			$category = $DB->query("SELECT * FROM `category` WHERE `id` = '$categoryID'");
			$categoryName = $category[0]['category'];

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
					"id" => $idCustomer,
					"fullname" => $fullnameCustomer,
					"phone" => $phoneCustomer,
					"mail" => $mailCustomer
				)
			);
		}

		$result = Array(
			"id_salesman" => $idSalesman,
			"sales" => $dataPrice,
			"payment" => Array(
				"sold" => $customersNumPrices.'.00 RUB',
				"salary" => $present.'.00 RUB'
			)
		);

		echo API::doResult(200, "Data send", $result);
		return true;		
	}		