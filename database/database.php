<?php 
	GLOBAL $DB;
	// Класс - функционал подключения к БД и работы с данными
	class Database {
		private $link;

		public function __construct() {
			$this->connect();
		}

		private function connect() {
			$config = require_once 'config.php';

			$dsn = 'mysql:host='.$config['host'].';dbname='.$config['db_name'].';charset='.$config['charset'];

			$this->link = new PDO($dsn, $config['username'], $config['password']);
		}

		public function execute($sql) {
			$nth = $this->link->prepare($sql);

			return $nth->execute();
		}

		public function query($sql) {
			$nth = $this->link->prepare($sql);
			$nth->execute();

			$result = $nth->fetchAll(PDO::FETCH_ASSOC);

			if($result === false) {
				$result = [];
			}

			return $result;
		}
	}

	$DB = new Database();