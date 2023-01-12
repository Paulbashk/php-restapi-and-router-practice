<?php

class Router {
  // Все зарегистрированные роутеры
  private $URLs = [];

  public function __construct() {
    $this->registerDefaultRoute();
  }
  public function __clone() {}
  public function __destruct() {
    $this->handlerURL();
  }

  // Парсит URL строку в массив
  private function parseURL($URLstr) {
    $URI = $URLstr;
    $URL = parse_url($URI);	// парсим URL

    $URLPath = $URL['path'];

    // Если значение строки это слеш то возвращаем его
    if($URLPath == '/' || $URLPath == '*') {
      $URLParse[0] = $URLPath;
      return $URLParse;
    } else { // Если это строка и в начале слеш, удаляем его
      if(mb_substr($URLPath, 0, 1) == '/') {
        $URLPath =  mb_substr($URLPath, 1, strlen($URLPath));
      }			

      // Переводим строку в массив
      $URLParse = explode('/', $URLPath);

      return $URLParse;
    }
  }	

  // Регистрация стандартных роутеров
  private function registerDefaultRoute() {
    $this->route('GET', '*', function() {
      $this->pageNotFoundDefault(); 
    });	

    $this->route('GET', '/', function() {
      $this->pageMainDefault(); 
    });						
  }		

  // Регистрирует роутеры
  public function route($methods = 'GET', $url = '/', $callback) {
    $this->URLs[] = Array ( 0 => $methods, 1 => $url, 2 => $callback );
  }	

  // Обработчик роутеров
  public function handlerURL() {
    $URI = $this->parseURL($_SERVER['REQUEST_URI']);
    $METHOD = mb_strtolower($_SERVER['REQUEST_METHOD']); // Приведение значения к нижнему регистру
    $statusHandler = false; // true - объект зачислен. false - объекта не найдено
    $notURI = Array();

    for($i = 0; $i < count($this->URLs); $i++) {

      $this->URLs[$i][1] = $this->parseURL($this->URLs[$i][1]);
      $this->URLs[$i][0] = mb_strtolower($this->URLs[$i][0]);				

      // Проверим, есть ли звездочка
      if($this->URLs[$i][1][0] == '*') {
        // Запишем объект звездочки для дальнейшей работы с ним
        $notURI = $this->URLs[$i];
      }				

      // Проверка на одинаковое кол-во категорий в URL строках и метод получения данных
      if(count($URI) == count($this->URLs[$i][1]) && $this->URLs[$i][0] == $METHOD) {
        $status = true;	// Состояние поиска. true - состояние поиска, элемент найден. false - элемент не найден, продолжаем искать

        // Перебираем два массива (их каталоги)								
        for($category = 0; $category < count($this->URLs[$i][1]); $category++) {

          // Проверка статуса: работа перебора
          if($status) {
            // Проверка на переменную в URL
            if(mb_substr($this->URLs[$i][1][$category], 0, 1) == '{'
            && 
            mb_substr($this->URLs[$i][1][$category], -1, 1) == '}') {
              // Запишем переменную и переименуем URL индентично URI
              $vars[mb_substr($this->URLs[$i][1][$category], 1, -1)] = $URI[$category];
              $this->URLs[$i][1][$category] = $URI[$category];
            }

            // Проверка категорий URL адресов на индентичность 
            if($this->URLs[$i][1][$category] == $URI[$category] ) {
              // Обработчик нашел ещё одно совпадение
              $status = true;
            } else {
              $status = false;
              $vars = null;
              break;
            }
          } 					
        }

        // проверка: поиск элемента
        if($status) {
          $statusHandler = true;
          // Проверим наличие переменной в URL строке
          if(isset($vars)) {
            $this->URLs[$i][2]($vars);
          } else {
            $this->URLs[$i][2]();
          }

          break;
        }								
      }				
    }

    // Проверим: найден url или нет из всех зарегистрированных маршрутов
    if(!$statusHandler) {
      // Проверим: есть ли звездочка как зарегистрированный маршрут
      if($notURI != []) {
        // Проверим: совпадают ли методы отправки запроса
        if($notURI[0] == $METHOD) {
          // Вызовем функцию
          return $notURI[2]();
        }
      }
    }
  }

  private function pageNotFoundDefault() {
    echo 'Errors: 404<br>This Page NotFound';
  }	

  private function pageMainDefault() {
    echo 'Main page';
  }	
}