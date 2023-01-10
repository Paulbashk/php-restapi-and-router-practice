<?php
	$url = $_SERVER['REQUEST_URI'];
	$method = $_SERVER['REQUEST_METHOD'];

	$urlArray = explode('?', $url);
	$urlParam = $urlArray[1];

	$uri = $urlArray[0];

	// Маршрутизация
	switch ($uri) {
		case '/': {
			switch($method) {
				case 'POST': {
					break;
				}
				case 'GET': {
					require './view/build/index.php';				
					break;
				}				
			}
			break;
		}
		case '/register': {
			switch($method) {
				case 'POST': {
					break;
				}
				case 'GET': {
					require './view/build/index.php';			
					break;
				}				
			}
			break;
		}	
		case '/auth': {
			switch($method) {
				case 'POST': {
					break;
				}
				case 'GET': {
					require './view/build/index.php';					
					break;
				}				
			}
			break;
		}	
		case '/cabinet': {
			switch($method) {
				case 'POST': {
					break;
				}
				case 'GET': {
					require './view/build/index.php';					
					break;
				}				
			}
			break;
		}
		case '/cabinet/sale': {
			switch($method) {
				case 'POST': {
					break;
				}
				case 'GET': {
					require './view/build/index.php';					
					break;
				}				
			}
			break;
		}
		case '/cabinet/employee': {
			switch($method) {
				case 'POST': {
					break;
				}
				case 'GET': {
					require './view/build/index.php';					
					break;
				}				
			}
			break;
		}
		case '/cabinet/employee/add': {
			switch($method) {
				case 'POST': {
					break;
				}
				case 'GET': {
					require './view/build/index.php';					
					break;
				}				
			}
			break;
		}
		case '/cabinet/prices': {
			switch($method) {
				case 'POST': {
					break;
				}
				case 'GET': {
					require './view/build/index.php';					
					break;
				}				
			}
			break;
		}
		case '/cabinet/prices/add': {
			switch($method) {
				case 'POST': {
					break;
				}
				case 'GET': {
					require './view/build/index.php';					
					break;
				}				
			}
			break;
		}
		case '/api/register': {
			switch($method) {
				case 'POST': {
					dataUserRegister($_POST);
					break;
				}
				case 'GET': {				
					break;
				}				
			}
			break;
		}
		case '/api/auth': {
			switch($method) {
				case 'POST': {
					dataUserAuth($_POST);
					break;
				}
				case 'GET': {				
					break;
				}				
			}
			break;
		}
		case '/api/user': {
			switch($method) {
				case 'POST': {
					isUserAuth();
					break;
				}
				case 'GET': {				
					break;
				}				
			}
			break;
		}
		case '/api/user/sales': {
			switch($method) {
				case 'POST': {
					getUserSales($_POST);
					break;
				}
				case 'GET': {				
					break;
				}				
			}
			break;
		}
		case '/api/salesman/sales': {
			switch($method) {
				case 'POST': {
					getDataSalesSalesman($_POST);
					break;
				}
				case 'GET': {				
					break;
				}				
			}
			break;
		}
		case '/api/staff': {
			switch($method) {
				case 'POST': {
					getAllStaff();
					break;
				}
				case 'GET': {				
					break;
				}				
			}
			break;
		}
		case '/api/prices': {
			switch($method) {
				case 'POST': {
					getAllPrices();
					break;
				}
				case 'GET': {				
					break;
				}				
			}
			break;
		}
		case '/api/sales': {
			switch($method) {
				case 'POST': {
					getAllSales();
					break;
				}
				case 'GET': {				
					break;
				}				
			}
			break;
		}
		case '/api/category': {
			switch($method) {
				case 'POST': {
					getAllCategory();
					break;
				}
				case 'GET': {				
					break;
				}				
			}
			break;
		}
		case '/api/category/prices': {
			switch($method) {
				case 'POST': {
					getPricesForCategory($_POST);
					break;
				}
				case 'GET': {				
					break;
				}				
			}
			break;
		}	
		case '/api/users': {
			switch($method) {
				case 'POST': {
					getAllUsers();
					break;
				}
				case 'GET': {				
					break;
				}				
			}
			break;
		}
		case '/api/sale/add': {
			switch($method) {
				case 'POST': {
					addSale($_POST);
					break;
				}
				case 'GET': {				
					break;
				}				
			}
			break;
		}
		case '/api/sale/update': {
			switch($method) {
				case 'POST': {
					updateSale($_POST);
					break;
				}
				case 'GET': {				
					break;
				}				
			}
			break;
		}
		case '/api/sale/delete': {
			switch($method) {
				case 'POST': {
					deleteSale($_POST);
					break;
				}
				case 'GET': {				
					break;
				}				
			}
			break;
		}																						
	}