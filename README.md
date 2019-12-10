## Mini E-Wallet (Laravel)

Mini E-Wallet menggunakan bahasa pemrograman PHP dan framework Laravel


## Requirements

- Composer
- Node.js
- Laravel 6.2
- PHP >= 7.0
- MySQL
- Yakin dan Percaya

## Instalation

- Langkah pertama pull semua data dari github, setelah selesai buka cmd pada directory tersebut dan jalankan *`composer install`*
```bash
#untuk install vendor
composer install
```
 - kemudian jalankan *`npm install`* dan *`npm run dev`* untuk install Laravel Mix
```bash
#untuk install Laravel Mix
npm install
npm run dev
```
- berikutnya buat database baru dengan nama `ewallet`
- kemudian copy file `.env.example` paste dengan nama `.env` sesuaikan config database pada file `.env`
- jalankan `key:generate` 
```bash
php artisan key:generate
```
- selanjutnya jalankan migrasi untuk insert struktur database
```bash
#untuk menjalankan migrasi
php artisan migrate
```
- setelah itu, jalankan seeder database untuk mengisi database
```bash
#untuk mengisi database
php artisan db:seed
```
- kemudian `run serve` pada folder tersebut
```bash
#running laravel
php artisan serve
```
- buka web browser dengan url `http://localhost:8000` atau `http://127.0.0.1:8000`
- *violaa*, Selesai

## Basic Usage

- setelah melakukan seeder, saldo dibank ada `10000000`
- Login sebagai user dengan akun `orang1`
   email 			: `orang1@gmail.com`
   password   	: `passorang1`
- Login sebagai user dengan akun `orang2`
   email			: `orang2@gmail.com`
   password 	: `passorang2`
- Lakukan `topup` terlebih dahulu agar bisa melakukan `transfer` antar `user`
- Untuk menambahkan `user` klik `register` pada menu awal

## API

jalankan api dengan url `http://localhost:8000/api` dengan menggunakan endpoint sebagai berikut : 

|**Endpoint**|**Method**|**Parameter**|**Description**|
|--------|------|---------|-----------|
|/balance|GET   |    -    |Untuk melihat *balance* di bank
|/topup  |POST  | topup (integer) | Untuk menambah *balance* di bank
