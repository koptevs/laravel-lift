# Laravel Lift
Educational project. 
Building a system for registering annual inspections of elevator equipment.

## Laravel installation

````shell
$ composer create-project laravel/laravel laravel-lift
$ cd laravel-lift
$ git init

$ git remote add origin https://github.com/koptevs/laravel-lift.git
$ git branch -M master
$ git add -A
$ git commit -m "Initial commit"
$ git push -u origin master
````

## Laravel Breeze installation

Following the instructions for [Laravel Breeze installation](https://laravel.com/docs/9.x/starter-kits#laravel-breeze-installation)

```shell
$ php artisan migrate
$ composer require laravel/breeze --dev
$ php artisan breeze:install
$ npm install
$ npm run dev
$ php artisan migrate
```
