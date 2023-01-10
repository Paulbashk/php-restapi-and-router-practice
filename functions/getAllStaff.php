<?php
	// Функция получения всех сотрудников
	function getAllStaff() {
		GLOBAL $DB;		

		$allStaff = $DB->query("SELECT * FROM `staff`");

		if($allStaff == []) {
			echo API::doErrors(404, 'Not Found', Array("staff" => "staff not found"));
			return false;				
		}

		$dataStaff = [];
		foreach ($allStaff as $key => $com) {
			$idPosition = $com['id_position'];

			$position = $DB->query("SELECT * FROM `position` WHERE `id` = '$idPosition'");

			$positionName = $position[0]['name'];

			$dataStaff[$key] = Array(
				"fullname" => $com['fullname'],
				"position" => $positionName,
				"phone" => $com['phone'],
				"address" => $com['address']
			);
		}

		$result = Array(
			"staff" => $dataStaff
		);

		echo API::doResult(200, "Data send", $result);
		return true;			
	}