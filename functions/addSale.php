<?php
	// Функция добавления покупки
	function addSale($data) {
		GLOBAL $DB;

		$categoryID = $data['categoryID'];
		$priceID = $data['priceID'];
		$salesmanID = $data['salesmanID'];
		$customerID = $data['userID'];

		$desc = $data['desc'];

		$prices = $DB->query("SELECT * FROM `prices` WHERE `id` = '$priceID'");
		$price = $prices[0]['price'];

		$pricesName = $prices[0]['name'];
		$pricesTermDate = $prices[0]['term_date'];
		$pricesCosts = $prices[0]['costs'];
		$pricesProfit = $prices[0]['profit'];

		$dataUser = $DB->query("SELECT * FROM `users` WHERE `id` = '$customerID'");

		$fullnameCustomer = $dataUser[0]['fullname'];
		$phoneCustomer = $dataUser[0]['phone'];
		$mailCustomer = $dataUser[0]['mail'];

		$salesman = $DB->query("SELECT * FROM `staff` WHERE `id` = '$salesmanID'");

		if($salesman == []) {
			echo API::doErrors(404, 'Not Found', Array("salesman" => "salesman not found"));
			return false;				
		}	

		$salesmanUser = $DB->query("SELECT * FROM `users` WHERE `id` = '$salesmanID'");

		$fullnameSalesman = $salesmanUser[0]['fullname'];
		$phoneSalesman = $salesmanUser[0]['phone'];
		$mailSalesman = $salesmanUser[0]['mail'];

		$addressSalesman = $salesman[0]['address'];	
		$positionSalesmanID = $salesman[0]['id_position'];

		$salesmanPositions = $DB->query("SELECT * FROM `position` WHERE `id` = '$positionSalesmanID'");	
		$namePosition = $salesmanPositions[0]['name'];
		$salaryPosition = $salesmanPositions[0]['salary'];

		$present = (($pricesProfit / 100) * 50) + 350;

		$isCustomer = $DB->query("SELECT * FROM `customers` WHERE `id` = '$customerID'");
		if($isCustomer == []) {
			$DB->execute("INSERT INTO `customers` (`id`, `fullname`, `phone`, `mail`) VALUES ('$customerID', '$fullnameCustomer', '$phoneCustomer', '$mailCustomer')");
		}

		$DB->execute("INSERT INTO `sales` (`id`, `id_price`, `id_salesman`, `id_customer`, `text`, `date_sale`, `price`) VALUES (NULL, '$priceID', '$salesmanID', '$customerID', '$desc', CURRENT_DATE, '$price')");


		$category = $DB->query("SELECT * FROM `category` WHERE `id` = '$categoryID'");
		$nameCategory = $category[0]['category'];

		$currentSale = $DB->query("SELECT * FROM `sales` WHERE id=(SELECT max(id) FROM `sales`) AND `id_salesman` = '$salesmanID'");
		if($currentSale == []) {
			echo API::doErrors(404, 'Not Found', Array("current sale" => "sale not found"));
			return false;				
		}		

		$currentSaleID = $currentSale[0]['id'];
		$currentSaleDate = $currentSale[0]['date_sale'];

		$result = Array(
			"sale" => Array(
				"id" => $currentSaleID,
				"date" => $currentSaleDate,				
				"category" => Array(
					"id" => $categoryID,
					"name" => $nameCategory,
				),
				"price" => Array(
					"id" => $priceID,
					"name" => $pricesName,
					"term_date" => $pricesTermDate,
					"price" => $price.'.00 RUB',
					"costs" => $pricesCosts.'.00 RUB',
					"profit" => $pricesProfit.'.00 RUB'
				),
				"customer" => Array(
					"id" => $customerID,
					"fullname" => $fullnameCustomer,
					"phone" => $phoneCustomer,
					"mail" => $mailCustomer
				),
				"salesman" => Array(
					"id" => $salesmanID,
					"fullname" => $fullnameSalesman,
					"phone" => $phoneSalesman,
					"mail" => $mailSalesman,
					"address" => $addressSalesman,
					"salary_sale" => $present.'.00 RUB',
					"position" => Array(
						"id" => $positionSalesmanID,
						"name" => $namePosition,
						"salary" => $salaryPosition.'.00 RUB'
					)		
				)
			)
		);

		echo API::doResult(201, "Data send", $result);
		return true;	
	}	