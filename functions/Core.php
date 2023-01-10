<?php
	require_once 'API.php'; // Rest API (вспомогательные функции)

	require_once 'dataUserRegister.php'; // Функция регистрации
	require_once 'dataUserAuth.php'; // Функция авторизации
	require_once 'isUserAuth.php'; // Функция аунтентификации

	require_once 'getUserSales.php'; // Функция получения покупок покупателя
	require_once 'getDataSalesSalesman.php'; // Функция получения продаж продавца
	require_once 'getAllStaff.php'; // Функция получения всех сотрудников
	require_once 'getAllPrices.php'; // Функция получения всех услуг
	require_once 'getAllSales.php'; // Функция получения всех продаж
	require_once 'getAllCategory.php'; // Функция получения всех категорий услуг
	require_once 'getPricesForCategory.php'; // Функция получения всех услуг категории
	require_once 'getAllUsers.php'; // Функция получения всех пользователей

	require_once 'addSale.php'; // Функция добавления покупки
	require_once 'updateSale.php'; // Функция изменения информации о покупки
	require_once 'deleteSale.php'; // Функция удаления покупки

