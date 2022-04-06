## Запуск сервера

php artisan serve

## Задать параметры БД в файле .env

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ruyou
DB_USERNAME=root
DB_PASSWORD=root

## Миграция таблиц в БД

php artisan migrate

## Запросы в Postman

Headers:
Accept = application/json

## Регистрация нового пользователя

Method: POST
URL: http://127.0.0.1:8000/api/register

Params:
name = ...
email = ...
password = ...
password_confirmation = ...

## Авторизация

Method: POST
URL: http://127.0.0.1:8000/api/login

Params:
email = ...
password = ...

## Выход из системы

Method: POST
URL: http://127.0.0.1:8000/api/logout

Authorization:
Type = Bearer Token
Token = [Токен, полученный при авторизации]

## Получение данных текущего пользователя

Method: GET
URL: http://127.0.0.1:8000/api/getuserinfo

Authorization:
Type = Bearer Token
Token = [Токен, полученный при авторизации]

## Редактирование данных пользователя

Method: POST
URL: http://127.0.0.1:8000/api/edituserinfo

Authorization:
Type = Bearer Token
Token = [Токен, полученный при авторизации]

Params:
name = ...
surname = ...
phone = ...
