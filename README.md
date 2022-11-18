# ⚽️ PROJECT API - FOOTIX ⚽️

<p align="center">
  <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white">
  <img src="https://img.shields.io/badge/connect-%2300843e.svg?style=for-the-badge&logo=symfony&logoColor=white">
</p>

Footix is a project API at Ynov Lyon. It consist to create an API on PHP symfony. Footix talk about the result of game footballs.

### 🎉 Authors 🎉

- Fadel El HANI
- Cédric PAYET
- Thomas DIETRICH 
- Mattéo DINVILLE
## 🖥️ Create your environnement 🖥️

Create a file .env.local in racine project and replace with your information of file .env
## ⚠️ Installation ⚠️

Clone the project and go inside.

```bash
git clone https://github.com/f4d3l21/Footix2
```

## 🔑 Usage 🔑

```php 
composer install 
```
Create a JWT key in a new file JWT.

```php
php bin/console lexik:jwt:generate-keypair
```

Then, after that generate a database with data fixtures. Run all this commands : 

```bash
php bin/console d:d:c
php bin/console d:s:u --force
php bin/console d:f:l
symfony serve
```


