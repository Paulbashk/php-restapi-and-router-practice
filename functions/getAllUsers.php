<?php
	// Функция получает всех пользователей
	function getAllUsers() {
		GLOBAL $DB;

		$allUsers = $DB->query("SELECT * FROM `users`");

		if($allUsers == []) {
			echo API::doErrors(404, 'Not Found', Array("users" => "users not found"));
			return false;				
		}	

		$userData = [];
		foreach ($allUsers as $key => $user) {
			$userData[$key] = Array(
				"id" => $user['id'],
				"fullname" => $user['fullname'],
				"group" => $user['groupUser']
			);
		}

		$result = Array(
			"users" => $userData
		);

		echo API::doResult(200, "Data send", $result);
		return true;		
	}	