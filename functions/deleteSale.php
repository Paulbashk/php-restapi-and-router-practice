<?php
	// Функция удаления покупки
	function deleteSale($data) {
		GLOBAL $DB;

		$saleID = $data['id'];
		
		$isSale = $DB->query("SELECT * FROM `sales` WHERE `id` = '$saleID'");

		if($isSale == []) {
			echo API::doErrors(404, 'Not Found', Array("sale" => "sale not found"));
			return false;				
		}

		$DB->execute("DELETE FROM `sales` WHERE `sales`.`id` = $saleID");

		$result = Array(
			"status" => "delete",
			"sale" => Array(
				"id" => $saleID,
			) 
		);
	
		echo API::doResult(201, "Data send", $result);
		return true;			
	}	