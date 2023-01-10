<?php
	// Функция получения всех категорий
	function getAllCategory() {
		GLOBAL $DB;

		$allCategory = $DB->query("SELECT * FROM `category`");

		if($allCategory == []) {
			echo API::doErrors(404, 'Not Found', Array("category" => "category not found"));
			return false;				
		}		

		$dataCategory = [];
		foreach ($allCategory as $key => $category) {
			$dataCategory[$key] = Array(
				"id" => $category['id'],
				"category" => $category['category']
			);
		}

		$result = Array(
			"category" => $dataCategory
		);

		echo API::doResult(200, "Data send", $result);
		return true;
	}	