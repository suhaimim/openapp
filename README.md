<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

------

## Steps up to this initial setup 
**(Malay Language will be provide upon request)**

This steps has been done during this repo push. This information is just to let you know what was the steps taken so far in case you would like to start from scratch and setup from your end without go through this repo clone. (laravel v8.6.9)

- ~/Projects$ composer create-project laravel/laravel openapp --prefer-dist
- ~/Projects$ cd openapp/
- ~/Projects$ code .
- Setup Database information in .env file with your own db preferences and create the db in mysql
- Checking catch bug throws error by adding below statements:
-- use Illuminate\Support\Facades\Schema; // at use area (below namespace)
-- Schema::defaultstringLength(191); // inside public function boot() { ... }
- ~/Projects/openapp$ php artisan migrate
- ~/Projects/openapp$ composer require laravel/jetstream
- ~/Projects/openapp$ php artisan jetstream:install livewire
- ~/Projects/openapp$ npm install && npm run dev
- ~/Projects/openapp$ php artisan migrate

At this stage, you should be able to run the apps and login by doing this
- ~/Projects/openapp$ php artisan serve

However, lets continue with .env sendmail configuration (your own smtp settings)



### E-Mail to suhaimi.masri@gmail.com 

If you required any assistant in regards of this matter, please do not hesitate to contact me at my email above or find me in facebook.

Any comments and contributions are mostly welcome.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
