-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 23 2021 г., 15:17
-- Версия сервера: 8.0.19
-- Версия PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `course`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `category` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `category`) VALUES
(1, 'Починка телефона'),
(2, 'Починка компьютера'),
(3, 'Ремонт переферийной техники'),
(4, 'Ремонт МФУ'),
(5, 'Настройка техники');

-- --------------------------------------------------------

--
-- Структура таблицы `customers`
--

CREATE TABLE `customers` (
  `id` int NOT NULL,
  `fullname` text NOT NULL,
  `phone` text NOT NULL,
  `mail` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `customers`
--

INSERT INTO `customers` (`id`, `fullname`, `phone`, `mail`) VALUES
(1, 'Гнатко Илья Викторович', '79214223212', 'yghfggfl@gmail.com'),
(2, 'Витько Павел Павлович', '79412432244', 'vitko2132@mail.ru'),
(3, 'Черняков Андрей Валерьевич', '79214052344', 'chernyakov1983@gmail.com'),
(4, 'Шестакова Мария Николаевна', '79554215942', 'maryashk1999@gmail.com'),
(5, 'Митурин Алексей Сергеевич', '79245954921', 'mutyrin1979@yandex.com'),
(6, 'Ивлева Дарья Даниловна', '79112414949', 'iivvvleva@mail.ru'),
(7, 'Кузин Егор Алексеевич', '79992192929', 'kyzminratoo19@yahoo.ru'),
(8, 'Белянин Максим Артурович', '78912472728', 'belian1919@mail.ru'),
(16, 'Бабушкин Андрей Андреевич', '79542703441', 'paulbash@mail.ru'),
(19, 'Вишняков Андрей Валерий', '+79241244242', 'paulasfhs@mail.ru'),
(20, 'Данил Даниил Данилов', '+79452411223', 'paulash@mail.ru');

-- --------------------------------------------------------

--
-- Структура таблицы `position`
--

CREATE TABLE `position` (
  `id` int NOT NULL,
  `name` text NOT NULL,
  `salary` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `position`
--

INSERT INTO `position` (`id`, `name`, `salary`) VALUES
(1, 'Директор', 50000),
(2, 'Администратор', 35000),
(3, 'Инженер', 25000),
(4, 'Продавец', 25000);

-- --------------------------------------------------------

--
-- Структура таблицы `prices`
--

CREATE TABLE `prices` (
  `id` int NOT NULL,
  `id_category` int NOT NULL,
  `name` text NOT NULL,
  `term_date` text NOT NULL,
  `price` int NOT NULL,
  `costs` int NOT NULL,
  `profit` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `prices`
--

INSERT INTO `prices` (`id`, `id_category`, `name`, `term_date`, `price`, `costs`, `profit`) VALUES
(1, 1, 'Замена экрана iPhone 7s', '3 дня', 3000, 2000, 1000),
(2, 1, 'Замена экрана iPhone 8s', '3 дня', 7000, 5000, 2000),
(3, 1, 'Замена экрана iPhone XR', '5 дней', 10000, 7000, 3000),
(4, 1, 'Замена экрана iPhone 12', '5 дней', 20000, 15000, 5000),
(5, 1, 'Починка touch iPhone', '2 дня', 3000, 1000, 2000),
(6, 1, 'Сброс iPhone', '3 дня', 10000, 3000, 7000),
(7, 1, 'Замена аккумулятора', '3 дня', 3000, 1000, 2000),
(8, 1, 'Ремонт внутренностей', '3 дня', 3000, 1000, 2000),
(9, 2, 'Диагностика', '3 дня', 3000, 1000, 2000),
(10, 2, 'Замена комплектующих', '3 дня', 3000, 1000, 2000),
(11, 2, 'Прогрев видеокарты', '3 дня', 3000, 1000, 2000),
(12, 2, 'Починка комплектующих', '3 дня', 5000, 2000, 3000),
(13, 3, 'Починка мышки', '3 дня', 2000, 1000, 1000),
(14, 3, 'Починка клавиатуры', '3 дня', 2000, 1000, 1000),
(15, 3, 'Починка наушников', '3 дня', 2000, 1000, 1000),
(16, 3, 'Починка микрофона', '3 дня', 2000, 1000, 1000),
(17, 4, 'Диагностика', '3 дня', 2000, 1000, 1000),
(18, 4, 'Починка МФУ', '3 дня', 5000, 3000, 2000),
(19, 4, 'Починка Сканера', '3 дня', 2000, 1000, 1000),
(20, 4, 'Починка Принтера', '3 дня', 2000, 1000, 1000),
(21, 5, 'Установка Windows', '3 дня', 2000, 1000, 1000),
(22, 5, 'Установка ПО', '3 дня', 1000, 500, 500),
(23, 5, 'Настройка ПО', '3 дня', 1000, 500, 500),
(24, 5, 'Настройка Android', '3 дня', 1000, 500, 500),
(25, 5, 'Персональная настройка', '3 дня', 1000, 500, 500);

-- --------------------------------------------------------

--
-- Структура таблицы `sales`
--

CREATE TABLE `sales` (
  `id` int NOT NULL,
  `id_price` int NOT NULL,
  `id_salesman` int NOT NULL,
  `id_customer` int NOT NULL,
  `text` text NOT NULL,
  `date_sale` date NOT NULL,
  `price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `sales`
--

INSERT INTO `sales` (`id`, `id_price`, `id_salesman`, `id_customer`, `text`, `date_sale`, `price`) VALUES
(10, 10, 10, 1, 'Была произведена замена чипсета видеокарты', '2021-12-15', 3000),
(11, 5, 11, 4, 'Сломалась кнопка touchId на iphone 7s, был произведен ремонт', '2021-12-02', 3000),
(12, 10, 10, 5, 'Видеокарта не выдавала изображение. Был выполнен прогрев чипсета', '2021-12-04', 3000),
(14, 21, 10, 8, 'Была произведена переустановка Windows 10 на ноутбук', '2021-12-14', 2000),
(15, 18, 11, 3, 'Была произведена починка барабана в МФУ', '2021-12-18', 5000),
(16, 7, 11, 2, 'Была произведена замена аккумулятора на Honor 30', '2021-12-19', 3000),
(17, 3, 11, 6, 'Сломался экран iphone XR, была произведена замена на новый', '2021-12-12', 10000),
(18, 23, 10, 1, 'Была произведена установка и настройка программы Micromine', '2021-12-02', 2000),
(37, 1, 10, 6, 'Была произведена замена экрана на новый', '2021-12-23', 7000);

-- --------------------------------------------------------

--
-- Структура таблицы `staff`
--

CREATE TABLE `staff` (
  `id` int NOT NULL,
  `id_position` int NOT NULL,
  `fullname` text NOT NULL,
  `address` text NOT NULL,
  `phone` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `staff`
--

INSERT INTO `staff` (`id`, `id_position`, `fullname`, `address`, `phone`) VALUES
(9, 4, 'Мальцев Евгений Викторович', 'г. Кемерово, пр-кт. Ленина, 115, кв. 14', '78922414242'),
(10, 3, 'Ротанова Евгения Михайловна', 'г. Кемерово, пр-кт. Московский 20, кв. 192', '70920752010'),
(11, 3, 'Шиповалов Данил Данилов', 'г. Кемерово, пр-кт. Московский, 17, кв. 282', '72221233232'),
(12, 1, 'Марков Егор Данилов', 'г. Кемерово, пр-кт. Московский, 10, кв. 280', '71992412423');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `fullname` text NOT NULL,
  `groupUser` text NOT NULL,
  `phone` text NOT NULL,
  `mail` text NOT NULL,
  `address` text,
  `password` text NOT NULL,
  `api_token` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `fullname`, `groupUser`, `phone`, `mail`, `address`, `password`, `api_token`) VALUES
(1, 'Гнатко Илья Викторович', 'Salesman', '79214223212', 'yghfggfl@gmail.com', NULL, '0abc64d9cdafa0ab12052d62375c5d8b', '3ab2ac481721c7d439b7940f0f96d6f2'),
(2, 'Витько Павел Павлович', 'Customer', '79412432244', 'vitko2132@mail.ru', NULL, '13ac9d3727211cec6a0bf60d57d6d105', NULL),
(3, 'Черняков Андрей Валерьевич', 'Customer', '79214052344', 'chernyakov1983@gmail.com', NULL, '5387d3c612d18582b55a72da9ca8865b', NULL),
(4, 'Шестакова Мария Николаевна', 'Customer', '79554215942', 'maryashk1999@gmail.com', NULL, '39cbab415b2a152f290f5212df126b90', NULL),
(5, 'Митурин Алексей Сергеевич', 'Customer', '79245954921', 'mutyrin1979@yandex.com', NULL, 'edc7d91c01b5ed58fca95041073afe14', NULL),
(6, 'Ивлева Дарья Даниловна', 'Customer', '79112414949', 'iivvvleva@mail.ru', NULL, 'f80304dc6cf1c3faf39e810a66cc7684', NULL),
(7, 'Кузин Егор Алексеевич', 'Customer', '79992192929', 'kyzminratoo19@yahoo.ru', NULL, '5a49e76190827a1dcca21e8559d9b19e', NULL),
(8, 'Белянин Максим Артурович', 'Customer', '78912472728', 'belian1919@mail.ru', NULL, '34f258685d5a278da34f0b07c7e5309b', NULL),
(9, 'Мальцев Евгений Викторович', 'Salesman', '78922414242', 'malcevgrvo28@gmail.com', 'г. Кемерово, пр-кт. Ленина, 115, кв. 14', '34f258685d5a278da34f0b07c7e5309b', NULL),
(10, 'Ротанова Евгения Михайловна', 'Admin', '70920752010', 'rotanova1918@yandex.ru', 'г. Кемерово, пр-кт. Московский 20, кв. 192', 'fbdcbe927200ff95e1dcb5b6a09ecbba', 'd6f2519d3a55ad12efe1b9dc9755b539'),
(11, 'Шиповалов Данил Данилов', 'Admin', '72221233232', 'shupka1922@mail.ru', 'г. Кемерово, пр-кт. Московский, 17, кв. 282', '0ce9d13b9c72f061eb7d22dc6013705c', NULL),
(12, 'Марков Егор Данилов', 'Admin', '71992412423', 'kissmyyy@mail.ru', 'г. Кемерово, пр-кт. Московский, 10, кв. 280', 'c8e5ff432bad38a323f9d27ebb88fa24', NULL),
(16, 'Бабушкин Павел Андреевич', 'Customer', '79502703301', 'paulbash@mail.ru', NULL, '9a7de12df4153c14096de70bcdac903b', '3a7cff0e7fff44fc67e002ff3cd6d1ac'),
(19, 'Вишняков Андрей Валерий', 'Customer', '+79241244242', 'paulasfhs@mail.ru', NULL, 'ed5ea1151b0a2203259cdccca96c0031', 'f1033ede23693c3cba123f2a423ad58e'),
(20, 'Данил Даниил Данилов', 'Customer', '+79452411223', 'paulash@mail.ru', NULL, 'ed5ea1151b0a2203259cdccca96c0031', 'c1f06636fe18ca5e4ed6784965235a3a');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_category` (`id_category`);

--
-- Индексы таблицы `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_price` (`id_price`),
  ADD KEY `id_salesman` (`id_salesman`),
  ADD KEY `id_customer` (`id_customer`);

--
-- Индексы таблицы `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_position` (`id_position`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT для таблицы `position`
--
ALTER TABLE `position`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `prices`
--
ALTER TABLE `prices`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT для таблицы `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT для таблицы `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `prices`
--
ALTER TABLE `prices`
  ADD CONSTRAINT `prices_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`id_customer`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`id_salesman`) REFERENCES `staff` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sales_ibfk_3` FOREIGN KEY (`id_price`) REFERENCES `prices` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`id_position`) REFERENCES `position` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `staff_ibfk_2` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
