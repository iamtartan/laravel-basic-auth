# Laravel 7+ basic auth component named Separ which means shield in English

![separ](https://images.idgesg.net/images/article/2018/08/7_best-common-defenses_sword_shield_warrior_knight_security-100768046-large.jpg)

> A [HTTP basic auth](https://en.m.wikipedia.org/wiki/Basic_access_authentication) middleware for Laravel.

```php
// Use on your routes.
Route::get('/', ['middleware' => 'separ'], function () {
    // Your protected page.
});

// Use it within your controller constructor.
$this->middleware('separ');

// Use specific user credentials.
$this->middleware('MY_USERNAME:MY_SECRET_PASS');
```

## Installation

Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

```bash
$ composer require tartan/separ
```

Add the middleware to the `$routeMiddleware` array in your `Kernel.php` file.

```php
'separ' => \Tartan\Separ\ShieldMiddleware::class,
```

## Configuration

Laravel Separ requires configuration. To get started, you'll need to publish all vendor assets:

```bash
$ php artisan vendor:publish
```

This will create a `config/separ.php` file in your app that you can modify to set your configuration. 
Also, make sure you check for changes to the original config file in this package between releases.

#### HTTP Basic Auth Credentials

The user credentials which are used when logging in with [HTTP basic authentication](https://en.m.wikipedia.org/wiki/Basic_access_authentication).

## Usage

To protect your routes with the separ you can add it to the routes file.

```php
Route::get('/', ['middleware' => 'separ'], function () {
    // Your protected page.
});
```

You can also add the separ middleware to your controllers constructor.

```php
$this->middleware('separ');
```

The middleware accepts one optional parameter to specify which user credentials to compared with.

```php
$this->middleware('ANOTHER_USER:ANOTHER_PASS');
```

To add a new user, you probably want to use hashed credentials. Hashed credentials can be generated with the [`password_hash()`](https://secure.php.net/manual/en/function.password-hash.php) function in the terminal:

```sh
$ php -r "echo password_hash('my-secret-passphrase', PASSWORD_DEFAULT);"
```

Then copy and paste the hashed credentials to the `.env` environment file.

```bash
SEPAR_USER=your-hashed-user
SEPAR_PASSWORD=your-hashed-password
```

## License

[MIT](LICENSE) © [Aboozar Ghaffari](https://github.com/iamtartan)
