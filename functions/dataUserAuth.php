<?php
	// Функция авторизации
	function dataUserAuth($data) {		
		GLOBAL $DB;

		$salt = API::getSalt();

		$mail = API::validateStr($data['email']);
		$pass = API::validateStr($data['password']);

		$errors = Array();

		$keys = ['email' => 'email', 'password' => 'password'];

		forEach($keys as $key => $value) {
			if(empty($data[$key])) {
				$errors[$key] = 'not value';
			}
		}

		if($errors != []) {
			echo API::doErrors(422, 'Validation Errors', $errors);
			return false;
		}		

		if(!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
			echo API::doErrors(422, 'Validation Errors', Array("email" => "wrong mail"));
			return false;			
		} 

		$isUser = $DB->query("SELECT * FROM `users` WHERE `mail` = '$mail'");

		if($isUser == []) {
			echo API::doErrors(401, 'Unauthorized', Array("email" => "mail or password incorrect"));
			return false;			
		}

		$pass = API::generatePassword($pass, $salt);

		if($isUser[0]['password'] != $pass) {
			echo API::doErrors(401, 'Unauthorized', Array("password" => "mail or password incorrect"));
			return false;			
		}

		$id = $isUser[0]['id'];
		$fio = $isUser[0]['fullname'];
		$group = $isUser[0]['groupUser'];	
		$phone = $isUser[0]['phone'];		
		$mail = $isUser[0]['mail'];

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