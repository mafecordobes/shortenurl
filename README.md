# Shorten Url
Shorten Url is an API to shorten a URL.

## Requirements
  - Laravel 
       - PHP >= 7.1.3
       - BCMath PHP Extension
       - Ctype PHP Extension
       - JSON PHP Extension
       - Mbstring PHP Extension
       - OpenSSL PHP Extension
       - PDO PHP Extension
       - Tokenizer PHP Extension
       - XML PHP Extension
  - MySQL

## Version

1.0.0

## Technologies

* [Laravel] - The PHP Framework For Web Artisans
* [Composer] - Dependency Manager for PHP

## Installation

Download zip file and extract it [latest pre-built release](https://github.com/mafecordobes/shortenurl). Or clone the repository and cd into it.

```sh
cd shortenurl
composer install
cp .env.example .env
```

If you don't have `.env` file you can use the example one. Just rename `.env.example` to `.env`. Enter your configuration here (Database and App Url Configurations).

If you wish create a virtual host called: shortenurl.test

## Keys

```sh
php artisan key:generate
```

## Migrations

Run the following command to run startup migrations.

```sh
php artisan migrate
php artisan serve
```

## Documentation

For do a Shorten url you can make a post request: 

http://shortenurl.test/api/short?url=URL

Where shortenurl.test is the virtual host and URL the URL that you want to short.

This will be the response:

```sh
{
    "success": true,
    "message": "Your short url for URL is SHORT_URL",
    "data": {
        "url": "URL",
        "short_url": "CODE",
        "id": ID
    }
}
```

And if you put the SHORT_URL in your browser you get the redirection.

## Future improvements

If I had more time, I would have done better documentation and the endpoint to list the 100 most visited url.

[//]: # (These are reference links used in the body of this note and get stripped out when the markdown processor does 
its job. There is no need to format nicely because it shouldn't be seen. Thanks SO - http://stackoverflow.com/questions/4823468/store-comments-in-markdown-syntax)

   [Laravel]: <https://laravel.com/>
   [Composer]: <https://getcomposer.org/>
