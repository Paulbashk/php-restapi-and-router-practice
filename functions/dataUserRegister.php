<?php
	// Функция регистрации
	function dataUserRegister($data) {
		GLOBAL $DB;

		$salt = API::getSalt();

		$surname = API::validateStr($data['surname']);
		$name = API::validateStr($data['name']);
		$patronymic = API::validateStr($data['patronymic']);

		$phone = API::validateStr($data['phone']);

		$mail = API::validateStr($data['email']);
		$pass = API::validateStr($data['password']);
		$repass = API::validateStr($data['repassword']);

		$errors = Array();

		$keys = ['surname' => 'surname', 'name' => 'name', 'patronymic' => 'patronymic', 'phone' => 'phone', 'email' => 'email', 'password' => 'password', 'repassword' => 'repassword'];

		forEach($keys as $key => $value) {
			if(empty($data[$key])) {
				$errors[$key] = 'not value';
			}
		}	

		$isPhone = $DB->query("SELECT * FROM `users` WHERE `phone` = '$phone'");
		$isEmail = $DB->query("SELECT * FROM `users` WHERE `mail` = '$mail'");

		if($isPhone != []) {
			$errors['phone'] = 'phone is already';
		}

		if($isEmail != []) {
			$errors['email'] = 'mail is already';
		}				

		if($errors != []) {
			echo API::doErrors(422, 'Validation Errors', $errors);
			return false;
		}

		if(!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
			echo API::doErrors(422, 'Validation Errors', Array("email" => "wrong mail"));
			return false;			
		} 		

		if($pass != $repass) {
			echo API::doErrors(422, 'Validation Errors', Array("repassword" => "wrong password"));
			return false;			
		}

		$pass = API::generatePassword($pass, $salt);
		$groupUser = 'Customer';

		$fio = $surname.' '.$name.' '.$patronymic;

		$token = API::setCookie($phone, $salt);

		$DB->execute("INSERT INTO `users` (`id`, `fullname`, `groupUser`, `phone`, `mail`, `address`, `password`, `api_token`) VALUES (NULL, '$fio', '$groupUser', '$phone', '$mail', NULL, '$pass', '$token')");

		$user = $DB->query("SELECT * FROM `users` WHERE `phone` = '$phone'");
		$id = $user[0]['id'];

		$DB->execute("INSERT INTO `customers` (`id`, `fullname`, `phone`, `mail`) VALUES ('$id', '$fio', '$phone', '$mail')");

		$result = Array(
			"id" => $id,
			"fullname" => $fio,
			"name" => $name,
			"phone" => $phone,
			"mail" => $mail,
			"group" => $groupUser,
			"token" => $token
		);

		echo API::doResult(201, "Create new user", $result);
		return true;
	}