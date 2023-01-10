<?php
	class API {
		public function __construct() {}
		public function __clone() {}

		public static function doErrors($status, $message, $errors) {
			header('Content-Type: application/json');
			http_response_code($status);

			$body = Array(
				"code" => $status,
				"message" => $message,
				"errors" => $errors
			);

			return json_encode($body);
		}
		public static function getSalt() {
			$str = 'bGLk5g0LFKj';
			return $str;
		}
		public static function generatePassword($password, $secret) {
			return md5(md5($password.$secret));
		}
		public static function doResult($status, $message, $result) {
			header('Content-Type: application/json');		
			http_response_code($status);

			$body = Array(
				"code" => $status,
				"message" => $message,
				"data" => $result
			);

			return json_encode($body);			
		}

		public static function validateStr($str) {
			$exp = filter_var(trim($str), FILTER_SANITIZE_STRING);
			return $exp;
		}

		public static function setCookie($phone, $salt) {
			$token = md5($salt.time().$phone);

			setcookie('phone', $phone, time() + 60*60*24*30, "/");
			setcookie('token', $token, time() + 60*60*24*30, "/");

			return $token;
		}
	}