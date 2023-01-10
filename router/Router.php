<?php

	class Router {
		// Список URL адресов
		public $urls = Array();

		// Функция регистрирует обработчик
		public function route($method, $url, $callback) {
			// Записываем в URLS (ассоциативный массив):
			// $url - id элемента
			// method - метод отправки данных
			// callback - функция
			if (!$this->urls[$method]) {$this->urls[$method] = Array();};
			$this->urls[$method][$url] = Array(
				"callback" => $callback
			);
		}

		// Функция обработки URL
		public function processUrl() {
			$url = explode("?", $_SERVER['REQUEST_URI'])[0]; // URL строка из адресной строки

			// Метод передачи данных
			$method = $_SERVER['REQUEST_METHOD'];

			// Если url имеет в конце слеш, то удаляем его
			if (mb_substr($url, -1, 1) == "/") { 
				$url = mb_substr($url,0, -1);
			}

			$urlAr = explode("/", $url); // Разбиваем URL на массив
			$find = false; // Переменная поиска коллбека 

			// Перебираем URL зарегистрированных коллбеков
			
			if ($this->urls[$method]) {
				foreach ($this->urls[$method] as $rk => $rout) {
					// $rk - URL коллбека, $rout - коллбек (Метод, функция)
					$vars = Array(); // Очищаем переменные, чтоб данные не пропали с прошлых обработок
					$ok = true; // Переменная проверки на поиск подходящего коллбека
					$rurl = explode('/', $rk); // Разбиваем URL коллбека

					// Если кол-во частей ссылки совпадает, то начинаем перебор
					if(count($rurl) == count($urlAr)) {
						// Перебираем URL коллбека по частям
						foreach($rurl as $sk => $sub) {
							// $sk - ключ части URL, $sub - текст части URL

							// Если часть коллбека не является переменной
							if(mb_substr($sub, 0, 1) !== "{") {

								// Если переменная не совпадает
								if($sub !== $urlAr[$sk]) {
									// Прекращаем перебор коллбека
									$ok = false;
									break;
								}
							} else { // Если часть является переменной
								// Если в URL нечем занменить переменную
								if(!isset($urlAr[$sk])) {
									// Прекращаем перебор коллбека
									$ok = false;
									break;			
								}

								// Если проблем никаких нет, объявляем переменную, записываем переменную
								$vars[mb_substr($sub, 1, -1)] = $urlAr[$sk];
							};
						};

						// Если всё нормально, проверяем метод, выполняем коллбек
						if($ok) {
							switch ($method) {
								case 'GET':
									$vars = array_merge($_GET,$vars);
								break;
								case 'POST':
									$vars = array_merge($_POST,$vars);			
								break;
							};

							$find = true; // Нашли подходящий коллбек
								// Метод совпал, выполняем коллбек
								$rout['callback']($vars);
							}	
						}
					}
				} else {
					echo "Не найден метод";
				};

			if ($find == false) {
				echo "Не найден подходящий обработчик";
			};				
		}
	}

	$Router = new Router;

	/*
	EXAMPLE

	$Router->route("GET", "test", function() {
		echo '123';
	}););

	$Router->route("DELETE", "test", function() {
		echo $_SERVER['REQUEST_METHOD'];
	});

	$Router->route("PATCH", "test", function() {
		echo $_SERVER['REQUEST_METHOD'];
	});

	$Router->route("GET","test/{code}/{code2}",function($vars) { // Функция
		print_r($vars);
	});

	print_r();
	$Router->processUrl();
	*/

