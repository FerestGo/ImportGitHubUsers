# ImportGitHubUsers
 Консольное приложение импротирует github пользователей из json (https://api.github.com/users) в таблицу mysql
 
 
 ## Установка
1. Скачать архив или `git clone` 
1. Заполнить параметры вашей базы даннхых в Database.php
1. Создать таблицу в базе данных
```
CREATE TABLE `user` (
  `github_id` int(11) UNSIGNED NOT NULL,
  `github_login` varchar(255) NOT NULL,
  PRIMARY KEY (github_id)
) ENGINE=InnoDB;
```
1. Выполнить `php index.php` в папке с приложением

## Конфигурация
Для добавления команд и параметров следуйте инструкции библиотеки консоли https://github.com/asika32764/php-simple-console 

index.php - редактирования интерфейса взаимодействия с консолью

App.php - код приложением

