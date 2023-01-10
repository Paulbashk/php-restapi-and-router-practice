<?php
	// Функция аунтентификации
	function isUserAuth() {
		GLOBAL $DB;

		$headers = getallheaders();
		$token = trim(explode('Bearer ', $headers['Authorization'])[1]);

		$salt = API::getSalt();		
		
		if(empty($headers['Authorization'])) {
			echo API::doErrors(422, 'Validation Errors', Array("Authorization" => "not value"));
			return false;			
		}

		/*$cookieToken = $_COOKIE['token'];

		if($cookieToken != $token) {
			echo API::doErrors(401, 'Unauthorized', Array("Token" => "invalid token"));
			return false;			
		}
		*/

		$isTokenUser = $DB->query("SELECT * FROM `users` WHERE `api_token` = '$token'");

		if($isTokenUser == []) {
			echo API::doErrors(401, 'Unauthorized', Array("Token" => "invalid token"));
			return false;				
		}

		$id = $isTokenUser[0]['id'];
		$fio = $isTokenUser[0]['fullname'];
		$group = $isTokenUser[0]['groupUser'];	
		$phone = $isTokenUser[0]['phone'];			
		$mail = $isTokenUser[0]['mail'];

		$token = API::setCookie($phone, $salt);

		$DB->execute("UPDATE `users` SET `api_token` = '$token' WHERE `users`.`phone` = '$phone'");

		$result = Array(
			"id" => $id,			
			"fullname" => $fio,
			"group" => $group,
			"phone" => $phone,
			"mail" => $mail,
			"token" => $token
		);

		if($group == 'Salesman' || $group == 'Admin') {
			$dataStuff = $DB->query("SELECT * FROM `staff` WHERE `id` = '$id'");

			$address = $dataStuff[0]['address'];
			$idPosition = $dataStuff[0]['id_position'];

			$dataPosition = $DB->query("SELECT * FROM `position` WHERE `id` = '$idPosition'");

			$namePosition = $dataPosition[0]['name'];
			$salaryPosition = $dataPosition[0]['salary'];

			$result += [
				"position" => $namePosition,
				"salary" => $salaryPosition
			];	
		}

		echo API::doResult(201, "Authorized", $result);
		return true;				
	}