-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 23 2025 г., 07:23
-- Версия сервера: 8.0.24
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `tatu`
--

-- --------------------------------------------------------

--
-- Структура таблицы `address`
--

CREATE TABLE `address` (
  `id` int NOT NULL,
  `address` varchar(255) NOT NULL,
  `address_type_id` int NOT NULL,
  `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `address`
--

INSERT INTO `address` (`id`, `address`, `address_type_id`, `user_id`) VALUES
(1, 'Конева 77/2 ', 1, NULL),
(2, 'Дмитриева 12/4', 1, NULL),
(3, 'Красный путь 62/2', 1, NULL),
(4, 'Енисейкая 23/2', 1, NULL),
(5, 'Бульвар архитекторов 45/4', 1, NULL),
(6, 'Карла Маркса 23', 2, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `address_types`
--

CREATE TABLE `address_types` (
  `id` int NOT NULL,
  `address_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `address_types`
--

INSERT INTO `address_types` (`id`, `address_type`) VALUES
(1, 'Пункт выдачи'),
(2, 'Филиал магазина');

-- --------------------------------------------------------

--
-- Структура таблицы `brands`
--

CREATE TABLE `brands` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `brands`
--

INSERT INTO `brands` (`id`, `name`) VALUES
(1, 'Foxxx'),
(2, 'Dragonhawk'),
(3, 'Vertigo'),
(4, 'Bishop');

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `quantity` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `img`
--

CREATE TABLE `img` (
  `id` int NOT NULL,
  `img_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `product_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `img`
--

INSERT INTO `img` (`id`, `img_name`, `product_id`) VALUES
(22, 'marceting1.png', 49),
(26, 'dragonhawk.jpg', 57),
(28, 'vertigo hevy.jpg', 59),
(30, 'vader.png', 60),
(31, 'verge black.png', 61),
(38, 'Cyborg Machines Alter.png', 78);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_type_id` int DEFAULT NULL,
  `order_status_id` int NOT NULL DEFAULT '1',
  `address_id` int DEFAULT NULL,
  `custom_address` varchar(255) DEFAULT NULL,
  `shipping_method_id` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `user_name`, `user_email`, `user_phone`, `total_amount`, `payment_type_id`, `order_status_id`, `address_id`, `custom_address`, `shipping_method_id`, `created_at`) VALUES
(16, 7, 'Клименко Елисей Евгеньевич', 'elisej.klimenko.90@bk.ru', '2132142', '19400.00', 1, 1, 6, NULL, 1, '2025-06-16 14:45:39'),
(17, 7, 'Клименко Елисей Евгеньевич', 'elisej.klimenko.90@bk.ru', '3552', '36800.00', 1, 1, 6, NULL, 1, '2025-06-16 14:47:45'),
(18, 7, 'Клименко Елисей Евгеньевич', 'elisej.klimenko.90@bk.ru', '3552', '138000.00', 2, 1, 3, NULL, 2, '2025-06-17 20:24:04'),
(19, 7, 'Клименко Елисей Евгеньевич', 'elisej.klimenko.90@bk.ru', '3552', '60800.00', 2, 1, NULL, 'asdasfsae', 3, '2025-06-18 06:10:22');

-- --------------------------------------------------------

--
-- Структура таблицы `order_items`
--

CREATE TABLE `order_items` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`) VALUES
(12, 16, 60, 1),
(13, 17, 59, 2),
(14, 18, 57, 4),
(15, 18, 60, 4),
(16, 19, 60, 2),
(17, 19, 78, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `order_status`
--

CREATE TABLE `order_status` (
  `id` int NOT NULL,
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `order_status`
--

INSERT INTO `order_status` (`id`, `order_status`) VALUES
(1, 'В обработке'),
(2, 'Передан в доставку'),
(3, 'Отменен');

-- --------------------------------------------------------

--
-- Структура таблицы `payment_type`
--

CREATE TABLE `payment_type` (
  `id` int NOT NULL,
  `payment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `payment_type`
--

INSERT INTO `payment_type` (`id`, `payment`) VALUES
(1, 'Наличные при получении'),
(2, 'СПБ'),
(3, 'Картой');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `brand_id` int NOT NULL,
  `types_id` int NOT NULL,
  `description` text NOT NULL,
  `short_description` text NOT NULL,
  `quantity` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `status`, `brand_id`, `types_id`, `description`, `short_description`, `quantity`) VALUES
(49, 'Foxxx Kitsune Mini Black Vintage RCA', 7000, 'новинка', 3, 2, 'b', '0', 400),
(57, 'Dragonhawk X7 Wireless Smart Screen AI', 15100, 'Хит продаж', 2, 1, 'Что такое Smart Screen AI? Машинка оснащена умной микросхемой, которая определяет сопротивление иглы при прокалывании кожи и своевременно регулирует крутящий момент мотора для обеспечения наилучшей силы прокалывания, что обеспечивает легкость в процессе покраса и контуров на любой области тела. Цветной экран отображает полную информацию в режиме реального времени о напряжении, времени работы и выбранном режиме.\r\n\r\nКомпания Dragonhawk провела статистический анализ на основе привычек использования их оборудования различными пользователями и заложили в память машинки несколько предустановленных значений вольтажа, предпочитаемые большинством художников:\r\n\r\nA7: Базовый уровень контуров. Подходит для картриджей до 7RL или для начинающих. Предустановленное значение напряжения составляет 7В.\r\nB9: Продвинутый уровень контуров. Для картриджей более 9RL или для профессиональных татуировщиков. Предустановленное значение напряжения составляет 9В.\r\nC6: Базовый уровень теней. Для картриджей, в основном магнумов, не более 9MG и для начинающих. Предустановленное значение напряжения составляет 6В.\r\nD10: Продвинутый уровень теней. Подходит для игл не более 11MG и для начинающих. Предустановленное значение напряжения составляет 10В.\r\nE8: Уровень теней. Подходит для работы над плотным покрасом. Предустановленное значение напряжения составляет 8В.', 'Dragonhawk X7 - это первая машинка, разработанная Dragonhawk с использованием технологии Smart Screen AI.', 496),
(59, 'Skinductor Vertigo II Heavy Long Stroke', 18400, 'Хит продаж', 3, 1, 'Современная модель тату-оборудования от Skinductor с высокой скоростью работы, дополненная держателем от Skinductor с утяжелением.\r\n\r\nУсовершенствованный мотор имеет неодимовые магниты, которые обеспечивают высокий показатель мощности. Это способствует исключению потери оборотов во время повышенной нагрузки на двигатель.\r\n\r\nЭргономичная ручка содержит «открытую» передачу, что делает данное тату-оборудование одним из самых безопасных и гигиеничных. Устройство можно подвергать термообработке в автоклаве и сухожаровом стерилизаторе.\r\n\r\nПри помощи поворота мотора относительно держателя производится регулировка вылета игл. Это способствует образованию нужного количества пространства для закрепления защиты.\r\n\r\nЦентр тяжести с балансом, небольшой вибрационный поток и шум, удобная и практичная форма — все это обеспечивает легкую и комфортную работу с оборудованием Vertigo на протяжении долгого времени. С помощью устройства можно выполнять татуирование в любых жанрах.', 'Тату-оборудование Skinductor Vertigo II Heavy', 498),
(60, 'MT Vader Pen MT RCA Cord PRO 2000.135', 19400, 'новинка', 4, 1, 'Viper - машинка собрана на мощном моторе, рама данной модели сделана из прочного и лёгкого алюминиевого сплава. В связи с этим вес данной машины всего 120g.\nДанная модель оснащена регулируемым эксцентриком. Для регулировки нужного вам хода иглы просто перемещайте ваш держатель в зажиме, вперёд или назад. Так же эксцентрик спроектирован так, что на машине отсутствует центробежная тяга, в следствии чего отсутствует вибрация в процессе работы. Под крепление бандажной резинки предусмотрен небольшой и удобный штифт снизу.\nДиаметр зажимного болта сделан больше чем на аналогах — так что держатель фиксируется без проблем и лишних усилий. Данная модель без труда толкает любые иглы и картриджи.\nВсе необходимые рекомендации предусмотрены на прилагаемой к машинке инструкции, вложенной в коробку с товаром.\nМашинка подходит как для тату, так и для татуажа.', 'Viper - машинка собрана на мощном моторе, рама данной модели сделана из прочного и лёгкого алюминиевого сплава. В связи с этим вес данной машины всего 120 грамм', 494),
(61, 'Verge Direct 2 Black RCA', 10900, 'новинка', 2, 1, 'Viper - машинка собрана на мощном моторе, рама данной модели сделана из прочного и лёгкого алюминиевого сплава. В связи с этим вес данной машины всего 120g.\nДанная модель оснащена регулируемым эксцентриком. Для регулировки нужного вам хода иглы просто перемещайте ваш держатель в зажиме, вперёд или назад. Так же эксцентрик спроектирован так, что на машине отсутствует центробежная тяга, в следствии чего отсутствует вибрация в процессе работы. Под крепление бандажной резинки предусмотрен небольшой и удобный штифт снизу.\nДиаметр зажимного болта сделан больше чем на аналогах — так что держатель фиксируется без проблем и лишних усилий. Данная модель без труда толкает любые иглы и картриджи.\nВсе необходимые рекомендации предусмотрены на прилагаемой к машинке инструкции, вложенной в коробку с товаром.\nМашинка подходит как для тату, так и для татуажа.', 'Viper - машинка собрана на мощном моторе, рама данной модели сделана из прочного и лёгкого алюминиевого сплава. В связи с этим вес данной машины всего 120 грамм', 300),
(78, 'Cyborg Machines Alter Rotary Axis Cross Sexy Nymph', 11000, 'новинка', 3, 1, 'вфыва', 'фывафы', 10);

-- --------------------------------------------------------

--
-- Структура таблицы `product_attrybutes`
--

CREATE TABLE `product_attrybutes` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `type_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `product_attrybutes`
--

INSERT INTO `product_attrybutes` (`id`, `name`, `type_id`) VALUES
(1, 'Тип машинки', 1),
(2, 'Назначение машинки', 1),
(3, 'Вес', 1),
(4, 'Рабочий вольтаж', 1),
(5, 'Производитель', 1),
(6, 'Страна', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `product_attrybute_values`
--

CREATE TABLE `product_attrybute_values` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `attribute_id` int NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `product_attrybute_values`
--

INSERT INTO `product_attrybute_values` (`id`, `product_id`, `attribute_id`, `value`) VALUES
(151, 57, 1, 'Роторная'),
(152, 57, 2, 'Универсальная'),
(153, 57, 3, '213 г с аккумулятором'),
(154, 57, 4, '12V'),
(155, 57, 5, 'dragohawk'),
(156, 57, 6, 'Китай'),
(163, 59, 1, 'Роторная'),
(164, 59, 2, 'Универсальная'),
(165, 59, 3, '232 г'),
(166, 59, 4, '3-8 V'),
(167, 59, 5, 'Skinductor'),
(168, 59, 6, 'Россия'),
(263, 61, 1, 'Универсальная'),
(264, 61, 2, 'Лайнер'),
(265, 61, 3, '165 г'),
(266, 61, 4, '3-8 V'),
(267, 61, 5, 'dragohawk'),
(268, 61, 6, 'Россия'),
(269, 60, 1, 'Универсальная'),
(270, 60, 2, 'Лайнер'),
(271, 60, 3, '265 г'),
(272, 60, 4, '5-7 V'),
(273, 60, 5, 'drago'),
(274, 60, 6, 'Казахстан'),
(275, 78, 1, 'Роторная'),
(276, 78, 2, 'Лайнер'),
(277, 78, 3, '213 г с аккумулятором'),
(278, 78, 4, '5-7 V'),
(279, 78, 5, 'dragohawk'),
(280, 78, 6, 'Россия');

-- --------------------------------------------------------

--
-- Структура таблицы `product_types`
--

CREATE TABLE `product_types` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `product_types`
--

INSERT INTO `product_types` (`id`, `name`) VALUES
(1, 'Тату машинки'),
(2, 'Педали'),
(3, 'Тату иглы'),
(4, 'Источники питания'),
(5, 'Наборы для татуировок'),
(6, 'Защита, емкости, расходные материалы'),
(7, 'Принтеры и планшеты'),
(8, 'Держатели'),
(9, 'Педали и провода'),
(10, 'Краски'),
(11, 'Наконечники'),
(12, 'Аксессуары');

-- --------------------------------------------------------

--
-- Структура таблицы `promocods`
--

CREATE TABLE `promocods` (
  `id` int NOT NULL,
  `promocod` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE `role` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Структура таблицы `shipping_method`
--

CREATE TABLE `shipping_method` (
  `id` int NOT NULL,
  `shipping_method` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `shipping_method`
--

INSERT INTO `shipping_method` (`id`, `shipping_method`) VALUES
(1, 'Забрать в магазине'),
(2, 'Забрать в пункте выдачи'),
(3, 'Курьером');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role_id`) VALUES
(4, 'Валера', 'elisej.enko.90@bk.ru', '123', 2),
(7, 'klimenkoelisei', 'admin', 'admin', 1),
(10, 'Pupok', 'vasia-pupkin@mail.ru', 'Vd40501j', 2),
(11, 'klimenkoelisei', 'gnida-grigorieva@mail.ru', 'G28a15098', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `product_id`, `added_at`) VALUES
(13, 7, 57, '2025-06-18 06:09:31'),
(14, 7, 59, '2025-06-18 06:09:32');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `address_type_id` (`address_type_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `address_types`
--
ALTER TABLE `address_types`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `img`
--
ALTER TABLE `img`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `address_id` (`address_id`),
  ADD KEY `payment_type_id` (`payment_type_id`),
  ADD KEY `shipping_method_id` (`shipping_method_id`),
  ADD KEY `order_status_id` (`order_status_id`);

--
-- Индексы таблицы `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `payment_type`
--
ALTER TABLE `payment_type`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `product_types_id` (`types_id`);

--
-- Индексы таблицы `product_attrybutes`
--
ALTER TABLE `product_attrybutes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_id` (`type_id`);

--
-- Индексы таблицы `product_attrybute_values`
--
ALTER TABLE `product_attrybute_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`,`attribute_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Индексы таблицы `product_types`
--
ALTER TABLE `product_types`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `promocods`
--
ALTER TABLE `promocods`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `shipping_method`
--
ALTER TABLE `shipping_method`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Индексы таблицы `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `address`
--
ALTER TABLE `address`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `address_types`
--
ALTER TABLE `address_types`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT для таблицы `img`
--
ALTER TABLE `img`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `payment_type`
--
ALTER TABLE `payment_type`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT для таблицы `product_attrybutes`
--
ALTER TABLE `product_attrybutes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `product_attrybute_values`
--
ALTER TABLE `product_attrybute_values`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=281;

--
-- AUTO_INCREMENT для таблицы `product_types`
--
ALTER TABLE `product_types`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `promocods`
--
ALTER TABLE `promocods`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `role`
--
ALTER TABLE `role`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `shipping_method`
--
ALTER TABLE `shipping_method`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`address_type_id`) REFERENCES `address_types` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `address_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `img`
--
ALTER TABLE `img`
  ADD CONSTRAINT `img_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`payment_type_id`) REFERENCES `payment_type` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`shipping_method_id`) REFERENCES `shipping_method` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `orders_ibfk_5` FOREIGN KEY (`order_status_id`) REFERENCES `order_status` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`types_id`) REFERENCES `product_types` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `product_attrybutes`
--
ALTER TABLE `product_attrybutes`
  ADD CONSTRAINT `product_attrybutes_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `product_types` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `product_attrybute_values`
--
ALTER TABLE `product_attrybute_values`
  ADD CONSTRAINT `product_attrybute_values_ibfk_1` FOREIGN KEY (`attribute_id`) REFERENCES `product_attrybutes` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `product_attrybute_values_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
