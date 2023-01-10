<?php
	// Функция получения всех покупок пользователя
	function getUserSales($data) {
		GLOBAL $DB;

		$idCustomer = $data['id'];

		// Все покупки
		$userSales = $DB->query("SELECT * FROM `sales` WHERE `id_customer` = '$idCustomer'");

		if($userSales == []) {
			echo API::doErrors(404, 'Not Found', Array("sales" => "sales not found"));
			return false;				
		}

		$dataPrice = [];
		foreach ($userSales as $key => $sale) {
			$id = $sale['id'];
			$idPrice = $sale['id_price'];
			$idSalesman = $sale['id_salesman'];

			$descSale = $sale['text'];
			$dateSale = $sale['date_sale'];
			$priceSale = $sale['price'];

			$price = $DB->query("SELECT * FROM `prices` WHERE `id` = '$idPrice'");
			$salesman = $DB->query("SELECT * FROM `staff` WHERE `id` = '$idSalesman'");

			$namePrice = $price[0]['name'];
			$fullnameSalesman = $salesman[0]['fullname'];

			$dateSale = explode('-', $dateSale);
			$dateSale = $dateSale[2].'.'.$dateSale[1].'.'.$dateSale[0];

			$dataPrice[$key] = Array(
				"id" => $id,
				"name" => $namePrice,
				"desc" => $descSale,
				"salesman" => $fullnameSalesman,
				"price" => $priceSale.'.00 RUB',
				"date" => $dateSale
			);
		}

		$result = Array(
			"id_customer" => $idCustomer,
			"sales" => $dataPrice
		);

		echo API::doResult(200, "Data send", $result);
		return true;		
	}