<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## O aplikacji

Projekt zaliczeniowy z przedmiotu Programowanie Aplikacji Internetowych stworzony w języku PHP przy użyciu frameworka Laravel. 

W aplikacji jest możliwe zarejestrowanie się, zalogowanie się, CRUD przepisów. Umożliwione jest także komentowanie i ocenianie przepisów.

## Instalacja

1. Otworzyć konsolę w folderze głównym projektu
2. Uruchomić komendy:
    ```
	composer install
	npm install
	cp .env.example .env
	php artisan key:generate
    ```
3. Skonfigurować plik .env:
   -DB_HOST=IP_Bazy
   -DB_PORT=Port_Bazy
   -DB_DATABASE=Nazwa_Bazy
   -DB_USERNAME=Nazwa_Uzytkownika_Bazy
   -DB_PASSWORD=Haslo
4. Stworzyć bazę o nazwie wpisanej w .env
5. Uruchomić komendy:
    ```
	php artisan migrate
	php artisan db:seed
	php artisan serve
    ```
6. Wejść pod adres 127.0.0.1:8000

Przykładowe dane logowania: test test