# Camagru
Welcome to Camagru, a small Instagram-like website allowing users to create and share photo-montages. 
Create a profile, take new photo-montages, share it on the public gallery. 

![alt text](public/preview_readme.png?raw=true "Title")

### Build with
* [PHP](http://www.php.net/) - Backend
* [Javascript](https://www.javascript.com/) - Frontend
* [MySQL](https://www.mysql.com/fr/) - Database
* HTML/CSS - Frontend
* Ajax - XMLHttpRequest

## Get the requirement

### Prerequisites
You need to have installed [PHP](http://www.php.net/), [MySQL](https://www.mysql.com/fr/) and a local web server of your choice ([Apache](https://httpd.apache.org/), [nginx](https://www.nginx.com/), etc)

### Modify the config file
*config/database.php* contains all the information needed by [MySQL](https://www.mysql.com/fr/) to connect Camagru to its database. Modify it so it matches your MySQL config.
```
$DB_DSN = 'mysql:host=localhost; dbname=db_camagru';
$DB_USER = 'yourMysqlUsername';
$DB_PASSWORD = "yourMysqlPassword";
```
### Launch the server
Start the server you have installed.

### Create the database
If no database is found a *"cliquez ici"* link will appear. Click on it to create a new database.

## Get started
You can now create a new profile or sign in with one of the profile below:
* food : *food*
* travel : *travel*
* architecture : *architecture*
* people : *people*

![alt text](public/model_readme.png?raw=true "Title")

## Author
* **Chloe** - *Front/Back* - [ccu-an-b](https://github.com/ccu-an-b)
