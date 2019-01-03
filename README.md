# Mangadex

[![Build Status](https://travis-ci.org/railken/mangadex.svg?branch=master)](https://travis-ci.org/railken/mangadex)

Mangadex scraper

# Requirements

PHP 7.1 and later.

## Installation

You can install it via [Composer](https://getcomposer.org/) by typing the following command:

```bash
composer require railken/mangadex
```

## Usage


```php
	use Railken\Mangadex\MangadexApi;

    $api = new MangadexApi();

    $result = $api
        ->search()
        ->includeTags(['Action', 'Adventure'])
        ->excludeTags(['Samurai'])
        ->status('Ongoing')
        ->name('a')
        ->artist('a')
        ->page(2)
        ->get();
```