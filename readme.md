# Nicolas X Vendredi
Slack like Chat application developed by [me](https://nicolasmercier.io) from a starter Boilerplate SPA made with Laravel 5.6, Bootstrap 4, JWT Auth, Vue 2, Vue-router 3, Vuex 3, Axios & :heart:

[Live Demo](https://vendredi.nicolasmercier.io)


## Installation:
* Clone the repo
* Copy `.env.example` to `.env`
* Configure `.env`
* `cd` to the repo
* Run `composer install --no-scripts`
* Run `php artisan key:generate`
* Run `php artisan migrate --seed`. A user will be seeded so that you can login, where:
    * email is: `ex@mple.com`
    * password is: `password`
* Run `npm install`
* Run `npm run watch`
* View the site by 
    * Either running `php artisan serve` if you are not using vagrant homestead or laravel valet (in a new terminal/command prompt)
    * Otherwise go to your local dev url configured in vagrant

For any problem in laravel setup, please get help from [Laravel](https://laravel.com) site. If that does not work, please create an issue, I will try my best to help.
     
## Note:
I tried to follow the best practices, but any suggestion, modification is highly appreciated.  
